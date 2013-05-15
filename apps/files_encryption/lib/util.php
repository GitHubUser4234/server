<?php
/**
 * ownCloud
 *
 * @author Sam Tuke, Frank Karlitschek
 * @copyright 2012 Sam Tuke <samtuke@owncloud.com>, 
 * Frank Karlitschek <frank@owncloud.org>
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

# Bugs
# ----
# Sharing a file to a user without encryption set up will not provide them with access but won't notify the sharer
# Sharing all files to admin for recovery purposes still in progress
# Possibly public links are broken (not tested since last merge of master)


# Missing features
# ----------------
# Make sure user knows if large files weren't encrypted


# Test
# ----
# Test that writing files works when recovery is enabled, and sharing API is disabled
# Test trashbin support


// Old Todo:
//  - Crypt/decrypt button in the userinterface
//  - Setting if crypto should be on by default
//  - Add a setting "Don´t encrypt files larger than xx because of performance 
//    reasons"

namespace OCA\Encryption;

/**
 * @brief Class for utilities relating to encrypted file storage system
 * @param OC_FilesystemView $view expected to have OC '/' as root path
 * @param string $userId ID of the logged in user
 * @param int $client indicating status of client side encryption. Currently
 * unused, likely to become obsolete shortly
 */

class Util {
	
	
	// Web UI:
	
	//// DONE: files created via web ui are encrypted
	//// DONE: file created & encrypted via web ui are readable in web ui
	//// DONE: file created & encrypted via web ui are readable via webdav
	
	
	// WebDAV:
	
	//// DONE: new data filled files added via webdav get encrypted
	//// DONE: new data filled files added via webdav are readable via webdav
	//// DONE: reading unencrypted files when encryption is enabled works via 
	////       webdav
	//// DONE: files created & encrypted via web ui are readable via webdav
	
	
	// Legacy support:
	
	//// DONE: add method to check if file is encrypted using new system
	//// DONE: add method to check if file is encrypted using old system
	//// DONE: add method to fetch legacy key
	//// DONE: add method to decrypt legacy encrypted data
	
	
	// Admin UI:
	
	//// DONE: changing user password also changes encryption passphrase
	
	//// TODO: add support for optional recovery in case of lost passphrase / keys
	//// TODO: add admin optional required long passphrase for users
	//// TODO: implement flag system to allow user to specify encryption by folder, subfolder, etc.
	
	
	// Integration testing:
	
	//// TODO: test new encryption with versioning
	//// DONE: test new encryption with sharing
	//// TODO: test new encryption with proxies
	
	
	private $view; // OC_FilesystemView object for filesystem operations
	private $userId; // ID of the currently logged-in user
	private $pwd; // User Password
	private $client; // Client side encryption mode flag
	private $publicKeyDir; // Dir containing all public user keys
	private $encryptionDir; // Dir containing user's files_encryption
	private $keyfilesPath; // Dir containing user's keyfiles
	private $shareKeysPath; // Dir containing env keys for shared files
	private $publicKeyPath; // Path to user's public key
	private $privateKeyPath; // Path to user's private key
	private $publicShareKeyId;
	private $recoveryKeyId;
    private $isPublic;

	public function __construct( \OC_FilesystemView $view, $userId, $client = false ) {

		$this->view = $view;
		$this->userId = $userId;
		$this->client = $client;
        $this->isPublic = false;

        $this->publicShareKeyId = \OC_Appconfig::getValue('files_encryption', 'publicShareKeyId');
        $this->recoveryKeyId = \OC_Appconfig::getValue('files_encryption', 'recoveryKeyId');

        // if we are anonymous/public
        if($this->userId === false) {
            $this->userId = $this->publicShareKeyId;

            // only handle for files_sharing app
            if($GLOBALS['app'] === 'files_sharing') {
                $this->userDir =  '/' . $GLOBALS['fileOwner'];
                $this->fileFolderName = 'files';
                $this->userFilesDir =  '/' . $GLOBALS['fileOwner'] . '/' . $this->fileFolderName; // TODO: Does this need to be user configurable?
                $this->publicKeyDir =  '/' . 'public-keys';
                $this->encryptionDir =  '/' . $GLOBALS['fileOwner'] . '/' . 'files_encryption';
                $this->keyfilesPath = $this->encryptionDir . '/' . 'keyfiles';
                $this->shareKeysPath = $this->encryptionDir . '/' . 'share-keys';
                $this->publicKeyPath = $this->publicKeyDir . '/' . $this->userId . '.public.key'; // e.g. data/public-keys/admin.public.key
                $this->privateKeyPath = '/owncloud_private_key/' . $this->userId . '.private.key'; // e.g. data/admin/admin.private.key
                $this->isPublic = true;
            }

        } else {
            $this->userDir =  '/' . $this->userId;
            $this->fileFolderName = 'files';
            $this->userFilesDir =  '/' . $this->userId . '/' . $this->fileFolderName; // TODO: Does this need to be user configurable?
            $this->publicKeyDir =  '/' . 'public-keys';
            $this->encryptionDir =  '/' . $this->userId . '/' . 'files_encryption';
            $this->keyfilesPath = $this->encryptionDir . '/' . 'keyfiles';
            $this->shareKeysPath = $this->encryptionDir . '/' . 'share-keys';
            $this->publicKeyPath = $this->publicKeyDir . '/' . $this->userId . '.public.key'; // e.g. data/public-keys/admin.public.key
            $this->privateKeyPath = $this->encryptionDir . '/' . $this->userId . '.private.key'; // e.g. data/admin/admin.private.key
        }
	}
	
