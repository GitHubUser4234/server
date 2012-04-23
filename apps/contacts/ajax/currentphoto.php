<?php
/**
 * ownCloud - Addressbook
 *
 * @author Thomas Tanghus
 * @copyright 2012 Thomas Tanghus <thomas@tanghus.net>
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
// Init owncloud
require_once('../../../lib/base.php');

// Check if we are a user
// Firefox and Konqueror tries to download application/json for me.  --Arthur
OC_JSON::setContentTypeHeader('text/plain');
OC_JSON::checkLoggedIn();
OC_JSON::checkAppEnabled('contacts');
function bailOut($msg) {
	OC_JSON::error(array('data' => array('message' => $msg)));
	OC_Log::write('contacts','ajax/currentphoto.php: '.$msg, OC_Log::ERROR);
	exit();
}
function debug($msg) {
	OC_Log::write('contacts','ajax/currentphoto.php: '.$msg, OC_Log::DEBUG);
}

if (!isset($_GET['id'])) {
	bailOut(OC_Contacts_App::$l10n->t('No contact ID was submitted.'));
}

$tmpfname = tempnam("/tmp", "occOrig");
$contact = OC_Contacts_App::getContactVCard($_GET['id']);
$image = new OC_Image();
if(!$image) {
	bailOut(OC_Contacts_App::$l10n->t('Error loading image.'));
}
// invalid vcard
if( is_null($contact)) {
	bailOut(OC_Contacts_App::$l10n->t('Error reading contact photo.'));
} else {
	if(!$image->loadFromBase64($contact->getAsString('PHOTO'))) {
		$image->loadFromBase64($contact->getAsString('LOGO'));
	}
	if($image->valid()) {
		if($image->save($tmpfname)) {
			OC_JSON::success(array('data' => array('id'=>$_GET['id'], 'tmp'=>$tmpfname)));
			exit();
		} else {
			bailOut(OC_Contacts_App::$l10n->t('Error saving temporary file.'));
		}
	} else {
		bailOut(OC_Contacts_App::$l10n->t('The loading photo is not valid.'));
	}
}

?>
