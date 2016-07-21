<?php
/**
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 *
 * @author Björn Schießle <bjoern@schiessle.org>
 * @author Joas Schilling <coding@schilljs.com>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Robin Appelman <icewind@owncloud.com>
 * @author Roeland Jago Douma <roeland@famdouma.nl>
 * @author Thomas Müller <thomas.mueller@tmit.eu>
 * @author Vincent Petry <pvince81@owncloud.com>
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

namespace OCA\Files_Sharing\Tests;

/**
 * Class SharedMountTest
 *
 * @group DB
 */
class SharedMountTest extends TestCase {

	protected function setUp() {
		parent::setUp();

		$this->folder = '/folder_share_storage_test';

		$this->filename = '/share-api-storage.txt';


		$this->view->mkdir($this->folder);

		// save file with content
		$this->view->file_put_contents($this->filename, "root file");
		$this->view->file_put_contents($this->folder . $this->filename, "file in subfolder");
	}

	protected function tearDown() {
		if ($this->view) {
			if ($this->view->file_exists($this->folder)) {
				$this->view->unlink($this->folder);
			}
			if ($this->view->file_exists($this->filename)) {
				$this->view->unlink($this->filename);
			}
		}

		parent::tearDown();
	}

	/**
	 * test if the mount point moves up if the parent folder no longer exists
	 */
	public function testShareMountLoseParentFolder() {

		// share to user
		$share = $this->share(
			\OCP\Share::SHARE_TYPE_USER,
			$this->folder,
			self::TEST_FILES_SHARING_API_USER1,
			self::TEST_FILES_SHARING_API_USER2,
			\OCP\Constants::PERMISSION_ALL);

		$share->setTarget('/foo/bar' . $this->folder);
		$this->shareManager->moveShare($share, self::TEST_FILES_SHARING_API_USER2);

		$share = $this->shareManager->getShareById($share->getFullId());
		$this->assertSame('/foo/bar' . $this->folder, $share->getTarget());

		self::loginHelper(self::TEST_FILES_SHARING_API_USER2);
		// share should have moved up

		$share = $this->shareManager->getShareById($share->getFullId());
		$this->assertSame($this->folder, $share->getTarget());

		//cleanup
		self::loginHelper(self::TEST_FILES_SHARING_API_USER1);
		$this->shareManager->deleteShare($share);
		$this->view->unlink($this->folder);
	}

	/**
	 * @medium
	 */
	public function testDeleteParentOfMountPoint() {
		// share to user
		$share = $this->share(
			\OCP\Share::SHARE_TYPE_USER,
			$this->folder,
			self::TEST_FILES_SHARING_API_USER1,
			self::TEST_FILES_SHARING_API_USER2,
			\OCP\Constants::PERMISSION_ALL
		);

		self::loginHelper(self::TEST_FILES_SHARING_API_USER2);
		$user2View = new \OC\Files\View('/' . self::TEST_FILES_SHARING_API_USER2 . '/files');
		$this->assertTrue($user2View->file_exists($this->folder));

		// create a local folder
		$result = $user2View->mkdir('localfolder');
		$this->assertTrue($result);

		// move mount point to local folder
		$result = $user2View->rename($this->folder, '/localfolder/' . $this->folder);
		$this->assertTrue($result);

		// mount point in the root folder should no longer exist
		$this->assertFalse($user2View->is_dir($this->folder));

		// delete the local folder
		$result = $user2View->unlink('/localfolder');
		$this->assertTrue($result);

		//enforce reload of the mount points
		self::loginHelper(self::TEST_FILES_SHARING_API_USER2);

		//mount point should be back at the root
		$this->assertTrue($user2View->is_dir($this->folder));

		//cleanup
		self::loginHelper(self::TEST_FILES_SHARING_API_USER1);
		$this->view->unlink($this->folder);
	}

