<?php

OCP\JSON::checkAppEnabled('files_sharing');
OCP\JSON::checkLoggedIn();

$source = '/'.OCP\USER::getUser().'/files'.$_POST['source'];
$uid_shared_with = $_POST['uid_shared_with'];
OC_Share::unshare($source, $uid_shared_with);

OCP\JSON::success();

?>