	public function ready() {
		
		if( 
		! $this->view->file_exists( $this->encryptionDir )
		or ! $this->view->file_exists( $this->keyfilesPath )
		or ! $this->view->file_exists( $this->shareKeysPath )
		or ! $this->view->file_exists( $this->publicKeyPath )
		or ! $this->view->file_exists( $this->privateKeyPath ) 
		) {
		
			return false;
			
		} else {
			
			return true;
			
		}
	
	}
	
        /**
         * @brief Sets up user folders and keys for serverside encryption
         * @param $passphrase passphrase to encrypt server-stored private key with
         */
	public function setupServerSide( $passphrase = null ) {
		
		// Set directories to check / create
		$setUpDirs = array( 
			$this->userDir
			, $this->userFilesDir
			, $this->publicKeyDir
			, $this->encryptionDir
			, $this->keyfilesPath
			, $this->shareKeysPath
		);
		
		// Check / create all necessary dirs
		foreach ( $setUpDirs as $dirPath ) {
		
			if( !$this->view->file_exists( $dirPath ) ) {
			
				$this->view->mkdir( $dirPath );
			
			}
		
		}
		
		// Create user keypair
		if ( 
			! $this->view->file_exists( $this->publicKeyPath ) 
			or ! $this->view->file_exists( $this->privateKeyPath ) 
		) {
		
			// Generate keypair
			$keypair = Crypt::createKeypair();
			
			\OC_FileProxy::$enabled = false;
			
			// Save public key
			$this->view->file_put_contents( $this->publicKeyPath, $keypair['publicKey'] );
			
			// Encrypt private key with user pwd as passphrase
			$encryptedPrivateKey = Crypt::symmetricEncryptFileContent( $keypair['privateKey'], $passphrase );
			
			// Save private key
			$this->view->file_put_contents( $this->privateKeyPath, $encryptedPrivateKey );
			
			\OC_FileProxy::$enabled = true;
			
		}
		
		// If there's no record for this user's encryption preferences
		if ( false === $this->recoveryEnabledForUser() ) {
		
			// create database configuration
			$sql = 'INSERT INTO `*PREFIX*encryption` (`uid`,`mode`,`recovery`) VALUES (?,?,?)';
			$args = array( $this->userId, 'server-side', 0);
			$query = \OCP\DB::prepare( $sql );
			$query->execute( $args );
		
		}
		
		return true;
	
	}

	public function getPublicShareKeyId() {
		return $this->publicShareKeyId;
	}
	
	/**
	 * @brief Check whether pwd recovery is enabled for a given user
	 * @return 1 = yes, 0 = no, false = no record
	 * @note If records are not being returned, check for a hidden space 
	 *       at the start of the uid in db
	 */
	public function recoveryEnabledForUser() {
	
		$sql = 'SELECT 
				recovery 
			FROM 
				`*PREFIX*encryption` 
			WHERE 
				uid = ?';
				
		$args = array( $this->userId );

		$query = \OCP\DB::prepare( $sql );
		
		$result = $query->execute( $args );
		
		$recoveryEnabled = array();
		
		while( $row = $result->fetchRow() ) {
		
			$recoveryEnabled[] = $row['recovery'];
			
		}
		
		// If no record is found
		if ( empty( $recoveryEnabled ) ) {
		
			return false;
		
		// If a record is found
		} else {
		
			return $recoveryEnabled[0];
			
		}
	
	}
	
	/**
	 * @brief Enable / disable pwd recovery for a given user
	 * @param bool $enabled Whether to enable or disable recovery
	 * @return bool
	 */
	public function setRecoveryForUser( $enabled ) {
	
		$recoveryStatus = $this->recoveryEnabledForUser();
	
		// If a record for this user already exists, update it
		if ( false === $recoveryStatus ) {
		
			$sql = 'INSERT INTO `*PREFIX*encryption` 
					(`uid`,`mode`,`recovery`) 
				VALUES (?,?,?)';
				
			$args = array( $this->userId, 'server-side', $enabled );
		
		// Create a new record instead
		} else {
		
			$sql = 'UPDATE 
					*PREFIX*encryption 
				SET 
					recovery = ? 
				WHERE 
					uid = ?';
			
			$args = array( $enabled, $this->userId );
		
		}
	
		$query = \OCP\DB::prepare( $sql );
		
		if ( $query->execute( $args ) ) {
		
			return true;
			
		} else {
		
			return false;
			
		}
		
	}
	