	public function testMoveSharedFile() {
		$share = $this->share(
			\OCP\Share::SHARE_TYPE_USER,
			$this->filename,
			self::TEST_FILES_SHARING_API_USER1,
			self::TEST_FILES_SHARING_API_USER2,
			\OCP\Constants::PERMISSION_READ | \OCP\Constants::PERMISSION_UPDATE | \OCP\Constants::PERMISSION_SHARE
		);

		self::loginHelper(self::TEST_FILES_SHARING_API_USER2);

		\OC\Files\Filesystem::rename($this->filename, $this->filename . '_renamed');

		$this->assertTrue(\OC\Files\Filesystem::file_exists($this->filename . '_renamed'));
		$this->assertFalse(\OC\Files\Filesystem::file_exists($this->filename));

		self::loginHelper(self::TEST_FILES_SHARING_API_USER1);
		$this->assertTrue(\OC\Files\Filesystem::file_exists($this->filename));
		$this->assertFalse(\OC\Files\Filesystem::file_exists($this->filename . '_renamed'));

		// rename back to original name
		self::loginHelper(self::TEST_FILES_SHARING_API_USER2);
		\OC\Files\Filesystem::rename($this->filename . '_renamed', $this->filename);
		$this->assertFalse(\OC\Files\Filesystem::file_exists($this->filename . '_renamed'));
		$this->assertTrue(\OC\Files\Filesystem::file_exists($this->filename));

		//cleanup
		$this->shareManager->deleteShare($share);
	}

	/**
	 * share file with a group if a user renames the file the filename should not change
	 * for the other users
	 */
	public function testMoveGroupShare () {
		\OC_Group::createGroup('testGroup');
		\OC_Group::addToGroup(self::TEST_FILES_SHARING_API_USER1, 'testGroup');
		\OC_Group::addToGroup(self::TEST_FILES_SHARING_API_USER2, 'testGroup');
		\OC_Group::addToGroup(self::TEST_FILES_SHARING_API_USER3, 'testGroup');

		$fileinfo = $this->view->getFileInfo($this->filename);
		$share = $this->share(
			\OCP\Share::SHARE_TYPE_GROUP,
			$this->filename,
			self::TEST_FILES_SHARING_API_USER1,
			'testGroup',
			\OCP\Constants::PERMISSION_READ | \OCP\Constants::PERMISSION_UPDATE | \OCP\Constants::PERMISSION_SHARE
		);

		self::loginHelper(self::TEST_FILES_SHARING_API_USER2);

		$this->assertTrue(\OC\Files\Filesystem::file_exists($this->filename));

		\OC\Files\Filesystem::rename($this->filename, "newFileName");

		$this->assertTrue(\OC\Files\Filesystem::file_exists('newFileName'));
		$this->assertFalse(\OC\Files\Filesystem::file_exists($this->filename));

		self::loginHelper(self::TEST_FILES_SHARING_API_USER3);
		$this->assertTrue(\OC\Files\Filesystem::file_exists($this->filename));
		$this->assertFalse(\OC\Files\Filesystem::file_exists("newFileName"));

		self::loginHelper(self::TEST_FILES_SHARING_API_USER3);
		$this->assertTrue(\OC\Files\Filesystem::file_exists($this->filename));
		$this->assertFalse(\OC\Files\Filesystem::file_exists("newFileName"));

		//cleanup
		self::loginHelper(self::TEST_FILES_SHARING_API_USER1);
		$this->shareManager->deleteShare($share);
		\OC_Group::removeFromGroup(self::TEST_FILES_SHARING_API_USER1, 'testGroup');
		\OC_Group::removeFromGroup(self::TEST_FILES_SHARING_API_USER2, 'testGroup');
		\OC_Group::removeFromGroup(self::TEST_FILES_SHARING_API_USER3, 'testGroup');
	}

	/**
	 * @dataProvider dataProviderTestStripUserFilesPath
	 * @param string $path
	 * @param string $expectedResult
	 * @param bool $exception if a exception is expected
	 */
	public function testStripUserFilesPath($path, $expectedResult, $exception) {
		$testClass = new DummyTestClassSharedMount(null, null);
		try {
			$result = $testClass->stripUserFilesPathDummy($path);
			$this->assertSame($expectedResult, $result);
		} catch (\Exception $e) {
			if ($exception) {
				$this->assertSame(10, $e->getCode());
			} else {
				$this->assertTrue(false, "Exception catched, but expected: " . $expectedResult);
			}
		}
	}

