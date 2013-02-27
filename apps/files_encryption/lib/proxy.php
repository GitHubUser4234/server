<?php

/**
* ownCloud
*
* @author Sam Tuke, Robin Appelman
* @copyright 2012 Sam Tuke samtuke@owncloud.com, Robin Appelman 
* icewind1991@gmail.com
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

/**
* @brief Encryption proxy which handles filesystem operations before and after
*        execution and encrypts, and handles keyfiles accordingly. Used for 
*        webui.
*/

namespace OCA\Encryption;

class Proxy extends \OC_FileProxy {

	private static $blackList = null; //mimetypes blacklisted from encryption
	
	private static $enableEncryption = null;
	
	/**
	 * Check if a file requires encryption
	 * @param string $path
	 * @return bool
	 *
	 * Tests if server side encryption is enabled, and file is allowed by blacklists
	 */
	private static function shouldEncrypt( $path ) {
		
		if ( is_null( self::$enableEncryption ) ) {
		
			if ( 
				\OCP\Config::getAppValue( 'files_encryption', 'enable_encryption', 'true' ) == 'true' 
				&& Crypt::mode() == 'server' 
			) {
			
				self::$enableEncryption = true;
			
			} else {
				
				self::$enableEncryption = false;
			
			}
			
		}
		
		if ( !self::$enableEncryption ) {
		
			return false;
			
		}
		
		if ( is_null(self::$blackList ) ) {
		
			self::$blackList = explode(',', \OCP\Config::getAppValue( 'files_encryption', 'type_blacklist', '' ) );
			
		}
		
		if ( Crypt::isCatfile( $path ) ) {
		
			return true;
			
		}
		
		$extension = substr( $path, strrpos( $path, '.' ) +1 );
		
		if ( array_search( $extension, self::$blackList ) === false ) {
		
			return true;
			
		}
		
		return false;
	}
	
	public function preFile_put_contents( $path, &$data ) { 
		
		if ( self::shouldEncrypt( $path ) ) {
		
			// Stream put contents should have been converted to fopen
			if ( !is_resource( $data ) ) {
			
				$userId = \OCP\USER::getUser();
				$rootView = new \OC_FilesystemView( '/' );
				$util = new Util( $rootView, $userId );
				$session = new Session();
				$fileOwner = \OC\Files\Filesystem::getOwner( $path );
				$privateKey = $session->getPrivateKey();
				$filePath = $util->stripUserFilesPath( $path );
				// Set the filesize for userland, before encrypting
				$size = strlen( $data );
				
				// Disable encryption proxy to prevent recursive calls
				\OC_FileProxy::$enabled = false;
				
				// Check if there is an existing key we can reuse
				if ( $encKeyfile = Keymanager::getFileKey( $rootView, $fileOwner, $filePath ) ) {
				
					$keyPreExists = true;
				
					// Decrypt the keyfile
					$plainKey = $util->decryptUnknownKeyfile( $filePath, $fileOwner, $privateKey );
				
				} else {
				
					$keyPreExists = false;
				
					// Make a new key
					$plainKey = Crypt::generateKey();
				
				}
				
				// Encrypt data
				$encData = Crypt::symmetricEncryptFileContent( $data, $plainKey );
				
				// Check if the keyfile needs to be shared
				if ( $userIds = \OCP\Share::getUsersSharingFile( $filePath, true ) ) {
					
					$publicKeys = Keymanager::getPublicKeys( $rootView, $userIds );
					
					\OC_FileProxy::$enabled = false;
					
					// Encrypt plain keyfile to multiple sharefiles
					$multiEncrypted = Crypt::multiKeyEncrypt( $plainKey, $publicKeys );
					
					// Save sharekeys to user folders
					// TODO: openssl_seal generates new shareKeys (envelope keys) each time data is encrypted, but will data still be decryptable using old shareKeys? If so we don't need to replace the old shareKeys here, we only need to set the new ones
					Keymanager::setShareKeys( $rootView, $filePath, $multiEncrypted['keys'] );
					
					// Set encrypted keyfile as common varname
					$encKey = $multiEncrypted['encrypted'];
				
				} else {
				
					$publicKey = Keymanager::getPublicKey( $rootView, $userId );
				
					// Encrypt plain data to a single user
					$encKey = Crypt::keyEncrypt( $plainKey, $publicKey );
				
				}
				
				// Save the key if its new
				if ( ! $keyPreExists ) {
				
					// Save keyfile for newly encrypted file in parallel directory tree
					Keymanager::setFileKey( $rootView, $filePath, $fileOwner, $encKey );
					
				}
				
				// Replace plain content with encrypted content by reference
				$data = $encData;
				
				// Update the file cache with file info
				\OC\Files\Filesystem::putFileInfo( $path, array( 'encrypted'=>true, 'size' => $size ), '' );
				
				// Re-enable proxy - our work is done
				\OC_FileProxy::$enabled = true;
				
			}
		}
		
	}
	