	/**
	 * @brief Find all files and their encryption status within a directory
	 * @param string $directory The path of the parent directory to search
	 * @return mixed false if 0 found, array on success. Keys: name, path
	 * @note $directory needs to be a path relative to OC data dir. e.g.
	 *       /admin/files NOT /backup OR /home/www/oc/data/admin/files
	 */
	public function findEncFiles( $directory ) {
		
		// Disable proxy - we don't want files to be decrypted before
		// we handle them
		\OC_FileProxy::$enabled = false;
		
		$found = array( 'plain' => array(), 'encrypted' => array(), 'legacy' => array() );
		
		if ( 
			$this->view->is_dir( $directory ) 
			&& $handle = $this->view->opendir( $directory ) 
		) {
		
			while ( false !== ( $file = readdir( $handle ) ) ) {
				
				if (
				$file != "." 
				&& $file != ".."
				) {
					
					$filePath = $directory . '/' . $this->view->getRelativePath( '/' . $file );
					$relPath = $this->stripUserFilesPath( $filePath );
					
					// If the path is a directory, search 
					// its contents
					if ( $this->view->is_dir( $filePath ) ) { 
						
						$this->findEncFiles( $filePath );
					
					// If the path is a file, determine 
					// its encryption status
					} elseif ( $this->view->is_file( $filePath ) ) {
						
						// Disable proxies again, some-
						// where they got re-enabled :/
						\OC_FileProxy::$enabled = false;
						
						$data = $this->view->file_get_contents( $filePath );
						
						// If the file is encrypted
						// NOTE: If the userId is 
						// empty or not set, file will 
						// detected as plain
						// NOTE: This is inefficient;
						// scanning every file like this
						// will eat server resources :(
						if ( 
							Keymanager::getFileKey( $this->view, $this->userId, $relPath )
							&& Crypt::isCatfileContent( $data )
						) {
						
							$found['encrypted'][] = array( 'name' => $file, 'path' => $filePath );
						
						// If the file uses old 
						// encryption system
						} elseif (  Crypt::isLegacyEncryptedContent( $this->tail( $filePath, 3 ), $relPath ) ) {
							
							$found['legacy'][] = array( 'name' => $file, 'path' => $filePath );
							
						// If the file is not encrypted
						} else {
						
							$found['plain'][] = array( 'name' => $file, 'path' => $relPath );
						
						}
					
					}
					
				}
				
			}
			
			\OC_FileProxy::$enabled = true;
			
			if ( empty( $found ) ) {
			
				return false;
			
			} else {
				
				return $found;
			
			}
		
		}
		
		\OC_FileProxy::$enabled = true;
		
		return false;

	}
	
        /**
         * @brief Fetch the last lines of a file efficiently
         * @note Safe to use on large files; does not read entire file to memory
         * @note Derivative of http://tekkie.flashbit.net/php/tail-functionality-in-php
         */
	public function tail( $filename, $numLines ) {
		
		\OC_FileProxy::$enabled = false;
		
		$text = '';
		$pos = -1;
		$handle = $this->view->fopen( $filename, 'r' );

		while ( $numLines > 0 ) {
		
			--$pos;

			if( fseek( $handle, $pos, SEEK_END ) !== 0 ) {
			
				rewind( $handle );
				$numLines = 0;
				
			} elseif ( fgetc( $handle ) === "\n" ) {
			
				--$numLines;
				
			}

			$block_size = ( -$pos ) % 8192;
			if ( $block_size === 0 || $numLines === 0 ) {
			
				$text = fread( $handle, ( $block_size === 0 ? 8192 : $block_size ) ) . $text;
				
			}
		}

		fclose( $handle );
		
		\OC_FileProxy::$enabled = true;
		
		return $text;
	}
	
	/**
	* @brief Check if a given path identifies an encrypted file
	* @return true / false
	*/
	public function isEncryptedPath( $path ) {
	
		// Disable encryption proxy so data retrieved is in its
		// original form
        $proxyStatus = \OC_FileProxy::$enabled;
		\OC_FileProxy::$enabled = false;

        // we only need 24 byte from the last chunk
        $data = '';
		$handle = $this->view->fopen( $path, 'r' );
        if(!fseek($handle, -24, SEEK_END)) {
            $data = fgets($handle);
        }

        // re-enable proxy
		\OC_FileProxy::$enabled = $proxyStatus;
		
		return Crypt::isCatfileContent( $data );
	
	}

