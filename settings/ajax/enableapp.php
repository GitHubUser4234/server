<?php

OC_JSON::checkAdminUser();
OCP\JSON::callCheck();

$groups = isset($_POST['groups']) ? (array)$_POST['groups'] : null;

try {
	OC_App::enable(OC_App::cleanAppId((string)$_POST['appid']), $groups);
	// FIXME: Clear the cache - move that into some sane helper method
	\OC::$server->getMemCacheFactory()->create('settings')->remove('listApps-0');
	\OC::$server->getMemCacheFactory()->create('settings')->remove('listApps-1');
	OC_JSON::success();
} catch (Exception $e) {
	OC_Log::write('core', $e->getMessage(), OC_Log::ERROR);
	OC_JSON::error(array("data" => array("message" => $e->getMessage()) ));
}
