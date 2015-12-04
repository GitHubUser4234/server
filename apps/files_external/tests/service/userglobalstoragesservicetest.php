<?php
/**
 * @author Robin McCorkell <rmccorkell@karoshi.org.uk>
 * @author Vincent Petry <pvince81@owncloud.com>
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
namespace OCA\Files_External\Tests\Service;

use OCA\Files_external\Service\StoragesService;
use \OCA\Files_External\Service\UserGlobalStoragesService;
use \OCP\IGroupManager;

use \OCA\Files_External\Lib\StorageConfig;
use OCP\IUser;
use Test\Traits\UserTrait;

/**
 * @group DB
 */
class UserGlobalStoragesServiceTest extends GlobalStoragesServiceTest {
	use UserTrait;

	/** @var \OCP\IGroupManager|\PHPUnit_Framework_MockObject_MockObject groupManager */
	protected $groupManager;

	/**
	 * @var StoragesService
	 */
	protected $globalStoragesService;

	/**
	 * @var UserGlobalStoragesService
	 */
	protected $service;

	protected $user;

	const USER_ID = 'test_user';
	const GROUP_ID = 'test_group';
	const GROUP_ID2 = 'test_group2';

	public function setUp() {
		parent::setUp();

		$this->globalStoragesService = $this->service;

		$this->user = new \OC\User\User(self::USER_ID, null);
		/** @var \OCP\IUserSession|\PHPUnit_Framework_MockObject_MockObject $userSession */
		$userSession = $this->getMock('\OCP\IUserSession');
		$userSession
			->expects($this->any())
			->method('getUser')
			->will($this->returnValue($this->user));

		$this->groupManager = $this->getMock('\OCP\IGroupManager');
		$this->groupManager->method('isInGroup')
			->will($this->returnCallback(function ($userId, $groupId) {
				if ($userId === self::USER_ID) {
					switch ($groupId) {
						case self::GROUP_ID:
						case self::GROUP_ID2:
							return true;
					}
				}
				return false;
			}));
		$this->groupManager->method('getUserGroupIds')
			->will($this->returnCallback(function (IUser $user) {
				if ($user->getUID() === self::USER_ID) {
					return [self::GROUP_ID, self::GROUP_ID2];
				} else {
					return [];
				}
			}));

		$this->service = new UserGlobalStoragesService(
			$this->backendService,
			$this->dbConfig,
			$userSession,
			$this->groupManager
		);
	}

	public function applicableStorageProvider() {
		return [
			[[], [], true],

			// not applicable cases
			[['user1'], [], false],
			[[], ['group1'], false],
			[['user1'], ['group1'], false],

			// applicable cases
			[[self::USER_ID], [], true],
			[[], [self::GROUP_ID], true],
			[[self::USER_ID], ['group1'], true],
			[['user1'], [self::GROUP_ID], true],

			// sanity checks
			[['user1', 'user2', self::USER_ID, 'user3'], [], true],
		];
	}

	/**
	 * @dataProvider applicableStorageProvider
	 */
	public function testGetStorageWithApplicable($applicableUsers, $applicableGroups, $isVisible) {
		$backend = $this->backendService->getBackend('identifier:\OCA\Files_External\Lib\Backend\SMB');
		$authMechanism = $this->backendService->getAuthMechanism('identifier:\Auth\Mechanism');

		$storage = new StorageConfig();
		$storage->setMountPoint('mountpoint');
		$storage->setBackend($backend);
		$storage->setAuthMechanism($authMechanism);
		$storage->setBackendOptions(['password' => 'testPassword']);
		$storage->setApplicableUsers($applicableUsers);
		$storage->setApplicableGroups($applicableGroups);

		$newStorage = $this->globalStoragesService->addStorage($storage);

		$storages = $this->service->getAllStorages();
		if ($isVisible) {
			$this->assertEquals(1, count($storages));
			$retrievedStorage = $this->service->getStorage($newStorage->getId());
			$this->assertEquals('/mountpoint', $retrievedStorage->getMountPoint());
		} else {
			$this->assertEquals(0, count($storages));
		}

	}

	/**
	 * @expectedException \DomainException
	 */
	public function testAddStorage($storageParams = null) {
		$backend = $this->backendService->getBackend('identifier:\OCA\Files_External\Lib\Backend\SMB');
		$authMechanism = $this->backendService->getAuthMechanism('identifier:\Auth\Mechanism');

		$storage = new StorageConfig(255);
		$storage->setMountPoint('mountpoint');
		$storage->setBackend($backend);
		$storage->setAuthMechanism($authMechanism);
		$storage->setBackendOptions(['password' => 'testPassword']);

		$this->service->addStorage($storage);
	}

	/**
	 * @expectedException \DomainException
	 */
	public function testUpdateStorage($storageParams = null) {
		$backend = $this->backendService->getBackend('identifier:\OCA\Files_External\Lib\Backend\SMB');
		$authMechanism = $this->backendService->getAuthMechanism('identifier:\Auth\Mechanism');

		$storage = new StorageConfig(255);
		$storage->setMountPoint('mountpoint');
		$storage->setBackend($backend);
		$storage->setAuthMechanism($authMechanism);
		$storage->setBackendOptions(['password' => 'testPassword']);

		$newStorage = $this->globalStoragesService->addStorage($storage);

		$retrievedStorage = $this->service->getStorage($newStorage->getId());
		$retrievedStorage->setMountPoint('abc');
		$this->service->updateStorage($retrievedStorage);
	}

	/**
	 * @expectedException \DomainException
	 */
	public function testNonExistingStorage() {
		parent::testNonExistingStorage();
	}