	/**
	* @brief get the file size of the unencrypted file
	* @param $path absolute path
	* @return bool
	*/

	public function getFileSize( $path ) {
	
		$result = 0;

		// Disable encryption proxy to prevent recursive calls
		$proxyStatus = \OC_FileProxy::$enabled;
		\OC_FileProxy::$enabled = false;

		// Reformat path for use with OC_FSV
		$pathSplit = explode( '/', $path );
		$pathRelative = implode( '/', array_slice( $pathSplit, 3 ) );

		if ($pathSplit[2] == 'files' && $this->view->file_exists($path) && $this->isEncryptedPath($path)) {

			// get the size from filesystem
			$fullPath = $this->view->getLocalFile($path);
			$size = filesize($fullPath);

			// calculate last chunk nr
			$lastChunckNr = floor($size / 8192);

			// open stream
			$stream = fopen('crypt://' . $pathRelative, "r");

			if(is_resource($stream)) {
				// calculate last chunk position
				$lastChunckPos = ($lastChunckNr * 8192);

				// seek to end
				fseek($stream, $lastChunckPos);

				// get the content of the last chunk
				$lastChunkContent = fread($stream, 8192);

				// calc the real file size with the size of the last chunk
				$realSize = (($lastChunckNr * 6126) + strlen($lastChunkContent));

				// store file size
				$result = $realSize;
			}
		}

		\OC_FileProxy::$enabled = $proxyStatus;

		return $result;
	}
    
	/**
	 * @brief fix the file size of the encrypted file
	 * @param $path absolute path
	 * @return true / false if file is encrypted
	 */

	public function fixFileSize( $path ) {
	
		$result = false;

		// Disable encryption proxy to prevent recursive calls
		$proxyStatus = \OC_FileProxy::$enabled;
		\OC_FileProxy::$enabled = false;

		$realSize = $this->getFileSize( $path );
		
		if ( $realSize > 0 ) {
		
			$cached = $this->view->getFileInfo( $path );
			$cached['encrypted'] = true;

			// set the size
			$cached['unencrypted_size'] = $realSize;

			// put file info
			$this->view->putFileInfo( $path, $cached );

			$result = true;
			
		}

		\OC_FileProxy::$enabled = $proxyStatus;

		return $result;
	}

	/**
	 * @brief Format a path to be relative to the /user/files/ directory
	 * @note e.g. turns '/admin/files/test.txt' into 'test.txt'
	 */
	public function stripUserFilesPath( $path ) {
	
		$trimmed = ltrim( $path, '/' );
		$split = explode( '/', $trimmed );
		$sliced = array_slice( $split, 2 );
		$relPath = implode( '/', $sliced );
		
		return $relPath;
	
	}
	
	/**
	 * @brief Format a path to be relative to the /user directory
	 * @note e.g. turns '/admin/files/test.txt' into 'files/test.txt'
	 */
	public function stripFilesPath( $path ) {
	
		$trimmed = ltrim( $path, '/' );
		$split = explode( '/', $trimmed );
		$sliced = array_slice( $split, 1 );
		$relPath = implode( '/', $sliced );
		
		return $relPath;
	
	}
	
	/**
	 * @brief Format a shared path to be relative to the /user/files/ directory
	 * @note Expects a path like /uid/files/Shared/filepath
	 */
	public function stripSharedFilePath( $path ) {
	
		$trimmed = ltrim( $path, '/' );
		$split = explode( '/', $trimmed );
		$sliced = array_slice( $split, 3 );
		$relPath = implode( '/', $sliced );
		
		return $relPath;
	
	}
	
	public function isSharedPath( $path ) {
	
		$trimmed = ltrim( $path, '/' );
		$split = explode( '/', $trimmed );
		
		if ( $split[2] == "Shared" ) {
		
			return true;
		
		} else {
		
			return false;
		
		}
	
	}
	
