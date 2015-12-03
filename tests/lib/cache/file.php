<?php
/**
 * ownCloud
 *
 * @author Robin Appelman
 * @copyright 2012 Robin Appelman icewind@owncloud.com
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

namespace Test\Cache;

/**
 * Class FileCache
 *
 * @group DB
 *
 * @package Test\Cache
 */
class FileCache extends \Test_Cache {
	/**
	 * @var string
	 * */
	private $user;
	/**
	 * @var string
	 * */
	private $datadir;
	/**
	 * @var \OC\Files\Storage\Storage
	 * */
	private $storage;
	/**
	 * @var \OC\Files\View
	 * */
	private $rootView;

	function skip() {
		//$this->skipUnless(OC_User::isLoggedIn());
	}

	protected function setUp() {
		parent::setUp();

		//clear all proxies and hooks so we can do clean testing
		\OC_Hook::clear('OC_Filesystem');

		//set up temporary storage
		$this->storage = \OC\Files\Filesystem::getStorage('/');
		\OC\Files\Filesystem::clearMounts();
		$storage = new \OC\Files\Storage\Temporary(array());
		\OC\Files\Filesystem::mount($storage,array(),'/');
		$datadir = str_replace('local::', '', $storage->getId());
		$config = \OC::$server->getConfig();
		$this->datadir = $config->getSystemValue('cachedirectory', \OC::$SERVERROOT.'/data/cache');
		$config->setSystemValue('cachedirectory', $datadir);

		\OC_User::clearBackends();
		\OC_User::useBackend(new \Test\Util\User\Dummy());

		//login
		\OC_User::createUser('test', 'test');

		$this->user = \OC_User::getUser();
		\OC_User::setUserId('test');

		//set up the users dir
		$this->rootView = new \OC\Files\View('');
		$this->rootView->mkdir('/test');

		$this->instance=new \OC\Cache\File();

		// forces creation of cache folder for subsequent tests
		$this->instance->set('hack', 'hack');
	}

	protected function tearDown() {
		$this->instance->remove('hack', 'hack');

		\OC_User::setUserId($this->user);
		\OC::$server->getConfig()->setSystemValue('cachedirectory', $this->datadir);

		// Restore the original mount point
		\OC\Files\Filesystem::clearMounts();
		\OC\Files\Filesystem::mount($this->storage, array(), '/');

		parent::tearDown();
	}

	private function setupMockStorage() {
		$mockStorage = $this->getMock(
			'\OC\Files\Storage\Local',
			['filemtime', 'unlink'],
			[['datadir' => \OC::$server->getTempManager()->getTemporaryFolder()]]
		);

		\OC\Files\Filesystem::mount($mockStorage, array(), '/test/cache');

		return $mockStorage;
	}

	public function testGarbageCollectOldKeys() {
		$mockStorage = $this->setupMockStorage();

		$mockStorage->expects($this->atLeastOnce())
			->method('filemtime')
			->will($this->returnValue(100));
		$mockStorage->expects($this->once())
			->method('unlink')
			->with('key1')
			->will($this->returnValue(true));

		$this->instance->set('key1', 'value1');
		$this->instance->gc();
	}

	public function testGarbageCollectLeaveRecentKeys() {
		$mockStorage = $this->setupMockStorage();

		$mockStorage->expects($this->atLeastOnce())
			->method('filemtime')
			->will($this->returnValue(time() + 3600));
		$mockStorage->expects($this->never())
			->method('unlink')
			->with('key1');
		$this->instance->set('key1', 'value1');
		$this->instance->gc();
	}

	public function lockExceptionProvider() {
		return [
			[new \OCP\Lock\LockedException('key1')],
			[new \OCP\Files\LockNotAcquiredException('key1', 1)],
		];
	}

	/**
	 * @dataProvider lockExceptionProvider
	 */
	public function testGarbageCollectIgnoreLockedKeys($testException) {
		$mockStorage = $this->setupMockStorage();

		$mockStorage->expects($this->atLeastOnce())
			->method('filemtime')
			->will($this->returnValue(100));
		$mockStorage->expects($this->atLeastOnce())
			->method('unlink')
			->will($this->onConsecutiveCalls(
				$this->throwException($testException),
				$this->returnValue(true)
			));

		$this->instance->set('key1', 'value1');
		$this->instance->set('key2', 'value2');

		$this->instance->gc();
	}
}
