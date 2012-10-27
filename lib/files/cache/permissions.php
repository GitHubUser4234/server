<?php
/**
 * Copyright (c) 2012 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OC\Files\Cache;

class Permissions {
	/**
	 * get the permissions for a single file
	 *
	 * @param int $fileId
	 * @param string $user
	 * @return int (-1 if file no permissions set)
	 */
	static public function get($fileId, $user) {
		$query = \OC_DB::prepare('SELECT `permissions` FROM `*PREFIX*permissions` WHERE `user` = ? AND `fileid` = ?');
		$result = $query->execute(array($user, $fileId));
		if ($row = $result->fetchRow()) {
			return $row['permissions'];
		} else {
			return -1;
		}
	}

	/**
	 * set the permissions of a file
	 *
	 * @param int $fileId
	 * @param string $user
	 * @param int $permissions
	 */
	static public function set($fileId, $user, $permissions) {
		if (self::get($fileId, $user) !== -1) {
			$query = \OC_DB::prepare('UPDATE `*PREFIX*permissions` SET `permissions` = ? WHERE `user` = ? AND `fileid` = ?');
		} else {
			$query = \OC_DB::prepare('INSERT INTO `*PREFIX*permissions`(`permissions`, `user`, `fileid`) VALUES(?, ?,? )');
		}
		$query->execute(array($permissions, $user, $fileId));
	}

	/**
	 * get the permissions of multiply files
	 *
	 * @param int[] $fileIds
	 * @param string $user
	 * @return int[]
	 */
	static public function getMultiple($fileIds, $user) {
		if (count($fileIds) === 0) {
			return array();
		}
		$params = $fileIds;
		$params[] = $user;
		$inPart = implode(', ', array_fill(0, count($fileIds), '?'));

		$query = \OC_DB::prepare('SELECT `fileid`, `permissions` FROM `*PREFIX*permissions` WHERE  `fileid` IN (' . $inPart . ') AND `user` = ?');
		$result = $query->execute($params);
		$filePermissions = array();
		while ($row = $result->fetchRow()) {
			$filePermissions[$row['fileid']] = $row['permissions'];
		}
		return $filePermissions;
	}

	/**
	 * remove the permissions for a file
	 *
	 * @param int $fileId
	 * @param string $user
	 */
	static public function remove($fileId, $user) {
		$query = \OC_DB::prepare('DELETE FROM `*PREFIX*permissions` WHERE `fileid` = ? AND `user` = ?');
		$query->execute(array($fileId, $user));
	}

	static public function removeMultiple($fileIds, $user) {
		$params = $fileIds;
		$params[] = $user;
		$inPart = implode(', ', array_fill(0, count($fileIds), '?'));

		$query = \OC_DB::prepare('DELETE FROM `*PREFIX*permissions` WHERE `fileid` IN (' . $inPart . ') AND `user` = ?');
		$query->execute($params);
	}
}