	/**
	 * @brief Encrypt all files in a directory
	 * @param string $publicKey the public key to encrypt files with
	 * @param string $dirPath the directory whose files will be encrypted
	 * @note Encryption is recursive
	 */
	public function encryptAll( $publicKey, $dirPath, $legacyPassphrase = null, $newPassphrase = null ) {
		
		if ( $found = $this->findEncFiles( $dirPath ) ) {
		
			// Disable proxy to prevent file being encrypted twice
			\OC_FileProxy::$enabled = false;
		
			// Encrypt unencrypted files
			foreach ( $found['plain'] as $plainFile ) {
				
				//relative to data/<user>/file
				$relPath = $plainFile['path'];
				
				//relative to /data
				$rawPath = $this->userId . '/files/' .  $plainFile['path'];
				
				// Open plain file handle for binary reading
				$plainHandle1 = $this->view->fopen( $rawPath, 'rb' );
				
				// 2nd handle for moving plain file - view->rename() doesn't work, this is a workaround
				$plainHandle2 = $this->view->fopen( $rawPath . '.plaintmp', 'wb' );
				
				// Move plain file to a temporary location
				stream_copy_to_stream( $plainHandle1, $plainHandle2 );
				
				// Close access to original file
				// $this->view->fclose( $plainHandle1 ); // not implemented in view{}
				
				// Delete original plain file so we can rename enc file later
				$this->view->unlink( $rawPath );
				
				// Open enc file handle for binary writing, with same filename as original plain file
				$encHandle = fopen( 'crypt://' . $relPath, 'wb' );
				
				// Save data from plain stream to new encrypted file via enc stream
				// NOTE: Stream{} will be invoked for handling 
				// the encryption, and should handle all keys 
				// and their generation etc. automatically
				$size = stream_copy_to_stream( $plainHandle2, $encHandle );
				
				// Delete temporary plain copy of file
				$this->view->unlink( $rawPath . '.plaintmp' );
				
				// Add the file to the cache
				\OC\Files\Filesystem::putFileInfo( $plainFile['path'], array( 'encrypted'=>true, 'size' => $size ), '' );
			
			}
			
			// Encrypt legacy encrypted files
			if ( 
				! empty( $legacyPassphrase ) 
				&& ! empty( $newPassphrase ) 
			) {
			
				foreach ( $found['legacy'] as $legacyFile ) {
				
					// Fetch data from file
					$legacyData = $this->view->file_get_contents( $legacyFile['path'] );
				
					// Recrypt data, generate catfile
					$recrypted = Crypt::legacyKeyRecryptKeyfile( $legacyData, $legacyPassphrase, $publicKey, $newPassphrase );
					
					$relPath = $legacyFile['path'];
					$rawPath = $this->userId . '/files/' .  $plainFile['path'];
					
					// Save keyfile
					Keymanager::setFileKey( $this->view, $relPath, $this->userId, $recrypted['key'] );
					
					// Overwrite the existing file with the encrypted one
					$this->view->file_put_contents( $rawPath, $recrypted['data'] );
					
					$size = strlen( $recrypted['data'] );
					
					// Add the file to the cache
					\OC\Files\Filesystem::putFileInfo( $rawPath, array( 'encrypted'=>true, 'size' => $size ), '' );
				
				}
				
			}
			
			\OC_FileProxy::$enabled = true;
			
			// If files were found, return true
			return true;
		
		} else {
		
			// If no files were found, return false
			return false;
			
		}
		
	}
	
	/**
	 * @brief Return important encryption related paths
	 * @param string $pathName Name of the directory to return the path of
	 * @return string path
	 */
	public function getPath( $pathName ) {
	
		switch ( $pathName ) {
			
			case 'publicKeyDir':
			
				return $this->publicKeyDir;
				
				break;
				
			case 'encryptionDir':
			
				return $this->encryptionDir;
				
				break;
				
			case 'keyfilesPath':
			
				return $this->keyfilesPath;
				
				break;
				
			case 'publicKeyPath':
			
				return $this->publicKeyPath;
				
				break;
				
			case 'privateKeyPath':
			
				return $this->privateKeyPath;
				
				break;
			
		}
		
	}
	
	/**
	 * @brief get path of a file.
	 * @param $fileId id of the file
	 * @return path of the file
	 */
	public static function fileIdToPath( $fileId ) {
	
		$query = \OC_DB::prepare( 'SELECT `path`'
				.' FROM `*PREFIX*filecache`'
				.' WHERE `fileid` = ?' );
				
		$result = $query->execute( array( $fileId ) );
		
		$row = $result->fetchRow();
		
		return substr( $row['path'], 5 );
	
	}
	
	/**
	 * @brief Filter an array of UIDs to return only ones ready for sharing
	 * @param array $unfilteredUsers users to be checked for sharing readiness
	 * @return multi-dimensional array. keys: ready, unready
	 */
	public function filterShareReadyUsers( $unfilteredUsers ) {
		
		// This array will collect the filtered IDs
		$readyIds = $unreadyIds = array();
	
		// Loop through users and create array of UIDs that need new keyfiles
		foreach ( $unfilteredUsers as $user ) {
		
			$util = new Util( $this->view, $user );
				
			// Check that the user is encryption capable, or is the
			// public system user 'ownCloud' (for public shares)
			if ( 
				$user == $this->publicShareKeyId
				or $user == $this->recoveryKeyId
				or $util->ready() 
			) {
			
				// Construct array of ready UIDs for Keymanager{}
				$readyIds[] = $user;
				
			} else {
				
				// Construct array of unready UIDs for Keymanager{}
				$unreadyIds[] = $user;
				
				// Log warning; we can't do necessary setup here
				// because we don't have the user passphrase
				\OC_Log::write( 'Encryption library', '"'.$user.'" is not setup for encryption', \OC_Log::WARN );
		
			}
		
		}
		
		return array ( 
			'ready' => $readyIds
			, 'unready' => $unreadyIds
		);
		
	}
		