	public function dataProviderTestStripUserFilesPath() {
		return array(
			array('/user/files/foo.txt', '/foo.txt', false),
			array('/user/files/folder/foo.txt', '/folder/foo.txt', false),
			array('/data/user/files/foo.txt', null, true),
			array('/data/user/files/', null, true),
			array('/files/foo.txt', null, true),
			array('/foo.txt', null, true),
		);
	}

	public function dataPermissionMovedGroupShare() {
		$data = [];

		$powerset = function($permissions) {
			$results = [\OCP\Constants::PERMISSION_READ];

			foreach ($permissions as $permission) {
				foreach ($results as $combination) {
					$results[] = $permission | $combination;
				}
			}
			return $results;
		};

		//Generate file permissions
		$permissions = [
			\OCP\Constants::PERMISSION_UPDATE,
			\OCP\Constants::PERMISSION_SHARE,
		];

		$allPermissions = $powerset($permissions);

		foreach ($allPermissions as $before) {
			foreach ($allPermissions as $after) {
				if ($before === $after) { continue; }

				$data[] = [
					'file', 
					$before,
					$after,
				];
			}
		}

		//Generate folder permissions
		$permissions = [
			\OCP\Constants::PERMISSION_UPDATE,
			\OCP\Constants::PERMISSION_CREATE,
			\OCP\Constants::PERMISSION_SHARE,
			\OCP\Constants::PERMISSION_DELETE,
		];

		$allPermissions = $powerset($permissions);

		foreach ($allPermissions as $before) {
			foreach ($allPermissions as $after) {
				if ($before === $after) { continue; }

				$data[] = [
					'folder',
					$before,
					$after,
				];
			}
		}

		return $data;
	}



	/**
	 * moved mountpoints of a group share should keep the same permission as their parent group share.
	 * See #15253
	 *
	 * @dataProvider dataPermissionMovedGroupShare
	 */
	function testPermissionMovedGroupShare($type, $beforePerm, $afterPerm) {

		if ($type === 'file') {
			$path = $this->filename;
		} else if ($type === 'folder') {
			$path = $this->folder;
		}

		\OC_Group::createGroup('testGroup');
		\OC_Group::addToGroup(self::TEST_FILES_SHARING_API_USER1, 'testGroup');
		\OC_Group::addToGroup(self::TEST_FILES_SHARING_API_USER2, 'testGroup');
		\OC_Group::addToGroup(self::TEST_FILES_SHARING_API_USER3, 'testGroup');

		// Share item with group
		$share = $this->share(
			\OCP\Share::SHARE_TYPE_GROUP,
			$path,
			self::TEST_FILES_SHARING_API_USER1,
			'testGroup',
			$beforePerm
		);

		// Login as user 2 and verify the item exists
		self::loginHelper(self::TEST_FILES_SHARING_API_USER2);
		$this->assertTrue(\OC\Files\Filesystem::file_exists($path));
		$result = $this->shareManager->getShareById($share->getFullId(), self::TEST_FILES_SHARING_API_USER2);
		$this->assertEquals($beforePerm, $result->getPermissions());

		// Now move the item forcing a new entry in the share table
		\OC\Files\Filesystem::rename($path, "newPath");
		$this->assertTrue(\OC\Files\Filesystem::file_exists('newPath'));
		$this->assertFalse(\OC\Files\Filesystem::file_exists($path));

		// change permissions
		$share->setPermissions($afterPerm);
		$this->shareManager->updateShare($share);

		// Login as user 3 and verify that the permissions are changed
		self::loginHelper(self::TEST_FILES_SHARING_API_USER3);
		$result = $this->shareManager->getShareById($share->getFullId(), self::TEST_FILES_SHARING_API_USER3);
		$this->assertNotEmpty($result);
		$this->assertEquals($afterPerm, $result->getPermissions());

		// Login as user 2 and verify that the permissions are changed
		self::loginHelper(self::TEST_FILES_SHARING_API_USER2);
		$result = $this->shareManager->getShareById($share->getFullId(), self::TEST_FILES_SHARING_API_USER2);
		$this->assertNotEmpty($result);
		$this->assertEquals($afterPerm, $result->getPermissions());
		$this->assertEquals('/newPath', $result->getTarget());

		//cleanup
		self::loginHelper(self::TEST_FILES_SHARING_API_USER1);
		$this->shareManager->deleteShare($share);
		\OC_Group::removeFromGroup(self::TEST_FILES_SHARING_API_USER1, 'testGroup');
		\OC_Group::removeFromGroup(self::TEST_FILES_SHARING_API_USER2, 'testGroup');
		\OC_Group::removeFromGroup(self::TEST_FILES_SHARING_API_USER3, 'testGroup');
	}

