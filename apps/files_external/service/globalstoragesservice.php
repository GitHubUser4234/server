<?php
/**
 * Copyright (c) 2015 Vincent Petry <pvince81@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OCA\Files_external\Service;

use \OCP\IUserSession;
use \OC\Files\Filesystem;

use \OCA\Files_external\Lib\StorageConfig;
use \OCA\Files_external\NotFoundException;

/**
 * Service class to manage global external storages
 */
class GlobalStoragesService extends StoragesService {

	/**
	 * Write the storages to the configuration.
	 *
	 * @param string $user user or null for global config
	 * @param array $storages map of storage id to storage config
	 */
	public function writeConfig($storages) {
		// let the horror begin
		$mountPoints = [];
		foreach ($storages as $storageConfig) {
			$mountPoint = $storageConfig->getMountPoint();
			$oldBackendOptions = $storageConfig->getBackendOptions();
			$storageConfig->setBackendOptions(
				\OC_Mount_Config::encryptPasswords(
					$oldBackendOptions
				)
			);

			// system mount
			$rootMountPoint = '/$user/files/' . ltrim($mountPoint, '/');

			$applicableUsers = $storageConfig->getApplicableUsers();
			$applicableGroups = $storageConfig->getApplicableGroups();
			foreach ($applicableUsers as $applicable) {
				$this->addMountPoint(
					$mountPoints,
					\OC_Mount_Config::MOUNT_TYPE_USER,
					$applicable,
					$rootMountPoint,
					$storageConfig
				);
			}

			foreach ($applicableGroups as $applicable) {
				$this->addMountPoint(
					$mountPoints,
					\OC_Mount_Config::MOUNT_TYPE_GROUP,
					$applicable,
					$rootMountPoint,
					$storageConfig
				);
			}

			// if neither "applicableGroups" or "applicableUsers" were set, use "all" user
			if (empty($applicableUsers) && empty($applicableGroups)) {
				$this->addMountPoint(
					$mountPoints,
					\OC_Mount_Config::MOUNT_TYPE_USER,
					'all',
					$rootMountPoint,
					$storageConfig
				);
			}

			// restore old backend options where the password was not encrypted,
			// because we don't want to change the state of the original object
			$storageConfig->setBackendOptions($oldBackendOptions);
		}

		\OC_Mount_Config::writeData(null, $mountPoints);
	}

	/**
	 * Triggers $signal for all applicable users of the given
	 * storage
	 *
	 * @param StorageConfig $storage storage data
	 * @param string $signal signal to trigger
	 */
	protected function triggerHooks(StorageConfig $storage, $signal) {
		$applicableUsers = $storage->getApplicableUsers();
		$applicableGroups = $storage->getApplicableGroups();
		if (empty($applicableUsers) && empty($applicableGroups)) {
			// raise for user "all"
			$this->triggerApplicableHooks(
				$signal,
				$storage->getMountPoint(),
				\OC_Mount_Config::MOUNT_TYPE_USER,
				['all']
			);
			return;
		}

		$this->triggerApplicableHooks(
			$signal,
			$storage->getMountPoint(),
			\OC_Mount_Config::MOUNT_TYPE_USER,
			$applicableUsers
		);
		$this->triggerApplicableHooks(
			$signal,
			$storage->getMountPoint(),
			\OC_Mount_Config::MOUNT_TYPE_GROUP,
			$applicableGroups
		);
	}

	/**
	 * Triggers signal_create_mount or signal_delete_mount to
	 * accomodate for additions/deletions in applicableUsers
	 * and applicableGroups fields.
	 *
	 * @param StorageConfig $oldStorage old storage data
	 * @param StorageConfig $newStorage new storage data
	 */
	protected function triggerChangeHooks(StorageConfig $oldStorage, StorageConfig $newStorage) {
		// if mount point changed, it's like a deletion + creation
		if ($oldStorage->getMountPoint() !== $newStorage->getMountPoint()) {
			$this->triggerHooks($oldStorage, Filesystem::signal_delete_mount);
			$this->triggerHooks($newStorage, Filesystem::signal_create_mount);
			return;
		}

		$userAdditions = array_diff($newStorage->getApplicableUsers(), $oldStorage->getApplicableUsers());
		$userDeletions = array_diff($oldStorage->getApplicableUsers(), $newStorage->getApplicableUsers());
		$groupAdditions = array_diff($newStorage->getApplicableGroups(), $oldStorage->getApplicableGroups());
		$groupDeletions = array_diff($oldStorage->getApplicableGroups(), $newStorage->getApplicableGroups());

		// if no applicable were set, raise a signal for "all"
		if (empty($oldStorage->getApplicableUsers()) && empty($oldStorage->getApplicableGroups())) {
			$this->triggerApplicableHooks(
				Filesystem::signal_delete_mount,
				$oldStorage->getMountPoint(),
				\OC_Mount_Config::MOUNT_TYPE_USER,
				['all']
			);
		}

		// trigger delete for removed users
		$this->triggerApplicableHooks(
			Filesystem::signal_delete_mount,
			$oldStorage->getMountPoint(),
			\OC_Mount_Config::MOUNT_TYPE_USER,
			$userDeletions
		);

		// trigger delete for removed groups
		$this->triggerApplicableHooks(
			Filesystem::signal_delete_mount,
			$oldStorage->getMountPoint(),
			\OC_Mount_Config::MOUNT_TYPE_GROUP,
			$groupDeletions
		);

		// and now add the new users
		$this->triggerApplicableHooks(
			Filesystem::signal_create_mount,
			$newStorage->getMountPoint(),
			\OC_Mount_Config::MOUNT_TYPE_USER,
			$userAdditions
		);

		// and now add the new groups
		$this->triggerApplicableHooks(
			Filesystem::signal_create_mount,
			$newStorage->getMountPoint(),
			\OC_Mount_Config::MOUNT_TYPE_GROUP,
			$groupAdditions
		);

		// if no applicable, raise a signal for "all"
		if (empty($newStorage->getApplicableUsers()) && empty($newStorage->getApplicableGroups())) {
			$this->triggerApplicableHooks(
				Filesystem::signal_create_mount,
				$newStorage->getMountPoint(),
				\OC_Mount_Config::MOUNT_TYPE_USER,
				['all']
			);
		}
	}
}
