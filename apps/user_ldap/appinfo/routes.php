<?php
/**
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 *
 * @author Lukas Reschke <lukas@statuscode.ch>
 * @author Morris Jobke <hey@morrisjobke.de>
 *
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

/** @var $this \OCP\Route\IRouter */
use OCA\User_LDAP\AppInfo\Application;

$this->create('user_ldap_ajax_clearMappings', 'ajax/clearMappings.php')
	->actionInclude('user_ldap/ajax/clearMappings.php');
$this->create('user_ldap_ajax_deleteConfiguration', 'ajax/deleteConfiguration.php')
	->actionInclude('user_ldap/ajax/deleteConfiguration.php');
$this->create('user_ldap_ajax_getConfiguration', 'ajax/getConfiguration.php')
	->actionInclude('user_ldap/ajax/getConfiguration.php');
$this->create('user_ldap_ajax_getNewServerConfigPrefix', 'ajax/getNewServerConfigPrefix.php')
	->actionInclude('user_ldap/ajax/getNewServerConfigPrefix.php');
$this->create('user_ldap_ajax_setConfiguration', 'ajax/setConfiguration.php')
	->actionInclude('user_ldap/ajax/setConfiguration.php');
$this->create('user_ldap_ajax_testConfiguration', 'ajax/testConfiguration.php')
	->actionInclude('user_ldap/ajax/testConfiguration.php');
$this->create('user_ldap_ajax_wizard', 'ajax/wizard.php')
	->actionInclude('user_ldap/ajax/wizard.php');

$application = new Application();
$application->registerRoutes($this, [
	'routes' => [
		['name' => 'renewPassword#tryRenewPassword', 'url' => '/renewpassword', 'verb' => 'POST'],
		['name' => 'renewPassword#showRenewPasswordForm', 'url' => '/renewpassword/{user}', 'verb' => 'GET'],
		['name' => 'renewPassword#cancel', 'url' => '/renewpassword/cancel', 'verb' => 'GET'],
		['name' => 'renewPassword#showLoginFormInvalidPassword', 'url' => '/renewpassword/invalidlogin/{user}', 'verb' => 'GET'],
	],
]);
