<?php
/**
 * Copyright (c) 2013 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OCP\Files\Node;

use OC\Files\Cache\Cache;
use OC\Files\Cache\Scanner;
use OC\Files\NotFoundException;
use OC\Files\NotPermittedException;

interface Folder extends Node {
	/**
	 * @param string $path path relative to the folder
	 * @return string
	 * @throws \OC\Files\NotPermittedException
	 */
	public function getFullPath($path);

	/**
	 * @param string $path
	 * @throws \OC\Files\NotFoundException
	 * @return string
	 */
	public function getRelativePath($path);

	/**
	 * check if a node is a (grand-)child of the folder
	 *
	 * @param \OC\Files\Node\Node $node
	 * @return bool
	 */
	public function isSubNode($node);

	/**
	 * get the content of this directory
	 *
	 * @throws \OC\Files\NotFoundException
	 * @return Node[]
	 */
	public function getDirectoryListing();

	/**
	 * Get the node at $path
	 *
	 * @param string $path
	 * @return \OC\Files\Node\Node
	 * @throws \OC\Files\NotFoundException
	 */
	public function get($path);

	/**
	 * @param string $path
	 * @return bool
	 */
	public function nodeExists($path);

	/**
	 * @param string $path
	 * @return Folder
	 * @throws NotPermittedException
	 */
	public function newFolder($path);

	/**
	 * @param string $path
	 * @return File
	 * @throws NotPermittedException
	 */
	public function newFile($path);

	/**
	 * search for files with the name matching $query
	 *
	 * @param string $query
	 * @return Node[]
	 */
	public function search($query);

	/**
	 * search for files by mimetype
	 *
	 * @param string $mimetype
	 * @return Node[]
	 */
	public function searchByMime($mimetype);

	/**
	 * @param $id
	 * @return Node[]
	 */
	public function getById($id);

	public function getFreeSpace();

	/**
	 * @return bool
	 */
	public function isCreatable();
}
