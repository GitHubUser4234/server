<?php

OCP\JSON::checkAppEnabled('files_external');
OCP\JSON::checkLoggedIn();
OCP\JSON::callCheck();

$name = $_POST['cert'];
$certificateManager = \OC::$server->getCertificateManager();
$certificateManager->removeCertificate($name);
