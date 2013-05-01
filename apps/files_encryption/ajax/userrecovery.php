setValue( $app, $key, $value )

<?php
/**
 * Copyright (c) 2013, Sam Tuke <samtuke@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or later.
 * See the COPYING-README file.
 *
 * @brief Script to handle admin settings for encrypted key recovery
 */

use OCA\Encryption;

\OCP\JSON::checkLoggedIn();
\OCP\JSON::checkAppEnabled( 'files_encryption' );

if ( 
	isset( $_POST['userEnableRecovery'] ) 
	&& ( 0 == $_POST['userEnableRecovery'] || 1 == $_POST['userEnableRecovery'] )
) {

	$userId = \OCP\USER::getUser();
	$view = new \OC_FilesystemView( '/' );
	$util = new \OCA\Encryption\Util( $view, $userId );
	
	// Save recovery preference to DB
	$result = $util->setRecoveryForUser( $_POST['userEnableRecovery'] );
	
	if ( $result ) {
	
		\OCP\JSON::success();
		
	} else {
	
		\OCP\JSON::error();
		
	}
	
}