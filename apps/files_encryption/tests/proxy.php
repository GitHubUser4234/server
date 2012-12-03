<?php
/**
 * Copyright (c) 2012 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

class Test_CryptProxy extends UnitTestCase {
	private $oldConfig;
	private $oldKey;

	public function setUp() {
		$user=OC_User::getUser();

		$this->oldConfig=OCP\Config::getAppValue('files_encryption','enable_encryption','true');
		OCP\Config::setAppValue('files_encryption','enable_encryption','true');
		$this->oldKey=isset($_SESSION['enckey'])?$_SESSION['enckey']:null;


		//set testing key
		$_SESSION['enckey']=md5(time());

		//clear all proxies and hooks so we can do clean testing
		OC_FileProxy::clearProxies();
		OC_Hook::clear('OC_Filesystem');

		//enable only the encryption hook
		OC_FileProxy::register(new OC_FileProxy_Encryption());

		//set up temporary storage
		\OC\Files\Filesystem::clearMounts();
		\OC\Files\Filesystem::mount('\OC\Files\Storage\Temporary' ,array(), '/');

		\OC\Files\Filesystem::init('/'.$user.'/files');

		//set up the users home folder in the temp storage
		$rootView=new \OC\Files\View('');
		$rootView->mkdir('/'.$user);
		$rootView->mkdir('/'.$user.'/files');
	}

	public function tearDown() {
		OCP\Config::setAppValue('files_encryption', 'enable_encryption', $this->oldConfig);
		if ( ! is_null($this->oldKey)) {
			$_SESSION['enckey']=$this->oldKey;
		}
	}

	public function testSimple() {
		$file=OC::$SERVERROOT.'/3rdparty/MDB2.php';
		$original=file_get_contents($file);

		\OC\Files\Filesystem::file_put_contents('/file',$original);

		OC_FileProxy::$enabled=false;
		$stored=\OC\Files\Filesystem::file_get_contents('/file');
		OC_FileProxy::$enabled=true;

		$fromFile=\OC\Files\Filesystem::file_get_contents('/file');
		$this->assertNotEqual($original,$stored);
		$this->assertEqual(strlen($original), strlen($fromFile));
		$this->assertEqual($original,$fromFile);

	}

	public function testView() {
		$file=OC::$SERVERROOT.'/3rdparty/MDB2.php';
		$original=file_get_contents($file);

		$rootView=new \OC\Files\View('');
		$view=new \OC\Files\View('/'.OC_User::getUser());
		$userDir='/'.OC_User::getUser().'/files';

		$rootView->file_put_contents($userDir.'/file',$original);

		OC_FileProxy::$enabled=false;
		$stored=$rootView->file_get_contents($userDir.'/file');
		OC_FileProxy::$enabled=true;

		$this->assertNotEqual($original,$stored);
		$fromFile=$rootView->file_get_contents($userDir.'/file');
		$this->assertEqual($original,$fromFile);

		$fromFile=$view->file_get_contents('files/file');
		$this->assertEqual($original,$fromFile);
	}

	public function testBinary() {
		$file=__DIR__.'/binary';
		$original=file_get_contents($file);

		\OC\Files\Filesystem::file_put_contents('/file',$original);

		OC_FileProxy::$enabled=false;
		$stored=\OC\Files\Filesystem::file_get_contents('/file');
		OC_FileProxy::$enabled=true;

		$fromFile=\OC\Files\Filesystem::file_get_contents('/file');
		$this->assertNotEqual($original,$stored);
		$this->assertEqual(strlen($original), strlen($fromFile));
		$this->assertEqual($original,$fromFile);

		$file=__DIR__.'/zeros';
		$original=file_get_contents($file);

		\OC\Files\Filesystem::file_put_contents('/file',$original);

		OC_FileProxy::$enabled=false;
		$stored=\OC\Files\Filesystem::file_get_contents('/file');
		OC_FileProxy::$enabled=true;

		$fromFile=\OC\Files\Filesystem::file_get_contents('/file');
		$this->assertNotEqual($original,$stored);
		$this->assertEqual(strlen($original), strlen($fromFile));
	}
}