	/**
	 * @param string $path Path of file from which has been read
	 * @param string $data Data that has been read from file
	 */
	public function postFile_get_contents( $path, $data ) {
	
		// FIXME: $path for shared files is just /uid/files/Shared/filepath
		
		$userId = \OCP\USER::getUser();
		$view = new \OC_FilesystemView( '/' );
		$util = new Util( $view, $userId );
		
		if ( $util->isSharedPath( $path ) ) {
		
			$relPath = $util->stripSharedFilePath( $path );
		
		} else {
		
			$relPath = $util->stripUserFilesPath( $path );
		
		}
		
	
		// TODO check for existing key file and reuse it if possible to avoid problems with versioning etc.
		// Disable encryption proxy to prevent recursive calls
		\OC_FileProxy::$enabled = false;
		
		// If data is a catfile
		if ( 
			Crypt::mode() == 'server' 
			&& Crypt::isCatfile( $data ) 
		) {
		
			// TODO use get owner to find correct location of key files for shared files
			$session = new Session();
			$privateKey = $session->getPrivateKey( $userId );
			
			// Get the file owner so we can retrieve its keyfile
			$fileOwner = \OC\Files\Filesystem::getOwner( $relPath ); //NOTE: This might be false! make sure the path passed to it is right
			$fileOwner = 'admin'; // FIXME: Manually set the correct UID for now
			
			// Get the encrypted keyfile
			$encKeyfile = Keymanager::getFileKey( $view, $fileOwner, $relPath );
			
			// Attempt to fetch the user's shareKey
			$shareKey = Keymanager::getShareKey( $view, $userId, $relPath );
			
			// Check if key is shared or not
			if ( $shareKey ) {
				
				\OC_FileProxy::$enabled = false;
				
// 				trigger_error("\$encKeyfile = $encKeyfile, \$shareKey = $shareKey, \$privateKey = $privateKey");
				
				// Decrypt keyfile with shareKey
				$plainKeyfile = Crypt::multiKeyDecrypt( $encKeyfile, $shareKey, $privateKey );
				
// 				$plainKeyfile = $encKeyfile;
				
// 				trigger_error("PROXY plainkeyfile = ". var_export($plainKeyfile, 1));
			
			} else {
				
				// If key is unshared, decrypt with user private key
				$plainKeyfile = Crypt::keyDecrypt( $encKeyfile, $privateKey );
			
			}
			
			$plainData = Crypt::symmetricDecryptFileContent( $data, $plainKeyfile );
			
// 			trigger_error("PLAINDATA = ". var_export($plainData, 1));

		} elseif (
		Crypt::mode() == 'server' 
		&& isset( $_SESSION['legacyenckey'] )
		&& Crypt::isEncryptedMeta( $path ) 
		) {
			
			$plainData = Crypt::legacyDecrypt( $data, $session->getLegacyKey() );
			
		}
		
		\OC_FileProxy::$enabled = true;
		
		if ( ! isset( $plainData ) ) {
		
			$plainData = $data;
			
		}
		
		return $plainData;
		
	}
	
	/**
	 * @brief When a file is deleted, remove its keyfile also
	 */
	public function preUnlink( $path ) {
	
		// Disable encryption proxy to prevent recursive calls
		\OC_FileProxy::$enabled = false;
		
		$view = new \OC_FilesystemView( '/' );
		
		$userId = \OCP\USER::getUser();
		
		// Format path to be relative to user files dir
		$trimmed = ltrim( $path, '/' );
		$split = explode( '/', $trimmed );
		$sliced = array_slice( $split, 2 );
		$relPath = implode( '/', $sliced );
		$filePath = $userId . '/' . 'files_encryption' . '/' . 'keyfiles' . '/'. $relPath;
		
		if ( $view->is_dir( $path ) ) {
			
			// Dirs must be handled separately as deleteFileKey 
			// doesn't handle them
			$view->unlink( $filePath );
			
		} else {
		
			// Delete keyfile & shareKey so it isn't orphaned
			if (
				! ( 
					Keymanager::deleteFileKey( $view, $userId, $relPath )
					&& Keymanager::delShareKey( $view, $userId, $relPath ) 
				)
			) {
			
				\OC_Log::write( 'Encryption library', 'Keyfile or shareKey could not be deleted for file "'.$filePath.'"', \OC_Log::ERROR );
				
				
			}
			
			
		
		}
		
		\OC_FileProxy::$enabled = true;
		
		// If we don't return true then file delete will fail; better
		// to leave orphaned keyfiles than to disallow file deletion
		return true;
	
	}

