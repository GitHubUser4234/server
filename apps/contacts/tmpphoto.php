<?php
/**
 * ownCloud - Image generator for contacts.
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

$tmpkey = $_GET['tmpkey'];
$maxsize = isset($_GET['maxsize']) ? $_GET['maxsize'] : -1;
header("Cache-Control: no-cache, no-store, must-revalidate");

OCP\Util::writeLog('contacts', 'tmpphoto.php: tmpkey: '.$tmpkey, OCP\Util::DEBUG);

$image = new OC_Image();
$image->loadFromData(OC_Cache::get($tmpkey));
if($maxsize != -1) {
	$image->resize($maxsize);
}
$image();
