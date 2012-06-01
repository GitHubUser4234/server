<?php
/**
 * Copyright (c) 2012 Georg Ehrke <ownclouddev@georgswebsite.de>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
/*
 * This class manages the caching of repeating events
 * Events will be cached for the current year ± 5 years
 */
class OC_Calendar_Repeat{
	/*
	 * @brief returns the cache of an event
	 * @param (int) $id - id of the event
	 * @return (array) 
	 */
	public static function get($id){
		$stmt = OCP\DB::prepare('SELECT * FROM *PREFIX*calendar_repeat WHERE eventid = ?');
		$result = $stmt->execute(array($id));
		$return = array();
		while($row = $result->fetchRow()){
			$return[] = $row;
		}
		return $return;
	}
	/*
	 * @brief returns the cache of an event in a specific peroid
	 * @param (int) $id - id of the event
	 * @param (string) $from - start for period in UTC
	 * @param (string) $until - end for period in UTC
	 * @return (array)
	 */
	public static function get_inperiod($id, $from, $until){
		
	}
	/*
	 * @brief returns the cache of all repeating events of a calendar
	 * @param (int) $id - id of the calendar
	 * @return (array) 
	 */
	public static function getcalendar($id){

	}
	/*
	 * @brief returns the cache of all repeating events of a calendar in a specific period
	 * @param (int) $id - id of the event
	 * @param (string) $from - start for period in UTC
	 * @param (string) $until - end for period in UTC
	 */
	public static function getcalendar_inperiod($id, $from, $until){
		
	}
	/*
	 * @brief generates the cache the first time
	 */
	public static function generate($id){

	}
	/*
	 * @brief generates the cache the first time for all repeating event of an calendar
	 */
	public static function generatecalendar($id){

	}
	/*
	 * @brief updates an event that is already cached
	 */
	public static function update($id){

	}
	/*
	 * @brief updates all repating events of a calendar that are already cached
	 */
	public static function updatecalendar($id){

	}
	/*
	 * @brief checks if an event is already cached
	 */
	public static function is_cached($id){

	}
	/*
	 * @brief checks if a whole calendar is already cached
	 */
	public static function is_calendar_cached($id){

	}
	/*
	 * @brief removes the cache of an event
	 */
	public static function clean($id){

	}
	/*
	 * @brief removes the cache of all events of a calendar
	 */
	public static function cleancalendar($id){
		
	}
}