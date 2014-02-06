<?php
/**
 * ownCloud
 *
 * @author Vincent Petry, Bjoern Schiessle
 * @copyright 2014 Vincent Petry <pvince81@owncloud.com>
 *            2014 Bjoern Schiessle <schiessle@owncloud.com>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
require_once __DIR__ . '/base.php';

class Test_Files_Sharing_Cache extends Test_Files_Sharing_Base {

	/**
	 * @var OC_FilesystemView
	 */
	public $user2View;

	function setUp() {
		parent::setUp();

		self::loginHelper(self::TEST_FILES_SHARING_API_USER1);

		$this->user2View = new \OC\Files\View('/'. self::TEST_FILES_SHARING_API_USER2 . '/files');

		// prepare user1's dir structure
		$this->view->mkdir('container');
		$this->view->mkdir('container/shareddir');
		$this->view->mkdir('container/shareddir/subdir');
		$this->view->mkdir('container/shareddir/emptydir');

		$textData = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$this->view->file_put_contents('container/not shared.txt', $textData);
		$this->view->file_put_contents('container/shared single file.txt', $textData);
		$this->view->file_put_contents('container/shareddir/bar.txt', $textData);
		$this->view->file_put_contents('container/shareddir/subdir/another.txt', $textData);
		$this->view->file_put_contents('container/shareddir/subdir/another too.txt', $textData);
		$this->view->file_put_contents('container/shareddir/subdir/not a text file.xml', '<xml></xml>');

		list($this->ownerStorage, $internalPath) = $this->view->resolvePath('');
		$this->ownerCache = $this->ownerStorage->getCache();
		$this->ownerStorage->getScanner()->scan('');

		// share "shareddir" with user2
		$fileinfo = $this->view->getFileInfo('container/shareddir');
		\OCP\Share::shareItem('folder', $fileinfo['fileid'], \OCP\Share::SHARE_TYPE_USER,
			self::TEST_FILES_SHARING_API_USER2, 31);

		$fileinfo = $this->view->getFileInfo('container/shared single file.txt');
		\OCP\Share::shareItem('file', $fileinfo['fileid'], \OCP\Share::SHARE_TYPE_USER,
			self::TEST_FILES_SHARING_API_USER2, 31);

		// login as user2
		self::loginHelper(self::TEST_FILES_SHARING_API_USER2);

		// retrieve the shared storage
		$secondView = new \OC\Files\View('/' . self::TEST_FILES_SHARING_API_USER2);
		list($this->sharedStorage, $internalPath) = $secondView->resolvePath('files/Shared/shareddir');
		$this->sharedCache = $this->sharedStorage->getCache();
	}

	function tearDown() {
		$this->sharedCache->clear();

		self::loginHelper(self::TEST_FILES_SHARING_API_USER1);

		$fileinfo = $this->view->getFileInfo('container/shareddir');
		\OCP\Share::unshare('folder', $fileinfo['fileid'], \OCP\Share::SHARE_TYPE_USER,
			self::TEST_FILES_SHARING_API_USER2);

		$fileinfo = $this->view->getFileInfo('container/shared single file.txt');
		\OCP\Share::unshare('file', $fileinfo['fileid'], \OCP\Share::SHARE_TYPE_USER,
			self::TEST_FILES_SHARING_API_USER2);

		$this->view->deleteAll('container');

		$this->ownerCache->clear();

		parent::tearDown();
	}

	/**
	 * Test searching by mime type
	 */
	function testSearchByMime() {
		$results = $this->sharedStorage->getCache()->searchByMime('text');
		$check = array(
				array(
					'name' => 'shared single file.txt',
					'path' => 'shared single file.txt'
				),
				array(
					'name' => 'bar.txt',
					'path' => 'shareddir/bar.txt'
				),
				array(
					'name' => 'another too.txt',
					'path' => 'shareddir/subdir/another too.txt'
				),
				array(
					'name' => 'another.txt',
					'path' => 'shareddir/subdir/another.txt'
				),
			);
		$this->verifyFiles($check, $results);

		$results2 = $this->sharedStorage->getCache()->searchByMime('text/plain');

		$this->verifyFiles($check, $results);
	}

	function testGetFolderContentsInRoot() {
		$results = $this->user2View->getDirectoryContent('/Shared/');

		$this->verifyFiles(
			array(
				array(
					'name' => 'shareddir',
					'path' => '/shareddir',
					'mimetype' => 'httpd/unix-directory',
					'usersPath' => 'files/Shared/shareddir'
				),
				array(
					'name' => 'shared single file.txt',
					'path' => '/shared single file.txt',
					'mimetype' => 'text/plain',
					'usersPath' => 'files/Shared/shared single file.txt'
				),
			),
			$results
		);
	}

	function testGetFolderContentsInSubdir() {
		//$results = $this->sharedStorage->getCache()->getFolderContents('shareddir');
		$results = $this->user2View->getDirectoryContent('/Shared/shareddir');

		$this->verifyFiles(
			array(
				array(
					'name' => 'bar.txt',
					'path' => 'files/container/shareddir/bar.txt',
					'mimetype' => 'text/plain',
					'usersPath' => 'files/Shared/shareddir/bar.txt'
				),
				array(
					'name' => 'emptydir',
					'path' => 'files/container/shareddir/emptydir',
					'mimetype' => 'httpd/unix-directory',
					'usersPath' => 'files/Shared/shareddir/emptydir'
				),
				array(
					'name' => 'subdir',
					'path' => 'files/container/shareddir/subdir',
					'mimetype' => 'httpd/unix-directory',
					'usersPath' => 'files/Shared/shareddir/subdir'
				),
			),
			$results
		);
	}

	function testGetFolderContentsWhenSubSubdirShared() {
		self::loginHelper(self::TEST_FILES_SHARING_API_USER1);

		$fileinfo = $this->view->getFileInfo('container/shareddir/subdir');
		\OCP\Share::shareItem('folder', $fileinfo['fileid'], \OCP\Share::SHARE_TYPE_USER,
			self::TEST_FILES_SHARING_API_USER3, 31);

		self::loginHelper(self::TEST_FILES_SHARING_API_USER3);

		$thirdView = new \OC\Files\View('/' . self::TEST_FILES_SHARING_API_USER3 . '/files');
		//list($this->sharedStorage, $internalPath) = $thirdView->resolvePath('files/Shared');
		$results = $thirdView->getDirectoryContent('/Shared/subdir');

		$this->verifyFiles(
			array(
				array(
					'name' => 'another too.txt',
					'path' => 'files/container/shareddir/subdir/another too.txt',
					//'path' => '/subdir/another too.txt',
					'mimetype' => 'text/plain',
					'usersPath' => 'files/Shared/subdir/another too.txt'
				),
				array(
					'name' => 'another.txt',
					'path' => 'files/container/shareddir/subdir/another.txt',
					//'path' => '/subdir/another.txt',
					'mimetype' => 'text/plain',
					'usersPath' => 'files/Shared/subdir/another.txt'
				),
				array(
					'name' => 'not a text file.xml',
					'path' => 'files/container/shareddir/subdir/not a text file.xml',
					//'path' => '/subdir/not a text file.xml',
					'mimetype' => 'application/xml',
					'usersPath' => 'files/Shared/subdir/not a text file.xml'
				),
			),
			$results
		);

		self::loginHelper(self::TEST_FILES_SHARING_API_USER1);

		\OCP\Share::unshare('folder', $fileinfo['fileid'], \OCP\Share::SHARE_TYPE_USER,
			self::TEST_FILES_SHARING_API_USER3);
	}

	/**
	 * Checks that all provided attributes exist in the files list,
	 * only the values provided in $examples will be used to check against
	 * the file list. The files order also needs to be the same.
	 *
	 * @param array $examples array of example files
	 * @param array $files array of files
	 */
	private function verifyFiles($examples, $files) {
		$this->assertEquals(count($examples), count($files));
		foreach ($files as $i => $file) {
			foreach ($examples[$i] as $key => $value) {
				$this->assertEquals($value, $file[$key]);
			}
		}
	}
}
