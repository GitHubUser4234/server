<?php
/**
 * @author Bernhard Posselt <dev@bernhard-posselt.com>
 * @author Joas Schilling <nickvergessen@owncloud.com>
 * @author Jörn Friedrich Dreyer <jfd@butonic.de>
 * @author Morris Jobke <hey@morrisjobke.de>
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

/**
 * Public interface of ownCloud for apps to use.
 * Files/Node interface
 */

// use OCP namespace for all classes that are considered public.
// This means that they should be used by apps instead of the internal ownCloud classes
namespace OCP\Files;

/**
 * Interface Node
 *
 * @package OCP\Files
 * @since 6.0.0 - extends FileInfo was added in 8.0.0
 */
interface Node extends FileInfo {
	/**
	 * Move the file or folder to a new location
	 *
	 * @param string $targetPath the absolute target path
	 * @throws \OCP\Files\NotPermittedException
	 * @return \OCP\Files\Node
	 * @since 6.0.0
	 */
	public function move($targetPath);

	/**
	 * Delete the file or folder
	 * @return void
	 * @since 6.0.0
	 */
	public function delete();

	/**
	 * Cope the file or folder to a new location
	 *
	 * @param string $targetPath the absolute target path
	 * @return \OCP\Files\Node
	 * @since 6.0.0
	 */
	public function copy($targetPath);

	/**
	 * Change the modified date of the file or folder
	 * If $mtime is omitted the current time will be used
	 *
	 * @param int $mtime (optional) modified date as unix timestamp
	 * @throws \OCP\Files\NotPermittedException
	 * @return void
	 * @since 6.0.0
	 */
	public function touch($mtime = null);

	/**
	 * Get the storage backend the file or folder is stored on
	 *
	 * @return \OCP\Files\Storage
	 * @throws \OCP\Files\NotFoundException
	 * @since 6.0.0
	 */
	public function getStorage();

	/**
	 * Get the full path of the file or folder
	 *
	 * @return string
	 * @since 6.0.0
	 */
	public function getPath();

	/**
	 * Get the path of the file or folder relative to the mountpoint of it's storage
	 *
	 * @return string
	 * @since 6.0.0
	 */
	public function getInternalPath();

	/**
	 * Get the internal file id for the file or folder
	 *
	 * @return int
	 * @throws InvalidPathException
	 * @throws NotFoundException
	 * @since 6.0.0
	 */
	public function getId();

	/**
	 * Get metadata of the file or folder
	 * The returned array contains the following values:
	 *  - mtime
	 *  - size
	 *
	 * @return array
	 * @since 6.0.0
	 */
	public function stat();

	/**
	 * Get the modified date of the file or folder as unix timestamp
	 *
	 * @return int
	 * @throws InvalidPathException
	 * @throws NotFoundException
	 * @since 6.0.0
	 */
	public function getMTime();

	/**
	 * Get the size of the file or folder in bytes
	 *
	 * @return int
	 * @throws InvalidPathException
	 * @throws NotFoundException
	 * @since 6.0.0
	 */
	public function getSize();

	/**
	 * Get the Etag of the file or folder
	 * The Etag is an string id used to detect changes to a file or folder,
	 * every time the file or folder is changed the Etag will change to
	 *
	 * @return string
	 * @throws InvalidPathException
	 * @throws NotFoundException
	 * @since 6.0.0
	 */
	public function getEtag();


	/**
	 * Get the permissions of the file or folder as a combination of one or more of the following constants:
	 *  - \OCP\Constants::PERMISSION_READ
	 *  - \OCP\Constants::PERMISSION_UPDATE
	 *  - \OCP\Constants::PERMISSION_CREATE
	 *  - \OCP\Constants::PERMISSION_DELETE
	 *  - \OCP\Constants::PERMISSION_SHARE
	 *
	 * @return int
	 * @throws InvalidPathException
	 * @throws NotFoundException
	 * @since 6.0.0 - namespace of constants has changed in 8.0.0
	 */
	public function getPermissions();

	/**
	 * Check if the file or folder is readable
	 *
	 * @return bool
	 * @throws InvalidPathException
	 * @throws NotFoundException
	 * @since 6.0.0
	 */
	public function isReadable();

	/**
	 * Check if the file or folder is writable
	 *
	 * @return bool
	 * @throws InvalidPathException
	 * @throws NotFoundException
	 * @since 6.0.0
	 */
	public function isUpdateable();

	/**
	 * Check if the file or folder is deletable
	 *
	 * @return bool
	 * @throws InvalidPathException
	 * @throws NotFoundException
	 * @since 6.0.0
	 */
	public function isDeletable();

	/**
	 * Check if the file or folder is shareable
	 *
	 * @return bool
	 * @throws InvalidPathException
	 * @throws NotFoundException
	 * @since 6.0.0
	 */
	public function isShareable();

	/**
	 * Get the parent folder of the file or folder
	 *
	 * @return Folder
	 * @since 6.0.0
	 */
	public function getParent();

	/**
	 * Get the filename of the file or folder
	 *
	 * @return string
	 * @since 6.0.0
	 */
	public function getName();

	/**
	 * Get the file owner
	 *
	 * @since 9.0.0
	 * @return string
	 */
	public function getOwner();
}