	/**
	 * @brief Decrypt a keyfile without knowing how it was encrypted
	 * @param string $filePath
	 * @param string $fileOwner
	 * @param string $privateKey
	 * @note Checks whether file was encrypted with openssl_seal or 
	 *       openssl_encrypt, and decrypts accrdingly
	 * @note This was used when 2 types of encryption for keyfiles was used, 
	 *       but now we've switched to exclusively using openssl_seal()
	 */
	public function decryptUnknownKeyfile( $filePath, $fileOwner, $privateKey ) {

		// Get the encrypted keyfile
		// NOTE: the keyfile format depends on how it was encrypted! At
		// this stage we don't know how it was encrypted
		$encKeyfile = Keymanager::getFileKey( $this->view, $this->userId, $filePath );
		
		// We need to decrypt the keyfile
		// Has the file been shared yet?
		if ( 
			$this->userId == $fileOwner
			&& ! Keymanager::getShareKey( $this->view, $this->userId, $filePath ) // NOTE: we can't use isShared() here because it's a post share hook so it always returns true
		) {
		
			// The file has no shareKey, and its keyfile must be 
			// decrypted conventionally
			$plainKeyfile = Crypt::keyDecrypt( $encKeyfile, $privateKey );
			
		
		} else {
			
			// The file has a shareKey and must use it for decryption
			$shareKey = Keymanager::getShareKey( $this->view, $this->userId, $filePath );
		
			$plainKeyfile = Crypt::multiKeyDecrypt( $encKeyfile, $shareKey, $privateKey );
			
		}
		
		return $plainKeyfile;

	}
	
	/**
	 * @brief Encrypt keyfile to multiple users
	 * @param array $users list of users which should be able to access the file
	 * @param string $filePath path of the file to be shared
	 * @return bool 
	 */
	public function setSharedFileKeyfiles( Session $session, array $users, $filePath ) {
		
		// Make sure users are capable of sharing
		$filteredUids = $this->filterShareReadyUsers( $users );
		
		// If we're attempting to share to unready users
		if ( ! empty( $filteredUids['unready'] ) ) {
			
			\OC_Log::write( 'Encryption library', 'Sharing to these user(s) failed as they are unready for encryption:"'.print_r( $filteredUids['unready'], 1 ), \OC_Log::WARN );
			
			return false;
			
		}
		
		// Get public keys for each user, ready for generating sharekeys
		$userPubKeys = Keymanager::getPublicKeys( $this->view, $filteredUids['ready'] );
		
		// Note proxy status then disable it
		$proxyStatus = \OC_FileProxy::$enabled;
		\OC_FileProxy::$enabled = false;

		// Get the current users's private key for decrypting existing keyfile
		$privateKey = $session->getPrivateKey();
		
		$fileOwner = \OC\Files\Filesystem::getOwner( $filePath );
		
		// Decrypt keyfile
		$plainKeyfile = $this->decryptUnknownKeyfile( $filePath, $fileOwner, $privateKey );
		
		// Re-enc keyfile to (additional) sharekeys
		$multiEncKey = Crypt::multiKeyEncrypt( $plainKeyfile, $userPubKeys );
		
		// Save the recrypted key to it's owner's keyfiles directory
		// Save new sharekeys to all necessary user directory
		if ( 
			! Keymanager::setFileKey( $this->view, $filePath, $fileOwner, $multiEncKey['data'] )
			|| ! Keymanager::setShareKeys( $this->view, $filePath, $multiEncKey['keys'] ) 
		) {

			\OC_Log::write( 'Encryption library', 'Keyfiles could not be saved for users sharing ' . $filePath, \OC_Log::ERROR );
			
			return false;

		}
		
		// Return proxy to original status
		\OC_FileProxy::$enabled = $proxyStatus;

		return true;
	}
	
