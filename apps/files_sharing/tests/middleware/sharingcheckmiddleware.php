<?php
/**
 * @author Joas Schilling <nickvergessen@owncloud.com>
 * @author Lukas Reschke <lukas@owncloud.com>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Thomas Müller <thomas.mueller@tmit.eu>
 *
 * @copyright Copyright (c) 2015, ownCloud, Inc.
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

namespace OCA\Files_Sharing\Middleware;
use OCP\AppFramework\Http\NotFoundResponse;
use OCP\Files\NotFoundException;

/**
 * @package OCA\Files_Sharing\Middleware\SharingCheckMiddleware
 */
class SharingCheckMiddlewareTest extends \Test\TestCase {

	/** @var \OCP\IConfig */
	private $config;
	/** @var \OCP\App\IAppManager */
	private $appManager;
	/** @var SharingCheckMiddleware */
	private $sharingCheckMiddleware;
	/** @var \OCP\AppFramework\Controller */
	private $controllerMock;

	protected function setUp() {
		$this->config = $this->getMockBuilder('\OCP\IConfig')
			->disableOriginalConstructor()->getMock();
		$this->appManager = $this->getMockBuilder('\OCP\App\IAppManager')
			->disableOriginalConstructor()->getMock();
		$this->controllerMock = $this->getMockBuilder('\OCP\AppFramework\Controller')
			->disableOriginalConstructor()->getMock();

		$this->sharingCheckMiddleware = new SharingCheckMiddleware('files_sharing', $this->config, $this->appManager);
	}

	public function testIsSharingEnabledWithAppEnabled() {
		$this->appManager
			->expects($this->once())
			->method('isEnabledForUser')
			->with('files_sharing')
			->will($this->returnValue(true));

		$this->assertTrue(self::invokePrivate($this->sharingCheckMiddleware, 'isSharingEnabled'));
	}

	public function testIsSharingEnabledWithAppDisabled() {
		$this->appManager
			->expects($this->once())
			->method('isEnabledForUser')
			->with('files_sharing')
			->will($this->returnValue(false));

		$this->assertFalse(self::invokePrivate($this->sharingCheckMiddleware, 'isSharingEnabled'));
	}

	public function testIsLinkSharingEnabledWithEverythinEnabled() {
		$this->config
			->expects($this->at(0))
			->method('getAppValue')
			->with('core', 'shareapi_enabled', 'yes')
			->will($this->returnValue('yes'));

		$this->config
			->expects($this->at(1))
			->method('getAppValue')
			->with('core', 'shareapi_allow_links', 'yes')
			->will($this->returnValue('yes'));

		$this->assertTrue(self::invokePrivate($this->sharingCheckMiddleware, 'isLinkSharingEnabled'));
	}


	public function testIsLinkSharingEnabledWithLinkSharingDisabled() {
		$this->config
			->expects($this->at(0))
			->method('getAppValue')
			->with('core', 'shareapi_enabled', 'yes')
			->will($this->returnValue('yes'));

		$this->config
			->expects($this->at(1))
			->method('getAppValue')
			->with('core', 'shareapi_allow_links', 'yes')
			->will($this->returnValue('no'));

		$this->assertFalse(self::invokePrivate($this->sharingCheckMiddleware, 'isLinkSharingEnabled'));
	}

	public function testIsLinkSharingEnabledWithSharingAPIDisabled() {
		$this->config
			->expects($this->once())
			->method('getAppValue')
			->with('core', 'shareapi_enabled', 'yes')
			->will($this->returnValue('no'));

		$this->assertFalse(self::invokePrivate($this->sharingCheckMiddleware, 'isLinkSharingEnabled'));
	}

	public function testBeforeControllerWithSharingEnabled() {
		$this->appManager
			->expects($this->once())
			->method('isEnabledForUser')
			->with('files_sharing')
			->will($this->returnValue(true));

		$this->config
			->expects($this->at(0))
			->method('getAppValue')
			->with('core', 'shareapi_enabled', 'yes')
			->will($this->returnValue('yes'));

		$this->config
			->expects($this->at(1))
			->method('getAppValue')
			->with('core', 'shareapi_allow_links', 'yes')
			->will($this->returnValue('yes'));

		$controller = $this->getMockBuilder('\OCA\Files_Sharing\Controllers\ShareController')
			->disableOriginalConstructor()->getMock();

		$this->sharingCheckMiddleware->beforeController($controller, 'myMethod');
	}

	/**
	 * @expectedException \OCP\Files\NotFoundException
	 * @expectedExceptionMessage Sharing is disabled.
	 */
	public function testBeforeControllerWithSharingDisabled() {
		$this->appManager
			->expects($this->once())
			->method('isEnabledForUser')
			->with('files_sharing')
			->will($this->returnValue(false));

		$controller = $this->getMockBuilder('\OCA\Files_Sharing\Controllers\ShareController')
			->disableOriginalConstructor()->getMock();

		$this->sharingCheckMiddleware->beforeController($controller, 'myMethod');
	}

	/**
	 * @expectedException \Exception
	 * @expectedExceptionMessage My Exception message
	 */
	public function testAfterExceptionWithRegularException() {
		$this->sharingCheckMiddleware->afterException($this->controllerMock, 'myMethod', new \Exception('My Exception message'));
	}

	public function testAfterExceptionWithNotFoundException() {
		$this->assertEquals(new NotFoundResponse(), $this->sharingCheckMiddleware->afterException($this->controllerMock, 'myMethod', new NotFoundException('My Exception message')));
	}

}
