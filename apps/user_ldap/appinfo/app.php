<?php
/**
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 *
 * @author Arthur Schiwon <blizzz@arthur-schiwon.de>
 * @author Bart Visscher <bartv@thisnet.nl>
 * @author Christopher Schäpers <kondou@ts.unde.re>
 * @author Dominik Schmidt <dev@dominik-schmidt.de>
 * @author Joas Schilling <coding@schilljs.com>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Robin Appelman <robin@icewind.nl>
 * @author Thomas Müller <thomas.mueller@tmit.eu>
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

$helper = new \OCA\User_LDAP\Helper(\OC::$server->getConfig());
$configPrefixes = $helper->getServerConfigurationPrefixes(true);
$ldapWrapper = new OCA\User_LDAP\LDAP();
$ocConfig = \OC::$server->getConfig();
$notificationManager = \OC::$server->getNotificationManager();
$notificationManager->registerNotifier(function() {
	return new \OCA\User_LDAP\Notification\Notifier(
	  \OC::$server->getL10NFactory()
	);
}, function() {
		$l = \OC::$server->getL10N('user_ldap');
		return [
			'id' => 'user_ldap',
			'name' => $l->t('LDAP user and group backend'),
		];
});
if(count($configPrefixes) === 1) {
	$dbc = \OC::$server->getDatabaseConnection();
	$userManager = new OCA\User_LDAP\User\Manager($ocConfig,
		new OCA\User_LDAP\FilesystemHelper(),
		new OCA\User_LDAP\LogWrapper(),
		\OC::$server->getAvatarManager(),
		new \OCP\Image(),
		$dbc,
		\OC::$server->getUserManager(),
		$notificationManager
	);
	$connector = new OCA\User_LDAP\Connection($ldapWrapper, $configPrefixes[0]);
	$ldapAccess = new OCA\User_LDAP\Access($connector, $ldapWrapper, $userManager, $helper);

	$ldapAccess->setUserMapper(new OCA\User_LDAP\Mapping\UserMapping($dbc));
	$ldapAccess->setGroupMapper(new OCA\User_LDAP\Mapping\GroupMapping($dbc));
	$userBackend  = new OCA\User_LDAP\User_LDAP($ldapAccess, $ocConfig, $notificationManager);
	$groupBackend = new \OCA\User_LDAP\Group_LDAP($ldapAccess);
} else if(count($configPrefixes) > 1) {
	$userBackend  = new OCA\User_LDAP\User_Proxy(
		$configPrefixes, $ldapWrapper, $ocConfig, $notificationManager
	);
	$groupBackend  = new OCA\User_LDAP\Group_Proxy($configPrefixes, $ldapWrapper);
}

if(count($configPrefixes) > 0) {
	// register user backend
	OC_User::useBackend($userBackend);
	OC_Group::useBackend($groupBackend);
}

\OCP\Util::connectHook(
	'\OCA\Files_Sharing\API\Server2Server',
	'preLoginNameUsedAsUserName',
	'\OCA\User_LDAP\Helper',
	'loginName2UserName'
);

if(OCP\App::isEnabled('user_webdavauth')) {
	OCP\Util::writeLog('user_ldap',
		'user_ldap and user_webdavauth are incompatible. You may experience unexpected behaviour',
		OCP\Util::WARN);
}