	/**
	 * @brief Find, sanitise and format users sharing a file
	 * @note This wraps other methods into a portable bundle
	 */
	public function getSharingUsersArray( $sharingEnabled, $filePath, $currentUserId = false ) {

		// Check if key recovery is enabled
		if (
			\OC_Appconfig::getValue( 'files_encryption', 'recoveryAdminEnabled' )
			&& $this->recoveryEnabledForUser()
		) {
		
			$recoveryEnabled = true;
			
		} else {
		
			$recoveryEnabled = false;
			
		}
		
		// Make sure that a share key is generated for the owner too
		list( $owner, $ownerPath ) = $this->getUidAndFilename( $filePath );

		if ( $sharingEnabled ) {
		
			// Find out who, if anyone, is sharing the file
			$result = \OCP\Share::getUsersSharingFile( $ownerPath, $owner,true, true, true );
			$userIds = $result['users'];
			if ( $result['public'] ) {
				$userIds[] = $this->publicShareKeyId;
			}
		
		}
		
		// If recovery is enabled, add the 
		// Admin UID to list of users to share to
		if ( $recoveryEnabled ) {
			
			// Find recoveryAdmin user ID
			$recoveryKeyId = \OC_Appconfig::getValue( 'files_encryption', 'recoveryKeyId' );
			
			// Add recoveryAdmin to list of users sharing
			$userIds[] = $recoveryKeyId;
			
		}

		// add current user if given
		if ( $currentUserId != false ) {
		
			$userIds[] = $currentUserId;
		
		}

		// Remove duplicate UIDs
		$uniqueUserIds = array_unique ( $userIds );
		
		return $uniqueUserIds;

	}
	
	/**
	 * @brief Set file migration status for user
	 * @return bool
	 */
	public function setMigrationStatus( $status ) {
	
		$sql = 'UPDATE 
				*PREFIX*encryption 
			SET 
				migrationStatus = ? 
			WHERE 
				uid = ?';
		
		$args = array( $status, $this->userId );
		
		$query = \OCP\DB::prepare( $sql );
		
		if ( $query->execute( $args ) ) {
		
			return true;
			
		} else {
		
			return false;
			
		}
	
	}
	
	/**
	 * @brief Check whether pwd recovery is enabled for a given user
	 * @return 1 = yes, 0 = no, false = no record
	 * @note If records are not being returned, check for a hidden space 
	 *       at the start of the uid in db
	 */
	public function getMigrationStatus() {
	
		$sql = 'SELECT 
				migrationStatus 
			FROM 
				`*PREFIX*encryption` 
			WHERE 
				uid = ?';
				
		$args = array( $this->userId );

		$query = \OCP\DB::prepare( $sql );
		
		$result = $query->execute( $args );
		
		$migrationStatus = array();
		
		while( $row = $result->fetchRow() ) {
		
			$migrationStatus[] = $row['migrationStatus'];
			
		}
		
		// If no record is found
		if ( empty( $migrationStatus ) ) {
		
			return false;
		
		// If a record is found
		} else {
		
			return $migrationStatus[0];
			
		}
	
	}
		
	/**
	 * @brief get uid of the owners of the file and the path to the file
	 * @param $path Path of the file to check
	 * @note $shareFilePath must be relative to data/UID/files. Files 
	 *       relative to /Shared are also acceptable
	 * @return array
	 */
	public function getUidAndFilename( $path ) {

        $view = new \OC\Files\View($this->userFilesDir);
		$fileOwnerUid = $view->getOwner( $path );

        // handle public access
        if($fileOwnerUid === false && $this->isPublic) {
            $filename = $path;
            $fileOwnerUid = $GLOBALS['fileOwner'];

            return array ( $fileOwnerUid, $filename );
        } else {

            // Check that UID is valid
            if ( ! \OCP\User::userExists( $fileOwnerUid ) ) {
                throw new \Exception( 'Could not find owner (UID = "' . var_export( $fileOwnerUid, 1 ) . '") of file "' . $path . '"' );
            }

            // NOTE: Bah, this dependency should be elsewhere
            \OC\Files\Filesystem::initMountPoints( $fileOwnerUid );

            // If the file owner is the currently logged in user
            if ( $fileOwnerUid == $this->userId ) {

                // Assume the path supplied is correct
                $filename = $path;

            } else {

                $info = $view->getFileInfo( $path );
                $ownerView = new \OC\Files\View( '/' . $fileOwnerUid . '/files' );

                // Fetch real file path from DB
                $filename = $ownerView->getPath( $info['fileid'] ); // TODO: Check that this returns a path without including the user data dir

            }

            return array ( $fileOwnerUid, $filename );
        }

		
	}

	/**
	 * @brief geo recursively through a dir and collect all files and sub files.
	 * @param type $dir relative to the users files folder
	 * @return array with list of files relative to the users files folder
	 */
	public function getAllFiles( $dir ) {
	
		$result = array();

		$content = $this->view->getDirectoryContent( $this->userFilesDir . $dir );

		// handling for re shared folders
		$path_split = explode( '/', $dir );
		$shared = '';
		
		if( $path_split[1] === 'Shared' ) {
		
			$shared = '/Shared';
			
		}

		foreach ( $content as $c ) {
		
			$sharedPart = $path_split[sizeof( $path_split )-1];
			$targetPathSplit = array_reverse( explode( '/', $c['path'] ) );

			$path = '';

			// rebuild path
			foreach ( $targetPathSplit as $pathPart ) {
			
				if ( $pathPart !== $sharedPart ) {
				
					$path = '/' . $pathPart . $path;
				
				} else {
				
					break;
				
				}
				
			}

			$path = $dir.$path;

			if ($c['type'] === "dir" ) {
				
				$result = array_merge( $result, $this->getAllFiles( $path ) );
			
			} else {
			
				$result[] = $path;
			
			}
		}
		
		return $result;
	
	}

