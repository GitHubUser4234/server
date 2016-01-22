<?php
/**
 * @author Robin Appelman <icewind@owncloud.com>
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

namespace OC\Files\Config;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use OCP\Files\Config\ICachedMountInfo;
use OCP\Files\Config\IUserMountCache;
use OCP\Files\Mount\IMountPoint;
use OCP\ICache;
use OCP\IDBConnection;
use OCP\ILogger;
use OCP\IUser;
use OCP\IUserManager;

/**
 * Cache mounts points per user in the cache so we can easilly look them up
 */
class UserMountCache implements IUserMountCache {
	/**
	 * @var IDBConnection
	 */
	private $connection;

	/**
	 * @var IUserManager
	 */
	private $userManager;

	/** @var ICachedMountInfo[][] [$userId => [$cachedMountInfo, ....], ...] */
	private $mountsForUsers = [];

	/**
	 * @var ILogger
	 */
	private $logger;

	/**
	 * UserMountCache constructor.
	 *
	 * @param IDBConnection $connection
	 * @param IUserManager $userManager
	 * @param ILogger $logger
	 */
	public function __construct(IDBConnection $connection, IUserManager $userManager, ILogger $logger) {
		$this->connection = $connection;
		$this->userManager = $userManager;
		$this->logger = $logger;
	}

	public function registerMounts(IUser $user, array $mounts) {
		// filter out non-proper storages coming from unit tests
		$mounts = array_filter($mounts, function (IMountPoint $mount) {
			return $mount->getStorage()->getCache();
		});
		/** @var ICachedMountInfo[] $newMounts */
		$newMounts = array_map(function (IMountPoint $mount) use ($user) {
			$storage = $mount->getStorage();
			$rootId = (int)$storage->getCache()->getId('');
			$storageId = (int)$storage->getStorageCache()->getNumericId();
			// filter out any storages which aren't scanned yet since we aren't interested in files from those storages (yet)
			if ($rootId === -1) {
				return null;
			} else {
				return new CachedMountInfo($user, $storageId, $rootId, $mount->getMountPoint());
			}
		}, $mounts);
		$newMounts = array_values(array_filter($newMounts));

		$cachedMounts = $this->getMountsForUser($user);
		$mountDiff = function (ICachedMountInfo $mount1, ICachedMountInfo $mount2) {
			// since we are only looking for mounts for a specific user comparing on root id is enough
			return $mount1->getRootId() - $mount2->getRootId();
		};

		/** @var ICachedMountInfo[] $addedMounts */
		$addedMounts = array_udiff($newMounts, $cachedMounts, $mountDiff);
		/** @var ICachedMountInfo[] $removedMounts */
		$removedMounts = array_udiff($cachedMounts, $newMounts, $mountDiff);

		$changedMounts = array_uintersect($newMounts, $cachedMounts, function (ICachedMountInfo $mount1, ICachedMountInfo $mount2) {
			// filter mounts with the same root id and different mountpoints
			if ($mount1->getRootId() !== $mount2->getRootId()) {
				return -1;
			}
			return ($mount1->getMountPoint() !== $mount2->getMountPoint()) ? 0 : 1;
		});

		foreach ($addedMounts as $mount) {
			$this->addToCache($mount);
			$this->mountsForUsers[$user->getUID()][] = $mount;
		}
		foreach ($removedMounts as $mount) {
			$this->removeFromCache($mount);
			$index = array_search($mount, $this->mountsForUsers[$user->getUID()]);
			unset($this->mountsForUsers[$user->getUID()][$index]);
		}
		foreach ($changedMounts as $mount) {
			$this->setMountPoint($mount);
		}
	}

	private function addToCache(ICachedMountInfo $mount) {
		$this->connection->insertIfNotExist('*PREFIX*mounts', [
			'storage_id' => $mount->getStorageId(),
			'root_id' => $mount->getRootId(),
			'user_id' => $mount->getUser()->getUID(),
			'mount_point' => $mount->getMountPoint()
		]);
	}

