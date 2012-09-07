<?php

/**
 * ownCloud
 *
 * @author Frank Karlitschek
 * @copyright 2012 Frank Karlitschek frank@owncloud.org
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
/*
 *
 * The following SQL statement is just a help for developers and will not be
 * executed!
 *
 * CREATE TABLE `groups` (
 *   `gid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
 *   PRIMARY KEY (`gid`)
 * ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
 *
 * CREATE TABLE `group_user` (
 *   `gid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
 *   `uid` varchar(64) COLLATE utf8_unicode_ci NOT NULL
 * ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
 *
 */

/**
 * Class for group management in a SQL Database (e.g. MySQL, SQLite)
 */
class OC_Group_Database extends OC_Group_Backend {

	/**
	 * @brief Try to create a new group
	 * @param $gid The name of the group to create
	 * @returns true/false
	 *
	 * Trys to create a new group. If the group name already exists, false will
	 * be returned.
	 */
	public function createGroup( $gid ) {
		// Check for existence
		$stmt = OC_DB::prepare( "SELECT `gid` FROM `*PREFIX*groups` WHERE `gid` = ?" );
		$result = $stmt->execute( array( $gid ));

		if( $result->fetchRow() ) {
			// Can not add an existing group
			return false;
		}
		else{
			// Add group and exit
			$stmt = OC_DB::prepare( "INSERT INTO `*PREFIX*groups` ( `gid` ) VALUES( ? )" );
			$result = $stmt->execute( array( $gid ));

			return $result ? true : false;
		}
	}

	/**
	 * @brief delete a group
	 * @param $gid gid of the group to delete
	 * @returns true/false
	 *
	 * Deletes a group and removes it from the group_user-table
	 */
	public function deleteGroup( $gid ) {
		// Delete the group
		$stmt = OC_DB::prepare( "DELETE FROM `*PREFIX*groups` WHERE `gid` = ?" );
		$result = $stmt->execute( array( $gid ));

		// Delete the group-user relation
		$stmt = OC_DB::prepare( "DELETE FROM `*PREFIX*group_user` WHERE `gid` = ?" );
		$result = $stmt->execute( array( $gid ));

		return true;
	}

	/**
	 * @brief is user in group?
	 * @param $uid uid of the user
	 * @param $gid gid of the group
	 * @returns true/false
	 *
	 * Checks whether the user is member of a group or not.
	 */
	public function inGroup( $uid, $gid ) {
		// check
		$stmt = OC_DB::prepare( "SELECT `uid` FROM `*PREFIX*group_user` WHERE `gid` = ? AND `uid` = ?" );
		$result = $stmt->execute( array( $gid, $uid ));

		return $result->fetchRow() ? true : false;
	}

	/**
	 * @brief Add a user to a group
	 * @param $uid Name of the user to add to group
	 * @param $gid Name of the group in which add the user
	 * @returns true/false
	 *
	 * Adds a user to a group.
	 */
	public function addToGroup( $uid, $gid ) {
		// No duplicate entries!
		if( !$this->inGroup( $uid, $gid )) {
			$stmt = OC_DB::prepare( "INSERT INTO `*PREFIX*group_user` ( `uid`, `gid` ) VALUES( ?, ? )" );
			$stmt->execute( array( $uid, $gid ));
			return true;
		}else{
			return false;
		}
	}

	/**
	 * @brief Removes a user from a group
	 * @param $uid Name of the user to remove from group
	 * @param $gid Name of the group from which remove the user
	 * @returns true/false
	 *
	 * removes the user from a group.
	 */
	public function removeFromGroup( $uid, $gid ) {
		$stmt = OC_DB::prepare( "DELETE FROM `*PREFIX*group_user` WHERE `uid` = ? AND `gid` = ?" );
		$stmt->execute( array( $uid, $gid ));

		return true;
	}

	/**
	 * @brief Get all groups a user belongs to
	 * @param $uid Name of the user
	 * @returns array with group names
	 *
	 * This function fetches all groups a user belongs to. It does not check
	 * if the user exists at all.
	 */
	public function getUserGroups( $uid ) {
		// No magic!
		$stmt = OC_DB::prepare( "SELECT `gid` FROM `*PREFIX*group_user` WHERE `uid` = ?" );
		$result = $stmt->execute( array( $uid ));

		$groups = array();
		while( $row = $result->fetchRow()) {
			$groups[] = $row["gid"];
		}

		return $groups;
	}

	/**
	 * @brief get a list of all groups
	 * @returns array with group names
	 *
	 * Returns a list with all groups
	 */
	public function getGroups($search = '', $limit = null, $offset = null) {
		$stmt = OC_DB::prepare('SELECT `gid` FROM `*PREFIX*groups` WHERE `gid` LIKE ?', $limit, $offset);
		$result = $stmt->execute(array($search.'%'));
		$groups = array();
		while ($row = $result->fetchRow()) {
			$groups[] = $row['gid'];
		}
		return $groups;
	}

	/**
	 * check if a group exists
	 * @param string $gid
	 * @return bool
	 */
	public function groupExists($gid) {
		$query = OC_DB::prepare('SELECT `gid` FROM `*PREFIX*groups` WHERE `gid` = ?');
		$result = $query->execute(array($gid))->fetchOne();
		if ($result) {
			return true;
		}
		return false;
	}

	/**
	 * @brief get a list of all users in a group
	 * @returns array with user ids
	 */
	public function usersInGroup($gid, $search = '', $limit = null, $offset = null) {
		$stmt = OC_DB::prepare('SELECT `uid` FROM `*PREFIX*group_user` WHERE `gid` = ? AND `uid` LIKE ?', $limit, $offset);
		$result = $stmt->execute(array($gid, $search.'%'));
		$users = array();
		while ($row = $result->fetchRow()) {
			$users[] = $row['uid'];
		}
		return $users;
	}
}