	/**
	 * @brief get shares parent.
	 * @param int $id of the current share
	 * @return array of the parent
	 */
	public static function getShareParent( $id ) {

		$query = \OC_DB::prepare( 'SELECT `file_target`, `item_type`'
		.' FROM `*PREFIX*share`'
		.' WHERE `id` = ?' );

		$result = $query->execute( array( $id ) );

		$row = $result->fetchRow();

		return $row;

	}

	/**
	 * @brief get shares parent.
	 * @param int $id of the current share
	 * @return array of the parent
	 */
	public static function getParentFromShare( $id ) {

		$query = \OC_DB::prepare( 'SELECT `parent`'
			.' FROM `*PREFIX*share`'
			.' WHERE `id` = ?' );

		$result = $query->execute( array( $id ) );

		$row = $result->fetchRow();

		return $row;

	}

	/**
	 * @brief get owner of the shared files.
	 * @param int $Id of a share
	 * @return owner
	 */
	public function getOwnerFromSharedFile( $id ) {
	
		$query = \OC_DB::prepare( 'SELECT `parent`, `uid_owner` FROM `*PREFIX*share` WHERE `id` = ?', 1 );
		$source = $query->execute( array( $id ) )->fetchRow();

		if ( isset($source['parent'] ) ) {
		
			$parent = $source['parent'];
			
			while ( isset( $parent ) ) {
			
				$query = \OC_DB::prepare( 'SELECT `parent`, `uid_owner` FROM `*PREFIX*share` WHERE `id` = ?', 1 );
				$item = $query->execute( array( $parent ) )->fetchRow();
				
				if ( isset( $item['parent'] ) ) {
				
					$parent = $item['parent'];
				
				} else {
				
					$fileOwner = $item['uid_owner'];
					
					break;
				
				}
			}
			
		} else {
			
			$fileOwner = $source['uid_owner'];
			
		}

		return $fileOwner;
		
	}

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUserFilesDir()
    {
        return $this->userFilesDir;
    }

	public function checkRecoveryPassword($password) {

		$pathKey = '/owncloud_private_key/' . $this->recoveryKeyId . ".private.key";
		$pathControlData = '/control-file/controlfile.enc';

		$proxyStatus = \OC_FileProxy::$enabled;
		\OC_FileProxy::$enabled = false;

		$recoveryKey = $this->view->file_get_contents($pathKey);

		$decryptedRecoveryKey = Crypt::symmetricDecryptFileContent($recoveryKey, $password);

		$controlData = $this->view->file_get_contents($pathControlData);
		$decryptedControlData = Crypt::keyDecrypt($controlData, $decryptedRecoveryKey);

		\OC_FileProxy::$enabled = $proxyStatus;

		if ($decryptedControlData === 'ownCloud') {
			return true;
		} 
		
		return false;
	}

	public function getRecoveryKeyId() {
		return $this->recoveryKeyId;
	}

	/**
	 * @brief add recovery key to all encrypted files
	 */
	public function addRecoveryKeys($path = '/') {
		$dirContent = $this->view->getDirectoryContent($this->keyfilesPath.$path);
		foreach ($dirContent as $item) {
			$filePath = substr($item['path'], 25);
			if ($item['type'] == 'dir') {
				$this->addRecoveryKey($filePath.'/');
			} else {
				$session = new Session(new \OC_FilesystemView('/'));
				$sharingEnabled = \OCP\Share::isEnabled();
				$file = substr($filePath, 0, -4);
				$usersSharing = $this->getSharingUsersArray($sharingEnabled, $file);
				$this->setSharedFileKeyfiles( $session, $usersSharing, $file );
			}
		}
	}

		/**
	 * @brief remove recovery key to all encrypted files
	 */
	public function removeRecoveryKeys($path = '/') {
		$dirContent = $this->view->getDirectoryContent($this->keyfilesPath.$path);
		foreach ($dirContent as $item) {
			$filePath = substr($item['path'], 25);
			if ($item['type'] == 'dir') {
				$this->removeRecoveryKeys($filePath.'/');
			} else {
				$file = substr($filePath, 0, -4);
				$this->view->unlink($this->shareKeysPath.'/'.$file.'.'.$this->recoveryKeyId.'.shareKey');
			}
		}
	}
}
