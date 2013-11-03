<?php
/**
 * Copyright (c) 2013 Thomas Tanghus (thomas@tanghus.net)
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

/**
 * Public interface of ownCloud for apps to use.
 * Cache interface
 *
 */

// use OCP namespace for all classes that are considered public.
// This means that they should be used by apps instead of the internal ownCloud classes
namespace OCP;

/**
 * This interface defines method for accessing the file based user cache.
 */
interface ICache {

	/**
	 * Get a value from the user cache
	 * @param string $key
	 * @return mixed
	 */
	public function get($key);

	/**
	 * Set a value in the user cache
	 * @param string $key
	 * @param mixed $value
	 * @param int $ttl Time To Live in seconds. Defaults to 60*60*24
	 * @return bool
	 */
	public function set($key, $value, $ttl = 0);

	/**
	 * Check if a value is set in the user cache
	 * @param string $key
	 * @return bool
	 */
	public function hasKey($key);

	/**
	 * Remove an item from the user cache
	 * @param string $key
	 * @return bool
	 */
	public function remove($key);

	/**
	 * Clear the user cache of all entries starting with a prefix
	 * @param string $prefix (optional)
	 * @return bool
	 */
	public function clear($prefix = '');
}
