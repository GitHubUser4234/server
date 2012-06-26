<?php
/**
 * ownCloud - Addressbook
 *
 * @author Jakob Sack
 * @copyright 2011 Jakob Sack mail@jakobsack.de
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
// Check if we are a user
OCP\JSON::checkLoggedIn();
OCP\JSON::checkAppEnabled('contacts');
OCP\JSON::callCheck();
require_once('loghandler.php');

// foreach($_SERVER as $key=>$value) {
// 	OCP\Util::writeLog('contacts','ajax/saveproperty.php: _SERVER: '.$key.'=>'.$value, OCP\Util::DEBUG);
// }
// foreach($_POST as $key=>$value) {
// 	debug($key.'=>'.print_r($value, true));
// }
// foreach($_GET as $key=>$value) {
// 	debug($key.'=>'.print_r($value, true));
// }

$id = isset($_POST['id'])?$_POST['id']:null;
if(!$id) {
	bailOut(OC_Contacts_App::$l10n->t('id is not set.'));
}
$card = OC_Contacts_App::getContactObject( $id );

OC_Contacts_VCard::delete($id);
OCP\JSON::success(array('data' => array( 'id' => $id )));
