<?php
/**
 * Copyright (c) 2011 Georg Ehrke <ownclouddev at georgswebsite dot de>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
require_once('../../../lib/base.php');
OC_JSON::checkLoggedIn();
if(isset($_POST["firstdayofweek"])){
	OC_Preferences::setValue(OC_User::getUser(), 'calendar', 'firstdayofweek', $_POST["firstdayofweek"]);
	OC_JSON::success();
}else{
	OC_JSON::error();
}
?> 
