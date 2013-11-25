<?php
/**
 * Copyright (c) 2013, Bjoern Schiessle <schiessle@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or later.
 * See the COPYING-README file.
 *
 * @brief check migration status
 */
use OCA\Encryption\Util;

\OCP\JSON::checkAppEnabled('files_encryption');

$user = isset($_GET['user']) ? $_GET['user'] : '';
$password = isset($_GET['password']) ? $_GET['password'] : '';

$migrationCompleted = true;

if ($user !== '' && $password !== '') {
	if (\OCP\User::checkPassword($user, $password)) {
		error_log("password ok");
		$util = new Util(new \OC_FilesystemView('/'), $user);
		if ($util->getMigrationStatus($user) !== Util::MIGRATION_COMPLETED) {
			$migrationCompleted = false;
		}
	}
}

\OCP\JSON::success(array('data' => array('migrationCompleted' => $migrationCompleted)));
