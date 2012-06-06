<?php
$RUNTIME_NOSETUPFS = true;
$RUNTIME_NOAPPS = TRUE;
require_once('lib/base.php');
if (array_key_exists('PATH_INFO', $_SERVER)){
	$path_info = $_SERVER['PATH_INFO'];
}else{
	$path_info = substr($_SERVER['PHP_SELF'], strpos($_SERVER['PHP_SELF'], basename(__FILE__)) + strlen(basename(__FILE__)));
}
if (!$pos = strpos($path_info, '/', 1)) {
	$pos = strlen($path_info);
}
$service=substr($path_info, 1, $pos-1);
$file = OC_AppConfig::getValue('core', 'remote_' . $service);
if(is_null($file)){
	header('HTTP/1.0 404 Not Found');
	exit;
}

$parts=explode('/', $file, 2);
$app=$parts[0];
OC_App::loadApp($app);

$baseuri = OC::$WEBROOT . '/remote.php/'.$service.'/';
require_once(OC_App::getAppPath($app) .'/'. $parts[1]);