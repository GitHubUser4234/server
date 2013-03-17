<?php
/**
 * Copyright (c) 2013 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OC\Memcache;

abstract class Cache {
	/**
	 * get a cache instance
	 *
	 * @param bool $global
	 * @return Cache
	 */
	static function create($global = false) {
		if (XCache::isAvailable()) {
			return new XCache($global);
		} elseif (APC::isAvailable()) {
			return new APC($global);
		} elseif (Memcached::isAvailable()) {
			return new Memcached($global);
		} else {
			return null;
		}
	}

	/**
	 * @param bool $global
	 */
	abstract public function __construct($global);

	/**
	 * @param string $key
	 * @return mixed
	 */
	abstract public function get($key);

	/**
	 * @param string $key
	 * @param mixed $value
	 * @param int $ttl
	 * @return mixed
	 */
	abstract public function set($key, $value, $ttl = 0);

	/**
	 * @param string $key
	 * @return mixed
	 */
	abstract public function hasKey($key);

	/**
	 * @param string $key
	 * @return mixed
	 */
	abstract public function remove($key);

	/**
	 * @param string $prefix
	 * @return mixed
	 */
	abstract public function clear($prefix = '');

	/**
	 * @return bool
	 */
	static public function isAvailable() {
		return XCache::isAvailable() || APC::isAvailable() || Memcached::isAvailable();
	}
}
