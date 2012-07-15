<?php

// Init owncloud
require_once('../../lib/base.php');

OC_JSON::checkAdminUser();
OCP\JSON::callCheck();

$success = true;
$error = "add user to";
$action = "add";

$username = $_POST["username"];
$group = OC_Util::sanitizeHTML($_POST["group"]);

// Toggle group
if(OC_SubAdmin::isSubAdminofGroup($username, $group)){
	OC_SubAdmin::deleteSubAdmin($username, $group);
}else{
	OC_SubAdmin::createSubAdmin($username, $group);
}

OC_JSON::success();