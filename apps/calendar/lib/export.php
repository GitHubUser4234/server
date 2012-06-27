<?php
/**
 * Copyright (c) 2012 Georg Ehrke <ownclouddev@georgswebsite.de>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
/*
 * This class does export
 */
class OC_Calendar_Export{
	const CALENDAR = 'calendar';
	const EVENT = 'event';

	/*
	 * @brief export a calendar or an event
	 * @param integer $id id of calendar / event
	 * @param string $type use OC_Calendar_Export constants
	 * @return string
	 */
	public static function export($id, $type){
		if($type == self::EVENT){
			$data = OC_Calendar_App::getEventObject($_GET['eventid'], false);
			$return = $data['calendardata'];
		}else{
			$return = self::calendar($id);
		}
		return $return;
	}

	/*
	 * @brief export a calendar and convert all times to UTC
	 * @param integer $id id of the calendar
	 * @return string
	 */
	private static function calendar($id){
		$events = OC_Calendar_Object::all($id);
		$return = "BEGIN:VCALENDAR\nVERSION:2.0\nPRODID:ownCloud Calendar\n";
		foreach($events as $event){
			$object = OC_VObject::parse($event['calendardata']);
			$dtstart = $object->VEVENT->DTSTART;
			$start_dt = $dtstart->getDateTime();
			$dtend = OC_Calendar_Object::getDTEndFromVEvent($object->VEVENT);
			$end_dt = $dtend->getDateTime();
			if($dtstart->getDateType() !== Sabre_VObject_Element_DateTime::DATE){
				$object->VEVENT->DTSTART->offsetUnset('VALUE');
				$object->VEVENT->DTEND->offsetUnset('VALUE');
			}
			$return .= $object->VEVENT->serialize();
		}
		$return .= "END:VCALENDAR";
		return $return;
	}
}