	/**
	 * If the permissions on a group share are upgraded be sure to still respect 
	 * removed shares by a member of that group
	 */
	function testPermissionUpgradeOnUserDeletedGroupShare() {
		\OC_Group::createGroup('testGroup');
		\OC_Group::addToGroup(self::TEST_FILES_SHARING_API_USER1, 'testGroup');
		\OC_Group::addToGroup(self::TEST_FILES_SHARING_API_USER2, 'testGroup');
		\OC_Group::addToGroup(self::TEST_FILES_SHARING_API_USER3, 'testGroup');

		$connection = \OC::$server->getDatabaseConnection();

		// Share item with group
		$fileinfo = $this->view->getFileInfo($this->folder);
		$share = $this->share(
			\OCP\Share::SHARE_TYPE_GROUP,
			$this->folder,
			self::TEST_FILES_SHARING_API_USER1,
			'testGroup',
			\OCP\Constants::PERMISSION_READ
		);

		// Login as user 2 and verify the item exists
		self::loginHelper(self::TEST_FILES_SHARING_API_USER2);
		$this->assertTrue(\OC\Files\Filesystem::file_exists($this->folder));
		$result = $this->shareManager->getShareById($share->getFullId(), self::TEST_FILES_SHARING_API_USER2);
		$this->assertNotEmpty($result);
		$this->assertEquals(\OCP\Constants::PERMISSION_READ, $result->getPermissions());

		// Delete the share
		$this->assertTrue(\OC\Files\Filesystem::rmdir($this->folder));
		$this->assertFalse(\OC\Files\Filesystem::file_exists($this->folder));

		// Verify we do not get a share
		$result = $this->shareManager->getShareById($share->getFullId(), self::TEST_FILES_SHARING_API_USER2);
		$this->assertEquals(0, $result->getPermissions());

		// Login as user 1 again and change permissions
		self::loginHelper(self::TEST_FILES_SHARING_API_USER1);
		$share->setPermissions(\OCP\Constants::PERMISSION_ALL);
		$share = $this->shareManager->updateShare($share);

		// Login as user 2 and verify 
		self::loginHelper(self::TEST_FILES_SHARING_API_USER2);
		$this->assertFalse(\OC\Files\Filesystem::file_exists($this->folder));
		$result = $this->shareManager->getShareById($share->getFullId(), self::TEST_FILES_SHARING_API_USER2);
		$this->assertEquals(0, $result->getPermissions());

		$this->shareManager->deleteShare($share);

		//cleanup
		self::loginHelper(self::TEST_FILES_SHARING_API_USER1);
		\OC_Group::removeFromGroup(self::TEST_FILES_SHARING_API_USER1, 'testGroup');
		\OC_Group::removeFromGroup(self::TEST_FILES_SHARING_API_USER2, 'testGroup');
		\OC_Group::removeFromGroup(self::TEST_FILES_SHARING_API_USER3, 'testGroup');
	}

}

class DummyTestClassSharedMount extends \OCA\Files_Sharing\SharedMount {
	public function __construct($storage, $mountpoint, $arguments = null, $loader = null){
		// noop
	}

	public function stripUserFilesPathDummy($path) {
		return $this->stripUserFilesPath($path);
	}
}
