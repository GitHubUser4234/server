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

namespace OC\Lock;

use OCP\Lock\ILockingProvider;
use OCP\Lock\LockedException;
use OCP\IMemcache;

class MemcacheLockingProvider implements ILockingProvider {
	/**
	 * @var \OCP\IMemcache
	 */
	private $memcache;

	/**
	 * @param \OCP\IMemcache $memcache
	 */
	public function __construct(IMemcache $memcache) {
		$this->memcache = $memcache;
	}

	/**
	 * @param string $path
	 * @param int $type self::LOCK_SHARED or self::LOCK_EXCLUSIVE
	 * @return bool
	 */
	public function isLocked($path, $type) {
		$lockValue = $this->memcache->get($path);
		if ($type === self::LOCK_SHARED) {
			return $lockValue > 0;
		} else if ($type === self::LOCK_EXCLUSIVE) {
			return $lockValue === 'exclusive';
		} else {
			return false;
		}
	}

	/**
	 * @param string $path
	 * @param int $type self::LOCK_SHARED or self::LOCK_EXCLUSIVE
	 * @throws \OCP\Lock\LockedException
	 */
	public function acquireLock($path, $type) {
		if ($type === self::LOCK_SHARED) {
			if (!$this->memcache->inc($path)) {
				throw new LockedException($path . ' is locked');
			}
		} else {
			$this->memcache->add($path, 0);
			if (!$this->memcache->cas($path, 0, 'exclusive')) {
				throw new LockedException($path . ' is locked');
			}
		}
	}

	/**
	 * @param string $path
	 * @param int $type self::LOCK_SHARED or self::LOCK_EXCLUSIVE
	 */
	public function releaseLock($path, $type) {
		if ($type === self::LOCK_SHARED) {
			$this->memcache->dec($path);
		} else if ($type === self::LOCK_EXCLUSIVE) {
			$this->memcache->cas($path, 'exclusive', 0);
		}
	}
}