	/**
	 * @brief When a file is renamed, rename its keyfile also
	 * @return bool Result of rename()
	 * @note This is pre rather than post because using post didn't work
	 */
	public function preRename( $oldPath, $newPath ) {
		
		// Disable encryption proxy to prevent recursive calls
		\OC_FileProxy::$enabled = false;
		
		$view = new \OC_FilesystemView( '/' );
		
		$userId = \OCP\USER::getUser();
	
		// Format paths to be relative to user files dir
		$oldTrimmed = ltrim( $oldPath, '/' );
		$oldSplit = explode( '/', $oldTrimmed );
		$oldSliced = array_slice( $oldSplit, 2 );
		$oldRelPath = implode( '/', $oldSliced );
		$oldKeyfilePath = $userId . '/' . 'files_encryption' . '/' . 'keyfiles' . '/' . $oldRelPath . '.key';
		
		$newTrimmed = ltrim( $newPath, '/' );
		$newSplit = explode( '/', $newTrimmed );
		$newSliced = array_slice( $newSplit, 2 );
		$newRelPath = implode( '/', $newSliced );
		$newKeyfilePath = $userId . '/' . 'files_encryption' . '/' . 'keyfiles' . '/' . $newRelPath . '.key';
		
		// Rename keyfile so it isn't orphaned
		$result = $view->rename( $oldKeyfilePath, $newKeyfilePath );
		
		\OC_FileProxy::$enabled = true;
		
		return $result;
	
	}
	
	public function postFopen( $path, &$result ){
	
		if ( !$result ) {
		
			return $result;
			
		}
		
		// Reformat path for use with OC_FSV
		$path_split = explode( '/', $path );
		$path_f = implode( '/', array_slice( $path_split, 3 ) );
		
		// Disable encryption proxy to prevent recursive calls
		\OC_FileProxy::$enabled = false;
		
		$meta = stream_get_meta_data( $result );
		
		$view = new \OC_FilesystemView( '' );
		
		$util = new Util( $view, \OCP\USER::getUser());
		
		// If file is already encrypted, decrypt using crypto protocol
		if ( 
			Crypt::mode() == 'server' 
			&& $util->isEncryptedPath( $path ) 
		) {
			
			// Close the original encrypted file
			fclose( $result );
			
			// Open the file using the crypto stream wrapper 
			// protocol and let it do the decryption work instead
			$result = fopen( 'crypt://' . $path_f, $meta['mode'] );
			
			
		} elseif ( 
			self::shouldEncrypt( $path ) 
			and $meta ['mode'] != 'r' 
			and $meta['mode'] != 'rb' 
		) {
		// If the file is not yet encrypted, but should be 
		// encrypted when it's saved (it's not read only)
		
		// NOTE: this is the case for new files saved via WebDAV
		
			if ( 
			$view->file_exists( $path ) 
			and $view->filesize( $path ) > 0 
			) {
				$x = $view->file_get_contents( $path );
				
				$tmp = tmpfile();
				
// 				// Make a temporary copy of the original file
// 				\OCP\Files::streamCopy( $result, $tmp );
// 				
// 				// Close the original stream, we'll return another one
// 				fclose( $result );
// 				
// 				$view->file_put_contents( $path_f, $tmp );
// 				
// 				fclose( $tmp );
			
			}
			
			$result = fopen( 'crypt://'.$path_f, $meta['mode'] );
		
		}
		
		// Re-enable the proxy
		\OC_FileProxy::$enabled = true;
		
		return $result;
	
	}

	public function postGetMimeType( $path, $mime ) {
		
		if ( Crypt::isCatfile( $path ) ) {
		
			$mime = \OCP\Files::getMimeType( 'crypt://' . $path, 'w' );
		
		}
		
		return $mime;
		
	}

	public function postStat( $path, $data ) {
	
		if ( Crypt::isCatfile( $path ) ) {
		
			$cached = \OC\Files\Filesystem::getFileInfo( $path, '' );
			
			$data['size'] = $cached['size'];
			
		}
		
		return $data;
	}

	public function postFileSize( $path, $size ) {
		
		if ( Crypt::isCatfile( $path ) ) {
			
			$cached = \OC\Files\Filesystem::getFileInfo( $path, '' );
			
			return  $cached['size'];
		
		} else {
		
			return $size;
			
		}
	}
}