	/**
	 * @expectedException \DomainException
	 * @dataProvider deleteStorageDataProvider
	 */
	public function testDeleteStorage($backendOptions, $rustyStorageId, $expectedCountAfterDeletion) {
		$backend = $this->backendService->getBackend('identifier:\OCA\Files_External\Lib\Backend\SMB');
		$authMechanism = $this->backendService->getAuthMechanism('identifier:\Auth\Mechanism');

		$storage = new StorageConfig(255);
		$storage->setMountPoint('mountpoint');
		$storage->setBackend($backend);
		$storage->setAuthMechanism($authMechanism);
		$storage->setBackendOptions($backendOptions);

		$newStorage = $this->globalStoragesService->addStorage($storage);
		$id = $newStorage->getId();

		$this->service->removeStorage($id);
	}

	/**
	 * @expectedException \DomainException
	 */
	public function testDeleteUnexistingStorage() {
		parent::testDeleteUnexistingStorage();
	}

	public function getUniqueStoragesProvider() {
		return [
			// 'all' vs group
			[100, [], [], 100, [], [self::GROUP_ID], 2],
			[100, [], [self::GROUP_ID], 100, [], [], 1],

			// 'all' vs user
			[100, [], [], 100, [self::USER_ID], [], 2],
			[100, [self::USER_ID], [], 100, [], [], 1],

			// group vs user
			[100, [], [self::GROUP_ID], 100, [self::USER_ID], [], 2],
			[100, [self::USER_ID], [], 100, [], [self::GROUP_ID], 1],

			// group+user vs group
			[100, [], [self::GROUP_ID2], 100, [self::USER_ID], [self::GROUP_ID], 2],
			[100, [self::USER_ID], [self::GROUP_ID], 100, [], [self::GROUP_ID2], 1],

			// user vs 'all' (higher priority)
			[200, [], [], 100, [self::USER_ID], [], 2],
			[100, [self::USER_ID], [], 200, [], [], 1],

			// group vs group (higher priority)
			[100, [], [self::GROUP_ID2], 200, [], [self::GROUP_ID], 2],
			[200, [], [self::GROUP_ID], 100, [], [self::GROUP_ID2], 1],
		];
	}

	/**
	 * @dataProvider getUniqueStoragesProvider
	 */
	public function testGetUniqueStorages(
		$priority1, $applicableUsers1, $applicableGroups1,
		$priority2, $applicableUsers2, $applicableGroups2,
		$expectedPrecedence
	) {
		$backend = $this->backendService->getBackend('identifier:\OCA\Files_External\Lib\Backend\SMB');
		$backend->method('isVisibleFor')
			->willReturn(true);
		$authMechanism = $this->backendService->getAuthMechanism('identifier:\Auth\Mechanism');
		$authMechanism->method('isVisibleFor')
			->willReturn(true);

		$storage1 = new StorageConfig();
		$storage1->setMountPoint('mountpoint');
		$storage1->setBackend($backend);
		$storage1->setAuthMechanism($authMechanism);
		$storage1->setBackendOptions(['password' => 'testPassword']);
		$storage1->setPriority($priority1);
		$storage1->setApplicableUsers($applicableUsers1);
		$storage1->setApplicableGroups($applicableGroups1);

		$storage1 = $this->globalStoragesService->addStorage($storage1);

		$storage2 = new StorageConfig();
		$storage2->setMountPoint('mountpoint');
		$storage2->setBackend($backend);
		$storage2->setAuthMechanism($authMechanism);
		$storage2->setBackendOptions(['password' => 'testPassword']);
		$storage2->setPriority($priority2);
		$storage2->setApplicableUsers($applicableUsers2);
		$storage2->setApplicableGroups($applicableGroups2);

		$storage2 = $this->globalStoragesService->addStorage($storage2);

		$storages = $this->service->getUniqueStorages();
		$this->assertCount(1, $storages);

		if ($expectedPrecedence === 1) {
			$this->assertArrayHasKey($storage1->getID(), $storages);
		} elseif ($expectedPrecedence === 2) {
			$this->assertArrayHasKey($storage2->getID(), $storages);
		}
	}

	public function testGetStoragesBackendNotVisible() {
		// we don't test this here
		$this->assertTrue(true);
	}

	public function testGetStoragesAuthMechanismNotVisible() {
		// we don't test this here
		$this->assertTrue(true);
	}

	public function testHooksAddStorage($a = null, $b = null, $c = null) {
		// we don't test this here
		$this->assertTrue(true);
	}

	public function testHooksUpdateStorage($a = null, $b = null, $c = null, $d = null, $e = null) {
		// we don't test this here
		$this->assertTrue(true);
	}

	public function testHooksRenameMountPoint() {
		// we don't test this here
		$this->assertTrue(true);
	}

	public function testHooksDeleteStorage($a = null, $b = null, $c = null) {
		// we don't test this here
		$this->assertTrue(true);
	}

	public function testLegacyConfigConversionApplicableAll() {
		// we don't test this here
		$this->assertTrue(true);
	}

	public function testLegacyConfigConversionApplicableUserAndGroup() {
		// we don't test this here
		$this->assertTrue(true);
	}

	public function testReadLegacyConfigAndGenerateConfigId() {
		// we don't test this here
		$this->assertTrue(true);
	}

	public function testReadLegacyConfigNoAuthMechanism() {
		// we don't test this here
		$this->assertTrue(true);
	}

	public function testReadLegacyConfigClass() {
		// we don't test this here
		$this->assertTrue(true);
	}

	public function testReadEmptyMountPoint() {
		// we don't test this here
		$this->assertTrue(true);
	}

}
