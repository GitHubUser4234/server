<?php
/**
 * @author Björn Schießle <schiessle@owncloud.com>
 *
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 * @copyright Copyright (c) 2016, Björn Schießle <bjoern@schiessle.org>
 *
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */


namespace OCA\FederatedFileSharing\Tests\Controller;

use OC\HintException;
use OCA\FederatedFileSharing\AddressHandler;
use OCA\FederatedFileSharing\Controller\MountPublicLinkController;
use OCA\FederatedFileSharing\FederatedShareProvider;
use OCP\AppFramework\Http;
use OCP\Files\IRootFolder;
use OCP\Http\Client\IClientService;
use OCP\IL10N;
use OCP\ISession;
use OCP\IUserManager;
use OCP\IUserSession;
use OCP\Share\IManager;
use OCP\Share\IShare;

class MountPublicLinkControllerTest extends \Test\TestCase {

	/** @var  MountPublicLinkController */
	private $controller;

	/** @var  \OCP\IRequest | \PHPUnit_Framework_MockObject_MockObject */
	private $request;

	/** @var  FederatedShareProvider | \PHPUnit_Framework_MockObject_MockObject */
	private $federatedShareProvider;

	/** @var  IManager | \PHPUnit_Framework_MockObject_MockObject */
	private $shareManager;

	/** @var  AddressHandler | \PHPUnit_Framework_MockObject_MockObject */
	private $addressHandler;

	/** @var  IRootFolder | \PHPUnit_Framework_MockObject_MockObject */
	private $rootFolder;

	/** @var  IUserManager | \PHPUnit_Framework_MockObject_MockObject */
	private $userManager;

	/** @var  ISession | \PHPUnit_Framework_MockObject_MockObject */
	private $session;

	/** @var  IL10N | \PHPUnit_Framework_MockObject_MockObject */
	private $l10n;

	/** @var  IUserSession | \PHPUnit_Framework_MockObject_MockObject */
	private $userSession;

	/** @var  IClientService | \PHPUnit_Framework_MockObject_MockObject */
	private $clientService;

	/** @var  IShare */
	private $share;

	public function setUp() {
		parent::setUp();

		$this->request = $this->getMockBuilder('OCP\IRequest')->disableOriginalConstructor()->getMock();
		$this->federatedShareProvider = $this->getMockBuilder('OCA\FederatedFileSharing\FederatedShareProvider')
			->disableOriginalConstructor()->getMock();
		$this->shareManager = $this->getMockBuilder('OCP\Share\IManager')->disableOriginalConstructor()->getMock();
		$this->addressHandler = $this->getMockBuilder('OCA\FederatedFileSharing\AddressHandler')
			->disableOriginalConstructor()->getMock();
		$this->rootFolder = $this->getMockBuilder('OCP\Files\IRootFolder')->disableOriginalConstructor()->getMock();
		$this->userManager = $this->getMockBuilder('OCP\IUserManager')->disableOriginalConstructor()->getMock();
		$this->share = new \OC\Share20\Share($this->rootFolder, $this->userManager);
		$this->session = $this->getMockBuilder('OCP\ISession')->disableOriginalConstructor()->getMock();
		$this->l10n = $this->getMockBuilder('OCP\IL10N')->disableOriginalConstructor()->getMock();
		$this->userSession = $this->getMockBuilder('OCP\IUserSession')->disableOriginalConstructor()->getMock();
		$this->clientService = $this->getMockBuilder('OCP\Http\Client\IClientService')->disableOriginalConstructor()->getMock();

		$this->controller = new MountPublicLinkController(
			'federatedfilesharing', $this->request,
			$this->federatedShareProvider,
			$this->shareManager,
			$this->addressHandler,
			$this->session,
			$this->l10n,
			$this->userSession,
			$this->clientService
		);
	}

	/**
	 * @dataProvider dataTestCreateFederatedShare
	 *
	 * @param string $shareWith
	 * @param bool $outgoingSharesAllowed
	 * @param bool $validShareWith
	 * @param string $token
	 * @param bool $validToken
	 * @param bool $createSuccessful
	 * @param string $expectedReturnData
	 */
	public function testCreateFederatedShare($shareWith,
											 $outgoingSharesAllowed,
											 $validShareWith,
											 $token,
											 $validToken,
											 $createSuccessful,
											 $expectedReturnData
	) {

		$this->federatedShareProvider->expects($this->any())
			->method('isOutgoingServer2serverShareEnabled')
			->willReturn($outgoingSharesAllowed);

		$this->addressHandler->expects($this->any())->method('splitUserRemote')
			->with($shareWith)
			->willReturnCallback(
				function($shareWith) use ($validShareWith, $expectedReturnData) {
					if ($validShareWith) {
						return ['user', 'server'];
					}
					throw new HintException($expectedReturnData, $expectedReturnData);
				}
			);

		$share = $this->share;

		$this->shareManager->expects($this->any())->method('getShareByToken')
			->with($token)
			->willReturnCallback(
				function ($token) use ($validToken, $share, $expectedReturnData) {
					if ($validToken) {
						return $share;
					}
					throw new HintException($expectedReturnData, $expectedReturnData);
				}
			);

		$this->federatedShareProvider->expects($this->any())->method('create')
			->with($share)
			->willReturnCallback(
				function (IShare $share) use ($createSuccessful, $shareWith, $expectedReturnData) {
					$this->assertEquals($shareWith, $share->getSharedWith());
					if ($createSuccessful) {
						return $share;
					}
					throw new HintException($expectedReturnData, $expectedReturnData);
				}
			);

		$result = $this->controller->createFederatedShare($shareWith, $token);

		$errorCase = !$validShareWith || !$validToken || !$createSuccessful || !$outgoingSharesAllowed;

		if ($errorCase) {
			$this->assertSame(Http::STATUS_BAD_REQUEST, $result->getStatus());
			$this->assertTrue(isset($result->getData()['message']));
			$this->assertSame($expectedReturnData, $result->getData()['message']);
		} else {
			$this->assertSame(Http::STATUS_OK, $result->getStatus());
			$this->assertTrue(isset($result->getData()['remoteUrl']));
			$this->assertSame($expectedReturnData, $result->getData()['remoteUrl']);

		}

	}

	public function dataTestCreateFederatedShare() {
		return [
			//shareWith, outgoingSharesAllowed, validShareWith, token, validToken, createSuccessful, expectedReturnData
			['user@server', true, true, 'token', true, true, 'server'],
			['user@server', true, false, 'token', true, true, 'invalid federated cloud id'],
			['user@server', true, false, 'token', false, true, 'invalid federated cloud id'],
			['user@server', true, false, 'token', false, false, 'invalid federated cloud id'],
			['user@server', true, false, 'token', true, false, 'invalid federated cloud id'],
			['user@server', true, true, 'token', false, true, 'invalid token'],
			['user@server', true, true, 'token', false, false, 'invalid token'],
			['user@server', true, true, 'token', true, false, 'can not create share'],
			['user@server', false, true, 'token', true, true, 'This server doesn\'t support outgoing federated shares'],
		];
	}

}
