<?php
/**
 * @author Björn Schießle <bjoern@schiessle.org>
 * @author Georg Ehrke <georg@owncloud.com>
 * @author Joas Schilling <nickvergessen@owncloud.com>
 * @author Lukas Reschke <lukas@statuscode.ch>
 * @author Robin Appelman <icewind@owncloud.com>
 * @author Roeland Jago Douma <rullzer@owncloud.com>
 * @author Thomas Müller <thomas.mueller@tmit.eu>
 *
 * @copyright Copyright (c) 2016, ownCloud, Inc.
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

use OCP\API;

$application = new \OCA\Files_Sharing\AppInfo\Application();
$application->registerRoutes($this, [
	'resources' => [
		'ExternalShares' => ['url' => '/api/externalShares'],
	],
	'routes' => [
		[
			'name' => 'externalShares#testRemote',
			'url' => '/testremote',
			'verb' => 'GET'
		],
	],
	'ocs' => [
		/*
		 * OCS Share API
		 */
		[
			'name' => 'ShareAPI#getShares',
			'url'  => '/api/v1/shares',
			'verb' => 'GET',
		],
		[
			'name' => 'ShareAPI#createShare',
			'url'  => '/api/v1/shares',
			'verb' => 'POST',
		],
		[
			'name' => 'ShareAPI#getShare',
			'url'  => '/api/v1/shares/{id}',
			'verb' => 'GET',
		],
		[
			'name' => 'ShareAPI#updateShare',
			'url'  => '/api/v1/shares/{id}',
			'verb' => 'PUT',
		],
		[
			'name' => 'ShareAPI#deleteShare',
			'url'  => '/api/v1/shares/{id}',
			'verb' => 'DELETE',
		],
	],
]);

/** @var $this \OCP\Route\IRouter */
$this->create('core_ajax_public_preview', '/publicpreview')->action(
	function() {
		require_once __DIR__ . '/../ajax/publicpreview.php';
	});

$this->create('files_sharing_ajax_list', 'ajax/list.php')
	->actionInclude('files_sharing/ajax/list.php');
$this->create('files_sharing_ajax_publicpreview', 'ajax/publicpreview.php')
	->actionInclude('files_sharing/ajax/publicpreview.php');
$this->create('sharing_external_shareinfo', '/shareinfo')
	->actionInclude('files_sharing/ajax/shareinfo.php');

// OCS API

//TODO: SET: mail notification, waiting for PR #4689 to be accepted

API::register('get',
		'/apps/files_sharing/api/v1/remote_shares',
		array('\OCA\Files_Sharing\API\Remote', 'getShares'),
		'files_sharing');

API::register('get',
		'/apps/files_sharing/api/v1/remote_shares/pending',
		array('\OCA\Files_Sharing\API\Remote', 'getOpenShares'),
		'files_sharing');

API::register('post',
		'/apps/files_sharing/api/v1/remote_shares/pending/{id}',
		array('\OCA\Files_Sharing\API\Remote', 'acceptShare'),
		'files_sharing');

API::register('delete',
		'/apps/files_sharing/api/v1/remote_shares/pending/{id}',
		array('\OCA\Files_Sharing\API\Remote', 'declineShare'),
		'files_sharing');

API::register('get',
		'/apps/files_sharing/api/v1/remote_shares/{id}',
		array('\OCA\Files_Sharing\API\Remote', 'getShare'),
		'files_sharing');

API::register('delete',
		'/apps/files_sharing/api/v1/remote_shares/{id}',
		array('\OCA\Files_Sharing\API\Remote', 'unshare'),
		'files_sharing');


$sharees = new \OCA\Files_Sharing\API\Sharees(\OC::$server->getGroupManager(),
                                              \OC::$server->getUserManager(),
                                              \OC::$server->getContactsManager(),
                                              \OC::$server->getConfig(),
                                              \OC::$server->getUserSession(),
                                              \OC::$server->getURLGenerator(),
                                              \OC::$server->getRequest(),
                                              \OC::$server->getLogger(),
                                              \OC::$server->getShareManager());

API::register('get',
		'/apps/files_sharing/api/v1/sharees',
		[$sharees, 'search'],
		'files_sharing', API::USER_AUTH);

