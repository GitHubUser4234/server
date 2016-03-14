<?php
/**
 * @author Andreas Fischer <bantu@owncloud.com>
 * @author Bart Visscher <bartv@thisnet.nl>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Robin Appelman <icewind@owncloud.com>
 * @author Robin McCorkell <robin@mccorkell.me.uk>
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

namespace OC\Memcache;

use OCP\IMemcache;

class Memcached extends Cache implements IMemcache {
	use CASTrait;

	/**
	 * @var \Memcached $cache
	 */
	private static $cache = null;

	use CADTrait;

	public function __construct($prefix = '') {
		parent::__construct($prefix);
		if (is_null(self::$cache)) {
			self::$cache = new \Memcached();
			$servers = \OC::$server->getSystemConfig()->getValue('memcached_servers');
			if (!$servers) {
				$server = \OC::$server->getSystemConfig()->getValue('memcached_server');
				if ($server) {
					$servers = array($server);
				} else {
					$servers = array(array('localhost', 11211));
				}
			}
			self::$cache->addServers($servers);
		}
	}

	/**
	 * entries in XCache gets namespaced to prevent collisions between owncloud instances and users
	 */
	protected function getNameSpace() {
		return $this->prefix;
	}

	public function get($key) {
		$result = self::$cache->get($this->getNamespace() . $key);
		if ($result === false and self::$cache->getResultCode() == \Memcached::RES_NOTFOUND) {
			return null;
		} else {
			return $result;
		}
	}

	public function set($key, $value, $ttl = 0) {
		if ($ttl > 0) {
			$result =  self::$cache->set($this->getNamespace() . $key, $value, $ttl);
		} else {
			$result = self::$cache->set($this->getNamespace() . $key, $value);
		}
		$this->verifyReturnCode();
		return $result;
	}

	public function hasKey($key) {
		self::$cache->get($this->getNamespace() . $key);
		return self::$cache->getResultCode() === \Memcached::RES_SUCCESS;
	}

	public function remove($key) {
		$result= self::$cache->delete($this->getNamespace() . $key);
		if (self::$cache->getResultCode() !== \Memcached::RES_NOTFOUND) {
			$this->verifyReturnCode();
		}
		return $result;
	}

	public function clear($prefix = '') {
		$prefix = $this->getNamespace() . $prefix;
		$allKeys = self::$cache->getAllKeys();
		if ($allKeys === false) {
			// newer Memcached doesn't like getAllKeys(), flush everything
			self::$cache->flush();
			return true;
		}
		$keys = array();
		$prefixLength = strlen($prefix);
		foreach ($allKeys as $key) {
			if (substr($key, 0, $prefixLength) === $prefix) {
				$keys[] = $key;
			}
		}
		if (method_exists(self::$cache, 'deleteMulti')) {
			self::$cache->deleteMulti($keys);
		} else {
			foreach ($keys as $key) {
				self::$cache->delete($key);
			}
		}
		return true;
	}

	/**
	 * Set a value in the cache if it's not already stored
	 *
	 * @param string $key
	 * @param mixed $value
	 * @param int $ttl Time To Live in seconds. Defaults to 60*60*24
	 * @return bool
	 * @throws \Exception
	 */
	public function add($key, $value, $ttl = 0) {
		$result = self::$cache->add($this->getPrefix() . $key, $value, $ttl);
		if (self::$cache->getResultCode() !== \Memcached::RES_NOTSTORED) {
			$this->verifyReturnCode();
		}
		return $result;
	}

	/**
	 * Increase a stored number
	 *
	 * @param string $key
	 * @param int $step
	 * @return int | bool
	 */
	public function inc($key, $step = 1) {
		$this->add($key, 0);
		$result = self::$cache->increment($this->getPrefix() . $key, $step);

		if (self::$cache->getResultCode() !== \Memcached::RES_SUCCESS) {
			return false;
		}

		return $result;
	}

	/**
	 * Decrease a stored number
	 *
	 * @param string $key
	 * @param int $step
	 * @return int | bool
	 */
	public function dec($key, $step = 1) {
		$result = self::$cache->decrement($this->getPrefix() . $key, $step);

		if (self::$cache->getResultCode() !== \Memcached::RES_SUCCESS) {
			return false;
		}

		return $result;
	}

	static public function isAvailable() {
		return extension_loaded('memcached');
	}

	/**
	 * @throws \Exception
	 */
	private function verifyReturnCode() {
		$code = self::$cache->getResultCode();
		if ($code === \Memcached::RES_SUCCESS) {
			return;
		}
		$message = self::$cache->getResultMessage();
		throw new \Exception("Error $code interacting with memcached : $message");
	}
}
