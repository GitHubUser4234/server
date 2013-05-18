<?php
/**
 * Copyright (c) 2012 Sam Tuke <samtuke@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

require_once realpath( dirname(__FILE__).'/../../../lib/base.php' );
require_once realpath( dirname(__FILE__).'/../lib/crypt.php' );
require_once realpath( dirname(__FILE__).'/../lib/keymanager.php' );
require_once realpath( dirname(__FILE__).'/../lib/proxy.php' );
require_once realpath( dirname(__FILE__).'/../lib/stream.php' );
require_once realpath( dirname(__FILE__).'/../lib/util.php' );
require_once realpath( dirname(__FILE__).'/../lib/helper.php' );
require_once realpath( dirname(__FILE__).'/../appinfo/app.php' );

use OCA\Encryption;

class Test_Encryption_Keymanager extends \PHPUnit_Framework_TestCase {
	
	function setUp() {
        // reset backend
        \OC_User::clearBackends();
        \OC_User::useBackend('database');

		\OC_FileProxy::$enabled = false;
		
		// set content for encrypting / decrypting in tests
		$this->dataLong = file_get_contents( realpath( dirname(__FILE__).'/../lib/crypt.php' ) );
		$this->dataShort = 'hats';
		$this->dataUrl = realpath( dirname(__FILE__).'/../lib/crypt.php' );
		$this->legacyData = realpath( dirname(__FILE__).'/legacy-text.txt' );
		$this->legacyEncryptedData = realpath( dirname(__FILE__).'/legacy-encrypted-text.txt' );
		$this->randomKey = Encryption\Crypt::generateKey();
		
		$keypair = Encryption\Crypt::createKeypair();
		$this->genPublicKey =  $keypair['publicKey'];
		$this->genPrivateKey = $keypair['privateKey'];

        $this->view = new \OC_FilesystemView( '/' );

        \OC_User::setUserId( 'admin' );
        $this->userId = 'admin';
        $this->pass = 'admin';

        $userHome = \OC_User::getHome($this->userId);
        $this->dataDir = str_replace('/'.$this->userId, '', $userHome);

        // Filesystem related hooks
        \OCA\Encryption\Helper::registerFilesystemHooks();

        \OC_FileProxy::register(new OCA\Encryption\Proxy());

		// remember files_trashbin state
		$this->stateFilesTrashbin = OC_App::isEnabled('files_trashbin');

		// we don't want to tests with app files_trashbin enabled
		\OC_App::disable('files_trashbin');

        \OC_Util::tearDownFS();
        \OC_User::setUserId('');
        \OC\Files\Filesystem::tearDown();
        \OC_Util::setupFS($this->userId);
        \OC_User::setUserId($this->userId);

        $params['uid'] = $this->userId;
        $params['password'] = $this->pass;
        OCA\Encryption\Hooks::login($params);
	}
	
	function tearDown(){
	
		\OC_FileProxy::$enabled = true;
		\OC_FileProxy::clearProxies();

		// reset app files_trashbin
		if ($this->stateFilesTrashbin) {
			OC_App::enable('files_trashbin');
		} else {
			OC_App::disable('files_trashbin');
		}
	}

	function testGetPrivateKey() {
	
		$key = Encryption\Keymanager::getPrivateKey( $this->view, $this->userId );

        $privateKey = Encryption\Crypt::symmetricDecryptFileContent( $key, $this->pass);

		$res = openssl_pkey_get_private($privateKey);

		$this->assertTrue(is_resource($res));

		$sslInfo = openssl_pkey_get_details($res);

		$this->assertArrayHasKey('key', $sslInfo);
	
	}
	
	function testGetPublicKey() {

		$publiceKey = Encryption\Keymanager::getPublicKey( $this->view, $this->userId );

		$res = openssl_pkey_get_public($publiceKey);

		$this->assertTrue(is_resource($res));

		$sslInfo = openssl_pkey_get_details($res);

		$this->assertArrayHasKey('key', $sslInfo);
	}
	
	function testSetFileKey() {
	
		# NOTE: This cannot be tested until we are able to break out 
		# of the FileSystemView data directory root
	
		$key = Encryption\Crypt::symmetricEncryptFileContentKeyfile( $this->randomKey, 'hat' );
		
		$file = 'unittest-'.time().'.txt';

        // Disable encryption proxy to prevent recursive calls
        $proxyStatus = \OC_FileProxy::$enabled;
        \OC_FileProxy::$enabled = false;

        $this->view->file_put_contents($this->userId . '/files/' . $file, $key['encrypted']);

        // Re-enable proxy - our work is done
        \OC_FileProxy::$enabled = $proxyStatus;

		//$view = new \OC_FilesystemView( '/' . $this->userId . '/files_encryption/keyfiles' );
		Encryption\Keymanager::setFileKey( $this->view, $file, $this->userId, $key['key'] );

		// Disable encryption proxy to prevent recursive calls
		$proxyStatus = \OC_FileProxy::$enabled;
		\OC_FileProxy::$enabled = true;

		// cleanup
		$this->view->unlink('/'.$this->userId . '/files/' . $file);

		// Re-enable proxy - our work is done
		\OC_FileProxy::$enabled = $proxyStatus;
	
	}
	
// 	/**
// 	 * @depends testGetPrivateKey
// 	 */
// 	function testGetPrivateKey_decrypt() {
// 	
// 		$key = Encryption\Keymanager::getPrivateKey( $this->view, $this->userId );
// 		
// 		# TODO: replace call to Crypt with a mock object?
// 		$decrypted = Encryption\Crypt::symmetricDecryptFileContent( $key, $this->passphrase );
// 		
// 		$this->assertEquals( 1704, strlen( $decrypted ) );
// 		
// 		$this->assertEquals( '-----BEGIN PRIVATE KEY-----', substr( $decrypted, 0, 27 ) );
// 	
// 	}
	
	function testGetUserKeys() {
	
		$keys = Encryption\Keymanager::getUserKeys( $this->view, $this->userId );

		$resPublic = openssl_pkey_get_public($keys['publicKey']);

		$this->assertTrue(is_resource($resPublic));

		$sslInfoPublic = openssl_pkey_get_details($resPublic);

		$this->assertArrayHasKey('key', $sslInfoPublic);

		$privateKey = Encryption\Crypt::symmetricDecryptFileContent( $keys['privateKey'], $this->pass);

		$resPrivate = openssl_pkey_get_private($privateKey);

		$this->assertTrue(is_resource($resPrivate));

		$sslInfoPrivate = openssl_pkey_get_details($resPrivate);

		$this->assertArrayHasKey('key', $sslInfoPrivate);
	}
}
