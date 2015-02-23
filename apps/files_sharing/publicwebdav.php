<?php
/**
 * @author Bjoern Schiessle <schiessle@owncloud.com>
 * @author Joas Schilling <nickvergessen@gmx.de>
 * @author Robin Appelman <icewind@owncloud.com>
 * @author Thomas Müller <thomas.mueller@tmit.eu>
 *
 * @copyright Copyright (c) 2015, ownCloud, Inc.
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
if (OCA\Files_Sharing\Helper::isOutgoingServer2serverShareEnabled() === false) {
	return false;
}

// load needed apps
$RUNTIME_APPTYPES = array('filesystem', 'authentication', 'logging');

OC_App::loadApps($RUNTIME_APPTYPES);

OC_Util::obEnd();

// Backends
$authBackend = new OCA\Files_Sharing\Connector\PublicAuth(\OC::$server->getConfig());
$lockBackend = new OC_Connector_Sabre_Locks();
$requestBackend = new OC_Connector_Sabre_Request();

// Fire up server
$objectTree = new \OC\Connector\Sabre\ObjectTree();
$server = new OC_Connector_Sabre_Server($objectTree);
$server->httpRequest = $requestBackend;
$server->setBaseUri($baseuri);

// Load plugins
$defaults = new OC_Defaults();
$server->addPlugin(new \Sabre\DAV\Auth\Plugin($authBackend, $defaults->getName()));
$server->addPlugin(new \Sabre\DAV\Locks\Plugin($lockBackend));
$server->addPlugin(new \Sabre\DAV\Browser\Plugin(false)); // Show something in the Browser, but no upload
$server->addPlugin(new OC_Connector_Sabre_FilesPlugin());
$server->addPlugin(new OC_Connector_Sabre_MaintenancePlugin());
$server->addPlugin(new OC_Connector_Sabre_ExceptionLoggerPlugin('webdav'));

// wait with registering these until auth is handled and the filesystem is setup
$server->subscribeEvent('beforeMethod', function () use ($server, $objectTree, $authBackend) {
	$share = $authBackend->getShare();
	$owner = $share['uid_owner'];
	$isWritable = $share['permissions'] & (\OCP\Constants::PERMISSION_UPDATE | \OCP\Constants::PERMISSION_CREATE);
	$fileId = $share['file_source'];

	if (!$isWritable) {
		\OC\Files\Filesystem::addStorageWrapper('readonly', function ($mountPoint, $storage) {
			return new \OCA\Files_Sharing\ReadOnlyWrapper(array('storage' => $storage));
		});
	}

	OC_Util::setupFS($owner);
	$ownerView = \OC\Files\Filesystem::getView();
	$path = $ownerView->getPath($fileId);

	$view = new \OC\Files\View($ownerView->getAbsolutePath($path));
	$rootInfo = $view->getFileInfo('');

	// Create ownCloud Dir
	if ($rootInfo->getType() === 'dir') {
		$root = new OC_Connector_Sabre_Directory($view, $rootInfo);
	} else {
		$root = new OC_Connector_Sabre_File($view, $rootInfo);
	}
	$mountManager = \OC\Files\Filesystem::getMountManager();
	$objectTree->init($root, $view, $mountManager);

	$server->addPlugin(new OC_Connector_Sabre_QuotaPlugin($view));
}, 30); // priority 30: after auth (10) and acl(20), before lock(50) and handling the request

// And off we go!
$server->exec();
