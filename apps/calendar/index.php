<?php
/**
 * Copyright (c) 2011 Georg Ehrke <ownclouddev at georgswebsite dot de>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

 
OC_Util::checkLoggedIn();
OC_Util::checkAppEnabled('calendar');

// Create default calendar ...
$calendars = OC_Calendar_Calendar::allCalendars(OCP\USER::getUser(), 1);
if( count($calendars) == 0){
	OC_Calendar_Calendar::addCalendar(OCP\USER::getUser(),'Default calendar');
	$calendars = OC_Calendar_Calendar::allCalendars(OCP\USER::getUser(), 1);
}

$eventSources = array();
foreach($calendars as $calendar){
	$eventSources[] = OC_Calendar_Calendar::getEventSourceInfo($calendar);
}

$eventSources[] = array('url' => '?app=calendar&getfile=ajax/events.php?calendar_id=shared_rw', 'backgroundColor' => '#1D2D44', 'borderColor' => '#888', 'textColor' => 'white', 'editable'=>'true');
$eventSources[] = array('url' => '?app=calendar&getfile=ajax/events.php?calendar_id=shared_r', 'backgroundColor' => '#1D2D44', 'borderColor' => '#888', 'textColor' => 'white', 'editable' => 'false');

OC_Hook::emit('OC_Calendar', 'getSources', array('sources' => &$eventSources));
$categories = OC_Calendar_App::getCategoryOptions();

//Fix currentview for fullcalendar
if(OC_Preferences::getValue(OCP\USER::getUser(), 'calendar', 'currentview', 'month') == "oneweekview"){
	OC_Preferences::setValue(OCP\USER::getUser(), "calendar", "currentview", "agendaWeek");
}
if(OC_Preferences::getValue(OCP\USER::getUser(), 'calendar', 'currentview', 'month') == "onemonthview"){
	OC_Preferences::setValue(OCP\USER::getUser(), "calendar", "currentview", "month");
}
if(OC_Preferences::getValue(OCP\USER::getUser(), 'calendar', 'currentview', 'month') == "listview"){
	OC_Preferences::setValue(OCP\USER::getUser(), "calendar", "currentview", "list");
}

OC_Util::addScript('3rdparty/fullcalendar', 'fullcalendar');
OCP\Util::addStyle('3rdparty/fullcalendar', 'fullcalendar');
OC_Util::addScript('3rdparty/timepicker', 'jquery.ui.timepicker');
OCP\Util::addStyle('3rdparty/timepicker', 'jquery.ui.timepicker');
if(OC_Preferences::getValue(OCP\USER::getUser(), "calendar", "timezone") == null || OC_Preferences::getValue(OCP\USER::getUser(), 'calendar', 'timezonedetection') == 'true'){
	OC_UTIL::addScript('calendar', 'geo');
}
OC_Util::addScript('calendar', 'calendar');
OCP\Util::addStyle('calendar', 'style');
OC_Util::addScript('', 'jquery.multiselect');
OCP\Util::addStyle('', 'jquery.multiselect');
OC_Util::addScript('contacts','jquery.multi-autocomplete');
OC_Util::addScript('','oc-vcategories');
OC_App::setActiveNavigationEntry('calendar_index');
$tmpl = new OC_Template('calendar', 'calendar', 'user');
$tmpl->assign('eventSources', $eventSources);
$tmpl->assign('categories', $categories);
if(array_key_exists('showevent', $_GET)){
	$tmpl->assign('showevent', $_GET['showevent']);
}
$tmpl->printPage();
