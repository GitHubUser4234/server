<?php
/**
 * @author Clark Tomlinson <fallen013@gmail.com>
 * @author Lukas Reschke <lukas@owncloud.com>
 * @author Morris Jobke <hey@morrisjobke.de>
 *
 * @copyright Copyright (c) 2015, ownCloud, Inc.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

OC_JSON::callCheck();
OC_JSON::checkSubAdminUser();

$userCount = 0;

$currentUser = \OC::$server->getUserSession()->getUser()->getUID();

if (!OC_User::isAdminUser($currentUser)) {
	$groups = \OC::$server->getGroupManager()->getSubAdmin()->getSubAdminsGroups(\OC::$server->getUserSession()->getUser());
	// New class returns IGroup[] so convert back
	foreach ($groups as $key => $group) {
		$groups[$key] = $group->getGID();
	}


	foreach ($groups as $group) {
		$userCount += count(OC_Group::usersInGroup($group));

	}
} else {

	$userCountArray = \OC::$server->getUserManager()->countUsers();

	if (!empty($userCountArray)) {
		foreach ($userCountArray as $classname => $usercount) {
			$userCount += $usercount;
		}
	}
}


OC_JSON::success(array('count' => $userCount));
