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
	 * @var string $prefix
	 */
	protected $prefix;

	/**
	 * @param string $prefix
	 */
	public function __construct($prefix = '') {
		$this->prefix = \OC_Util::getInstanceId() . '/' . $prefix;
	}

	public function getPrefix() {
		return $this->prefix;
	}

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
}