	private function setMountPoint(ICachedMountInfo $mount) {
		$builder = $this->connection->getQueryBuilder();

		$query = $builder->update('mounts')
			->set('mount_point', $builder->createNamedParameter($mount->getMountPoint()))
			->where($builder->expr()->eq('user_id', $builder->createNamedParameter($mount->getUser()->getUID())))
			->andWhere($builder->expr()->eq('root_id', $builder->createNamedParameter($mount->getRootId(), \PDO::PARAM_INT)));

		$query->execute();
	}

	private function removeFromCache(ICachedMountInfo $mount) {
		$builder = $this->connection->getQueryBuilder();

		$query = $builder->delete('mounts')
			->where($builder->expr()->eq('user_id', $builder->createNamedParameter($mount->getUser()->getUID())))
			->andWhere($builder->expr()->eq('root_id', $builder->createNamedParameter($mount->getRootId(), \PDO::PARAM_INT)));
		$query->execute();
	}

	private function dbRowToMountInfo(array $row) {
		$user = $this->userManager->get($row['user_id']);
		return new CachedMountInfo($user, (int)$row['storage_id'], (int)$row['root_id'], $row['mount_point']);
	}

	/**
	 * @param IUser $user
	 * @return ICachedMountInfo[]
	 */
	public function getMountsForUser(IUser $user) {
		if (!isset($this->mountsForUsers[$user->getUID()])) {
			$builder = $this->connection->getQueryBuilder();
			$query = $builder->select('storage_id', 'root_id', 'user_id', 'mount_point')
				->from('mounts')
				->where($builder->expr()->eq('user_id', $builder->createPositionalParameter($user->getUID())));

			$rows = $query->execute()->fetchAll();

			$this->mountsForUsers[$user->getUID()] = array_map([$this, 'dbRowToMountInfo'], $rows);
		}
		return $this->mountsForUsers[$user->getUID()];
	}

	/**
	 * @param int $numericStorageId
	 * @return CachedMountInfo[]
	 */
	public function getMountsForStorageId($numericStorageId) {
		$builder = $this->connection->getQueryBuilder();
		$query = $builder->select('storage_id', 'root_id', 'user_id', 'mount_point')
			->from('mounts')
			->where($builder->expr()->eq('storage_id', $builder->createPositionalParameter($numericStorageId, \PDO::PARAM_INT)));

		$rows = $query->execute()->fetchAll();

		return array_map([$this, 'dbRowToMountInfo'], $rows);
	}

	/**
	 * @param int $rootFileId
	 * @return CachedMountInfo[]
	 */
	public function getMountsForRootId($rootFileId) {
		$builder = $this->connection->getQueryBuilder();
		$query = $builder->select('storage_id', 'root_id', 'user_id', 'mount_point')
			->from('mounts')
			->where($builder->expr()->eq('root_id', $builder->createPositionalParameter($rootFileId, \PDO::PARAM_INT)));

		$rows = $query->execute()->fetchAll();

		return array_map([$this, 'dbRowToMountInfo'], $rows);
	}

	/**
	 * Remove all cached mounts for a user
	 *
	 * @param IUser $user
	 */
	public function removeUserMounts(IUser $user) {
		$builder = $this->connection->getQueryBuilder();

		$query = $builder->delete('mounts')
			->where($builder->expr()->eq('user_id', $builder->createNamedParameter($user->getUID())));
		$query->execute();
	}

	public function removeUserStorageMount($storageId, $userId) {
		$builder = $this->connection->getQueryBuilder();

		$query = $builder->delete('mounts')
			->where($builder->expr()->eq('user_id', $builder->createNamedParameter($userId)))
			->andWhere($builder->expr()->eq('storage_id', $builder->createNamedParameter($storageId, \PDO::PARAM_INT)));
		$query->execute();
	}

	public function remoteStorageMounts($storageId) {
		$builder = $this->connection->getQueryBuilder();

		$query = $builder->delete('mounts')
			->where($builder->expr()->eq('storage_id', $builder->createNamedParameter($storageId, \PDO::PARAM_INT)));
		$query->execute();
	}
}
