<?php

/**
* ownCloud
*
* @author Robin Appelman
* @copyright 2010 Robin Appelman icewind1991@gmail.com
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
\OC_JSON::checkLoggedIn();
\OC::$server->getSession()->close();

if (isset($_GET['query'])) {
	$query = $_GET['query'];
} else {
	$query = '';
}
if (isset($_GET['inApps'])) {
	$inApps = $_GET['inApps'];
	if (is_string($inApps)) {
		$inApps = array($inApps);
	}
} else {
	$inApps = array();
}
if($query) {
	$result = \OC::$server->getSearch()->search($query, $inApps);
	OC_JSON::encodedPrint($result);
}
else {
	echo 'false';
}
