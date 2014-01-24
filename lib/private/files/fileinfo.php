<?php
/**
 * Copyright (c) 2014 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OC\Files;

class FileInfo implements \OCP\Files\FileInfo, \ArrayAccess, \JsonSerializable {
	/**
	 * @var array $data
	 */
	private $data;

	/**
	 * @var string $path
	 */
	private $path;

	/**
	 * @var \OC\Files\Storage\Storage $storage
	 */
	private $storage;

	/**
	 * @var string $internalPath
	 */
	private $internalPath;

	public function __construct($path, $storage, $internalPath, $data) {
		$this->path = $path;
		$this->storage = $storage;
		$this->internalPath = $internalPath;
		$this->data = $data;
	}

	public function offsetSet($offset, $value) {
		$this->data[$offset] = $value;
	}

	public function offsetExists($offset) {
		return isset($this->data[$offset]);
	}

	public function offsetUnset($offset) {
		unset($this->data[$offset]);
	}

	public function offsetGet($offset) {
		return $this->data[$offset];
	}

	public function jsonSerialize() {
		return $this->data;
	}

	/**
	 * @return string
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * @return \OCP\Files\Storage
	 */
	public function getStorage() {
		return $this->storage;
	}

	/**
	 * @return string
	 */
	public function getInternalPath() {
		return $this->internalPath;
	}

	/**
	 * @return int
	 */
	public function getId() {
		return $this->data['fileid'];
	}

	/**
	 * @return string
	 */
	public function getMimetype() {
		return $this->data['mimetype'];
	}

	/**
	 * @return string
	 */
	public function getMimePart() {
		return $this->data['mimepart'];
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->data['name'];
	}

	/**
	 * @return string
	 */
	public function getEtag() {
		return $this->data['etag'];
	}

	/**
	 * @return int
	 */
	public function getSize() {
		return $this->data['size'];
	}

	/**
	 * @return int
	 */
	public function getMTime() {
		return $this->data['mtime'];
	}

	/**
	 * @return bool
	 */
	public function isEncrypted() {
		return $this->data['encrypted'];
	}

	/**
	 * @return int
	 */
	public function getPermissions() {
		return $this->data['permissions'];
	}

	/**
	 * @return \OCP\Files\FileInfo::TYPE_FILE | \OCP\Files\FileInfo::TYPE_FOLDER
	 */
	public function getType() {
		return $this->data['type'];
	}

	public function getData(){
		return $this->data;
	}

	/**
	 * @param int $permissions
	 * @return bool
	 */
	protected function checkPermissions($permissions) {
		return ($this->getPermissions() & $permissions) === $permissions;
	}

	/**
	 * @return bool
	 */
	public function isReadable() {
		return $this->checkPermissions(\OCP\PERMISSION_READ);
	}

	/**
	 * @return bool
	 */
	public function isUpdateable() {
		return $this->checkPermissions(\OCP\PERMISSION_UPDATE);
	}

	/**
	 * @return bool
	 */
	public function isDeletable() {
		return $this->checkPermissions(\OCP\PERMISSION_DELETE);
	}

	/**
	 * @return bool
	 */
	public function isShareable() {
		return $this->checkPermissions(\OCP\PERMISSION_SHARE);
	}
}
