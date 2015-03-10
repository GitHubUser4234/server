<?php

try {
	require_once 'lib/base.php';

	if (\OCP\Util::needUpgrade()) {
		// since the behavior of apps or remotes are unpredictable during
		// an upgrade, return a 503 directly
		OC_Response::setStatus(OC_Response::STATUS_SERVICE_UNAVAILABLE);
		OC_Template::printErrorPage('Service unavailable');
		exit;
	}

	$request = \OC::$server->getRequest();
	$pathInfo = $request->getPathInfo();
	if ($pathInfo === false || $pathInfo === '') {
		OC_Response::setStatus(OC_Response::STATUS_NOT_FOUND);
		exit;
	}
	if (!$pos = strpos($pathInfo, '/', 1)) {
		$pos = strlen($pathInfo);
	}
	$service=substr($pathInfo, 1, $pos-1);

	$file = \OC::$server->getConfig()->getAppValue('core', 'remote_' . $service);

	if(is_null($file)) {
		OC_Response::setStatus(OC_Response::STATUS_NOT_FOUND);
		exit;
	}

	// force language as given in the http request
	\OC_L10N::setLanguageFromRequest();

	$file=ltrim($file, '/');

	$parts=explode('/', $file, 2);
	$app=$parts[0];

	// Load all required applications
	\OC::$REQUESTEDAPP = $app;
	OC_App::loadApps(array('authentication'));
	OC_App::loadApps(array('filesystem', 'logging'));

	switch ($app) {
		case 'core':
			$file =  OC::$SERVERROOT .'/'. $file;
			break;
		default:
			if (!\OC::$server->getAppManager()->isInstalled($app)) {
				throw new Exception('App not installed: ' . $app);
			}
			OC_App::loadApp($app);
			$file = OC_App::getAppPath($app) .'/'. $parts[1];
			break;
	}
	$baseuri = OC::$WEBROOT . '/remote.php/'.$service.'/';
	require_once $file;

} catch (\OC\ServiceUnavailableException $ex) {
	OC_Response::setStatus(OC_Response::STATUS_SERVICE_UNAVAILABLE);
	\OCP\Util::writeLog('remote', $ex->getMessage(), \OCP\Util::FATAL);
	OC_Template::printExceptionErrorPage($ex);
} catch (Exception $ex) {
	OC_Response::setStatus(OC_Response::STATUS_INTERNAL_SERVER_ERROR);
	\OCP\Util::writeLog('remote', $ex->getMessage(), \OCP\Util::FATAL);
	OC_Template::printExceptionErrorPage($ex);
}
