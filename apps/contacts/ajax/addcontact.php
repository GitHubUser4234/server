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
function bailOut($msg) {
	OC_JSON::error(array('data' => array('message' => $msg)));
	OC_Log::write('contacts','ajax/saveproperty.php: '.$msg, OC_Log::DEBUG);
	exit();
}
function debug($msg) {
	OC_Log::write('contacts','ajax/saveproperty.php: '.$msg, OC_Log::DEBUG);
}
foreach ($_POST as $key=>$element) {
	debug('_POST: '.$key.'=>'.$element);
}

// Check if we are a user
OC_JSON::checkLoggedIn();
OC_JSON::checkAppEnabled('contacts');
$l=new OC_L10N('contacts');

$aid = $_POST['aid'];
$addressbook = OC_Contacts_App::getAddressbook( $aid );

$fn = trim($_POST['fn']);
$n = trim($_POST['n']);

$vcard = new OC_VObject('VCARD');
$vcard->setUID();
$vcard->setString('N',$n);
$vcard->setString('FN',$fn);

$id = OC_Contacts_VCard::add($aid,$vcard->serialize());
if(!$id) {
	OC_JSON::error(array('data' => array('message' => $l->t('There was an error adding the contact.'))));
	OC_Log::write('contacts','ajax/addcontact.php: Recieved non-positive ID on adding card: '.$id, OC_Log::ERROR);
	exit();
}

OC_JSON::success(array('data' => array( 'id' => $id )));
