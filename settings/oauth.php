<?php
/**
 * Copyright (c) 2012, Tom Needham <tom@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or later.
 * See the COPYING-README file.
 */

require_once('../lib/base.php');

// Logic
$operation = isset($_GET['operation']) ? $_GET['operation'] : '';
$server = new OC_OAuthServer(new OC_OAuthStore());
switch($operation){
	
	case 'register':
		
	break;
	
	case 'request_token':
		try {
			$request = OAuthRequest::from_request();
			$token = $server->fetch_request_token($request);
			echo $token;
		} catch (OAuthException $exception) {
			OC_Log::write('OC_OAuthServer', $exception->getMessage(), OC_LOG::ERROR);
			echo $exception->getMessage();
		}
		break;
	case 'authorise';
		OC_Util::checkLoggedIn();
		// Example
		$consumer = array(
			'name' => 'Firefox Bookmark Sync',
			'scopes' => array('ookmarks'),
		);
		
		// Check that the scopes are real and installed
		$apps = OC_App::getEnabledApps();
		$notfound = array();
		foreach($consumer['scopes'] as $requiredapp){
			if(!in_array($requiredapp, $apps)){
				$notfound[] = $requiredapp;
			}
		}
		if(!empty($notfound)){
			// We need more apps :( Show error
			if(count($notfound)==1){
				$message = 'requires that you have an extra app installed on your ownCloud. Please contact your ownCloud administrator and ask them to install the app below.';
			} else {
				$message = 'requires that you have some extra apps installed on your ownCloud. Please contract your ownCloud administrator and ask them to install the apps below.';
			}
			$t = new OC_Template('settings', 'oauth-required-apps', 'guest');
			OC_Util::addStyle('settings', 'oauth');
			$t->assign('requiredapps', $notfound);
			$t->assign('consumer', $consumer);
			$t->assign('message', $message);
			$t->printPage();
		} else {
			$t = new OC_Template('settings', 'oauth', 'guest');
			OC_Util::addStyle('settings', 'oauth');
			$t->assign('consumer', $consumer);
			$t->printPage();
		}
	break;
	
	case 'access_token';
		try {
			$request = OAuthRequest::from_request();
			$token = $server->fetch_access_token($request);
			echo $token;
		} catch (OAuthException $exception) {
			OC_Log::write('OC_OAuthServer', $exception->getMessage(), OC_LOG::ERROR);
			echo $exception->getMessage();
		}
		break;
	default:
		// Something went wrong
		header('Location: /');
	break;
	
}
