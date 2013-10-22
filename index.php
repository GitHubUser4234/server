<?php

/**
* ownCloud
*
* @author Frank Karlitschek
* @copyright 2010 Frank Karlitschek karlitschek@kde.org
*
* This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
* License as published by the Free Software Foundation; either
* version 3 of the License, or any later version.
*
* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU AFFERO GENERAL PUBLIC LICENSE for more details.
*
* You should have received a copy of the GNU Affero General Public
* License along with this library.  If not, see <http://www.gnu.org/licenses/>.
*
*/

$RUNTIME_NOAPPS = true; //no apps, yet

function logException($ex) {
	$message = $ex->getMessage();
	if ($ex->getCode()) {
		$message .= ' [' . $message . ']';
	}
	\OCP\Util::writeLog('index', $message, \OCP\Util::FATAL);
	if (defined('DEBUG') and DEBUG) {
		// also log stack trace
		$stack = explode('#', $ex->getTraceAsString());
		// first element is empty
		array_shift($stack);
		foreach ($stack as $s) {
			\OCP\Util::writeLog('index', $s, \OCP\Util::FATAL);
		}

		// include cause
		$l = OC_L10N::get('lib');
		while (method_exists($ex, 'getPrevious') && $ex = $ex->getPrevious()) {
			$message .= ' - '.$l->t('Caused by:').' ';
			$message .= $ex->getMessage();
			if ($ex->getCode()) {
				$message .= '['.$ex->getCode().'] ';
			}
			\OCP\Util::writeLog('index', $message, \OCP\Util::FATAL);
		}
	}
}

try {
	
	require_once 'lib/base.php';

	OC::handleRequest();

} catch (Exception $ex) {
	logException($ex);

	//show the user a detailed error page
	OC_Response::setStatus(OC_Response::STATUS_INTERNAL_SERVER_ERROR);
	OC_Template::printExceptionErrorPage($ex);
}
