<?php
/**
 * @author Björn Schießle <schiessle@owncloud.com>
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

namespace OCP\Encryption;

use OC\Encryption\Exceptions\ModuleDoesNotExistsException;
use OC\Encryption\Exceptions\ModuleAlreadyExistsException;

/**
 * This class provides access to files encryption apps.
 *
 * @since 8.1.0
 */
interface IManager {

	/**
	 * Check if encryption is available (at least one encryption module needs to be enabled)
	 *
	 * @return bool true if enabled, false if not
	 * @since 8.1.0
	 */
	function isEnabled();

	/**
	 * Registers an callback function which must return an encryption module instance
	 *
	 * @param string $id
	 * @param string $displayName
	 * @param callable $callback
	 * @throws ModuleAlreadyExistsException
	 * @since 8.1.0
	 */
	function registerEncryptionModule($id, $displayName, callable $callback);

	/**
	 * Unregisters an encryption module
	 *
	 * @param string $moduleId
	 * @since 8.1.0
	 */
	function unregisterEncryptionModule($moduleId);

	/**
	 * get a list of all encryption modules
	 *
	 * @return array [id => ['id' => $id, 'displayName' => $displayName, 'callback' => callback]]
	 * @since 8.1.0
	 */
	function getEncryptionModules();


	/**
	 * get a specific encryption module
	 *
	 * @param string $moduleId
	 * @return IEncryptionModule
	 * @throws ModuleDoesNotExistsException
	 * @since 8.1.0
	 */
	function getEncryptionModule($moduleId);

	/**
	 * get default encryption module Id
	 *
	 * @return string
	 * @since 8.1.0
	 */
	public function getDefaultEncryptionModuleId();

	/**
	 * set default encryption module Id
	 *
	 * @param string $moduleId
	 * @return string
	 * @since 8.1.0
	 */
	public function setDefaultEncryptionModule($moduleId);

}
