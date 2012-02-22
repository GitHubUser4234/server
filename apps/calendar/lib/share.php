<?php
/**
 * Copyright (c) 2012 Georg Ehrke <ownclouddev@georgswebsite.de>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
/*
 * This class manages shared calendars
 */
class OC_Calendar_Share{
	const CALENDAR = 'calendar';
	const EVENT = 'event';
	/*
	 * @brief: returns informations about all calendar or events which users are sharing with the user - userid
	 * @param: (string) $userid - id of the user
	 * @param: (string) $type - use const self::CALENDAR or self::EVENT
	 * @return: (array) $return - information about calendars
	 */
	public static function allSharedwithuser($userid, $type, $active=null, $permission=null){
		$group_where = self::group_sql(OC_Group::getUserGroups($userid));
		$permission_where = self::permission_sql($permission);
		$active_where = self::active_sql($active);
		$stmt = OC_DB::prepare('SELECT * FROM *PREFIX*calendar_share_' . $type . ' WHERE ((share = ? AND sharetype = "user") ' . $group_where . ') AND owner <> ? ' . $permission_where . ' ' . $active_where . ')');
		$result = $stmt->execute(array($userid, $userid));
		$return = array();
		while( $row = $result->fetchRow()){
			$return[] = $row;
		}
		return $return;
	}
	/*
	 * @brief: returns all users a calendar / event is shared with
	 * @param: (int) id - id of the calendar / event
	 * @param: (string) $type - use const self::CALENDAR or self::EVENT
	 * @return: (array) $users - information about users a calendar / event is shared with
	 */
	public static function allUsersSharedwith($id, $type){
		$stmt = OC_DB::prepare('SELECT * FROM *PREFIX*calendar_share_' . $type . ' WHERE ' . $type . 'id = ? ORDER BY share');
		$result = $stmt->execute(array($id));
		$users = array();
		while( $row = $result->fetchRow()){
			$users[] = $row;
		}
		return $users;
	}
	/*
	 * @brief: shares a calendar / event
	 * @param: (string) $owner - userid of the owner
	 * @param: (string) $share - userid (if $sharetype == user) / groupid (if $sharetype == group) / token (if $sharetype == public)
	 * @param: (string) $sharetype - type of sharing (can be: user/group/public)
	 * @param: (string) $id - id of the calendar / event
	 * @param: (string) $type - use const self::CALENDAR or self::EVENT
	 * @return (mixed) - token (if $sharetype == public) / bool (if $sharetype != public)
	 */
	public static function share($owner, $share, $sharetype, $id, $type){
		if(self::is_already_shared($owner, $share, $sharetype, $id, $type)){
			return false;
		}
		switch($sharetype){
			case 'user':
			case 'group':
			case 'public':
				break;
			default:
				return false;
		}
		if($sharetype == 'public'){
			$share = self::generate_token();
		}
		$stmt = OC_DB::prepare('INSERT INTO *PREFIX*calendar_share_' . $type . ' (owner,share,sharetype,' . $type . 'id,permissions' . (($type == self::CALENDAR)?', active':'') . ') VALUES(?,?,?,?,0' . (($type == self::CALENDAR)?', 1':'') . ')' );
		$result = $stmt->execute(array($owner,$share,$sharetype,$id));
		if($sharetype == 'public'){
			return $share;
		}else{
			return true;
		}
	}
	/*
	 * @brief: stops sharing a calendar / event
	 * @param: (string) $owner - userid of the owner
	 * @param: (string) $share - userid (if $sharetype == user) / groupid (if $sharetype == group) / token (if $sharetype == public)
	 * @param: (string) $sharetype - type of sharing (can be: user/group/public)
	 * @param: (string) $id - id of the calendar / event
	 * @param: (string) $type - use const self::CALENDAR or self::EVENT
	 * @return (bool)
	 */
	public static function unshare($owner, $share, $sharetype, $id, $type){
		$stmt = OC_DB::prepare('DELETE FROM *PREFIX*calendar_share_' . $type . ' WHERE owner = ? ' . (($sharetype != 'public')?'AND share = ?':'') . ' AND sharetype = ? AND ' . $type . 'id = ?');
		if($sharetype != 'public'){
			$stmt->execute(array($owner,$share,$sharetype,$id));
		}else{
			$stmt->execute(array($owner,$sharetype,$id));
		}
		return true;
	}
	/*
	 * @brief: changes the permission for a calendar / event
	 * @param: (string) $share - userid (if $sharetype == user) / groupid (if $sharetype == group) / token (if $sharetype == public)
	 * @param: (string) $sharetype - type of sharing (can be: user/group/public)
	 * @param: (string) $id - id of the calendar / event
	 * @param: (int) $permission - permission of user the calendar / event is shared with (if $sharetype == public then $permission = 0)
	 * @param: (string) $type - use const self::CALENDAR or self::EVENT
	 * @return (bool)
	 */
	public static function changepermission($share, $sharetype, $id, $permission, $type){
		if($sharetype == 'public' && $permission == 1){
			$permission = 0;
		}
		$stmt = OC_DB::prepare('UPDATE *PREFIX*calendar_share_' . $type . ' SET permissions = ? WHERE share = ? AND sharetype = ? AND ' . $type . 'id = ?');
		$stmt->execute(array($permission, $share, $sharetype, $id));
		return true;
	}
	/*
	 * @brief: generates a token for public calendars / events
	 * @return: (string) $token
	 */
	private static function generate_token($id, $type){
		$uniqid = uniqid();
		if($type == self::CALENDAR){
			$events = OC_Calendar_Objects::all($id);
			$string = '';
			foreach($events as $event){
				$string .= $event['calendardata'];
			}
		}else{
			$string = OC_Calendar_Object::find($id);
		}
		$string = sha1($string);
		$id = sha1($id);
		$array = array($uniqid,$string,$id);
		shuffle($array);
		$string = implode('', $array);
		$token = md5($string);
		return substr($token, rand(0,16), 15);
	}
	/*
	 * @brief: checks if it is already shared
	 * @param: (string) $owner - userid of the owner
	 * @param: (string) $share - userid (if $sharetype == user) / groupid (if $sharetype == group) / token (if $sharetype == public)
	 * @param: (string) $sharetype - type of sharing (can be: user/group/public)
	 * @param: (string) $id - id of the calendar / event
	 * @param: (string) $type - use const self::CALENDAR or self::EVENT
	 * @return (bool)
	 */
	public static function is_already_shared($owner, $share, $sharetype, $id, $type){
		$stmt = OC_DB::prepare('SELECT * FROM *PREFIX*calendar_share_' . $type . ' WHERE owner = ? AND share = ? AND sharetype = ? AND ' . $type . 'id = ?');
		$result = $stmt->execute(array($owner, $share, $sharetype, $id));
		if($result->numRows() > 0){
			return true;
		}
		return false;
	}
	private static function group_sql($groups){
		$group_where = '';
		$i = 0;
		foreach($groups as $group){
			if($i == 0){
				$group_where = 'OR (';
			}else{
				$group_where .= ' OR ';
			}
			$group_where .= ' (share = "' . $group . '" AND sharetype = "group") ';
			$i++;
		}
		return $group_where;
	}
	private static function permission_sql($permission = null){
		$permission_where = '';
		if(!is_null($permission)){
			$permission_where = 'AND permissions = ';
			$permission_where .= ($permission=='rw')?'1':'0';
		}
		return $permission_where;
	}
	private static function active_sql($active = null){
		$active_where = '';
		if(!is_null($active)){
			$active_where = 'AND active = ';
			$active_where .= (!is_null($active) && $active)?'1':'0';
		}
		return $active_where;
	}
	/*
	 * @brief: checks the permission for editing an event
	 * @param: (string) $share - userid (if $sharetype == user) / groupid (if $sharetype == group) / token (if $sharetype == public)
	 * @param: (string) $id - id of the calendar / event
	 * @param: (string) $type - use const self::CALENDAR or self::EVENT
	 * @return (bool)
	 */
	public static function is_editing_allowed($share, $id, $type){
		$group_where = self::group_sql(OC_Group::getUserGroups($share));
		$permission_where = self::permission_sql('rw');
		$stmt = OC_DB::prepare('SELECT * FROM *PREFIX*calendar_share_' . $type . ' WHERE ((share = ? AND sharetype = "user") ' . $group_where . ') ' . $permission_where . ')');
		$result = $stmt->execute(array($share));
		if($result->numRows() == 1){
			return true;
		}
		return false;
	}
}