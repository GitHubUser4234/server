<?php
/**
 * Copyright (c) 2012 Georg Ehrke <ownclouddev at georgswebsite dot de>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
OC_JSON::checkLoggedIn();
OC_JSON::checkAppEnabled('calendar');
$view = $_GET['v'];
switch($view){
	case 'agendaWeek':
	case 'month';
	case 'list':
		break;
	default:
		OC_JSON::error(array('message'=>'unexspected parameter: ' . $view));
		exit;
}
OCP\Config::setUserValue(OCP\USER::getUser(), 'calendar', 'currentview', $view);
OC_JSON::success();
?>
