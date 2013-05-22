<?php
/**
 * Copyright (c) 2013 Sam Tuke <samtuke@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

// Add CSS stylesheet
\OC_Util::addStyle( 'files_encryption', 'settings-personal' );
 
$tmpl = new OCP\Template( 'files_encryption', 'settings-personal');

$user = \OCP\USER::getUser();
$view = new \OC_FilesystemView( '/' );
$util = new \OCA\Encryption\Util( $view, $user );

$recoveryAdminEnabled = OC_Appconfig::getValue( 'files_encryption', 'recoveryAdminEnabled' );
$recoveryEnabledForUser = $util->recoveryEnabledForUser();

\OCP\Util::addscript( 'files_encryption', 'settings-personal' );
\OCP\Util::addScript( 'settings', 'personal' );

$tmpl->assign( 'recoveryEnabled', $recoveryAdminEnabled );
$tmpl->assign( 'recoveryEnabledForUser', $recoveryEnabledForUser );

return $tmpl->fetchPage();

return null;
