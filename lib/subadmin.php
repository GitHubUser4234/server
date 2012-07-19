<?php
/**
 * ownCloud
 *
 * @author Georg Ehrke
 * @copyright 2012 Georg Ehrke 
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
 * This class provides all methods needed for managing groups.
 *
 * Hooks provided:
 *   post_createSubAdmin($gid)
 *   post_deleteSubAdmin($gid)
 */
class OC_SubAdmin{

	/**
	 * @brief add a SubAdmin
	 * @param $uid uid of the SubAdmin
	 * @param $gid gid of the group
	 * @return boolean
	 */
	public static function createSubAdmin($uid, $gid){
		$stmt = OC_DB::prepare('INSERT INTO *PREFIX*group_admin (gid,uid) VALUES(?,?)');
		$result = $stmt->execute(array($gid, $uid));
		OC_Hook::emit( "OC_SubAdmin", "post_createSubAdmin", array( "gid" => $gid ));
		return true;
	}

	/**
	 * @brief delete a SubAdmin
	 * @param $uid uid of the SubAdmin
	 * @param $gid gid of the group
	 * @return boolean
	 */
	public static function deleteSubAdmin($uid, $gid){
		$stmt = OC_DB::prepare('DELETE FROM *PREFIX*group_admin WHERE gid = ? AND uid = ?');
		$result = $stmt->execute(array($gid, $uid));
		OC_Hook::emit( "OC_SubAdmin", "post_deleteSubAdmin", array( "gid" => $gid ));
		return true;
	}

	/**
	 * @brief get groups of a SubAdmin
	 * @param $uid uid of the SubAdmin
	 * @return array
	 */
	public static function getSubAdminsGroups($uid){
		$stmt = OC_DB::prepare('SELECT gid FROM *PREFIX*group_admin WHERE uid = ?');
		$result = $stmt->execute(array($uid));
		$gids = array();
		while($row = $result->fetchRow()){
			$gids[] = $row['gid'];
		}
		return $gids;
	}

	/**
	 * @brief get SubAdmins of a group
	 * @param $gid gid of the group
	 * @return array
	 */
	public static function getGroupsSubAdmins($gid){
		$stmt = OC_DB::prepare('SELECT uid FROM *PREFIX*group_admin WHERE gid = ?');
		$result = $stmt->execute(array($gid));
		$uids = array();
		while($row = $result->fetchRow()){
			$uids[] = $row['uid'];
		}
		return $uids;
	}
	
	/**
	 * @brief get all SubAdmins
	 * @return array
	 */
	public static function getAllSubAdmins(){
		$stmt = OC_DB::prepare('SELECT * FROM *PREFIX*group_admin');
		$result = $stmt->execute();
		$subadmins = array();
		while($row = $result->fetchRow()){
			$subadmins[] = $row;
		}
		return $subadmins;
	}
	
	/**
	 * @brief checks if a user is a SubAdmin of a group
	 * @param $uid uid of the subadmin
	 * @param $gid gid of the group
	 * @return bool
	 */
	public static function isSubAdminofGroup($uid, $gid){
		$stmt = OC_DB::prepare('SELECT COUNT(*) as count FROM *PREFIX*group_admin where uid = ? AND gid = ?');
		$result = $stmt->execute(array($uid, $gid));
		$result = $result->fetchRow();
		if($result['count'] >= 1){
			return true;
		}
		return false;
	}
	
	/**
	 * @brief checks if a user is a SubAdmin
	 * @param $uid uid of the subadmin
	 * @return bool
	 */
	public static function isSubAdmin($uid){
		$stmt = OC_DB::prepare('SELECT COUNT(*) as count FROM *PREFIX*group_admin WHERE uid = ?');
		$result = $stmt->execute(array($uid));
		$result = $result->fetchRow();
		if($result['count'] > 0){
			return true;
		}
		return false;
	}
	
	/**
	 * @brief checks if a user is a accessible by a subadmin
	 * @param $subadmin uid of the subadmin
	 * @param $user uid of the user
	 * @return bool
	 */
	public static function isUserAccessible($subadmin, $user){
		if(!self::isSubAdmin($subadmin)){
			return false;
		}
		$accessiblegroups = self::getSubAdminsGroups($subadmin);
		foreach($accessiblegroups as $accessiblegroup){
			if(OC_Group::inGroup($user, $accessiblegroup)){
				return true;
			}
		}
		return false;
	}
}
