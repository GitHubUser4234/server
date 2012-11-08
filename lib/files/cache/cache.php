<?php
/**
 * Copyright (c) 2012 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OC\Files\Cache;

/**
 * Metadata cache for the filesystem
 *
 * don't use this class directly if you need to get metadata, use \OC\Files\Filesystem::getFileInfo instead
 */
class Cache {
	const NOT_FOUND = 0;
	const PARTIAL = 1; //only partial data available, file not cached in the database
	const SHALLOW = 2; //folder in cache, but not all child files are completely scanned
	const COMPLETE = 3;

	/**
	 * @var array partial data for the cache
	 */
	private $partial = array();

	/**
	 * @var string
	 */
	private $storageId;

	/**
	 * @param \OC\Files\Storage\Storage|string $storage
	 */
	public function __construct($storage) {
		if($storage instanceof \OC\Files\Storage\Storage){
			$this->storageId = $storage->getId();
		}else{
			$this->storageId = $storage;
		}
	}

	/**
	 * get the stored metadata of a file or folder
	 *
	 * @param string/int $file
	 * @return array
	 */
	public function get($file) {
		if (is_string($file)) {
			$where = 'WHERE `storage` = ? AND `path_hash` = ?';
			$params = array($this->storageId, md5($file));
		} else { //file id
			$where = 'WHERE `fileid` = ?';
			$params = array($file);
		}
		$query = \OC_DB::prepare(
			'SELECT `fileid`, `storage`, `path`, `parent`, `name`, `mimetype`, `mimepart`, `size`, `mtime`, `encrypted`
			 FROM `*PREFIX*filecache` ' . $where);
		$result = $query->execute($params);
		$data = $result->fetchRow();

		//merge partial data
		if (!$data and  is_string($file)) {
			if (isset($this->partial[$file])) {
				$data = $this->partial[$file];
			}
		} else {
			//fix types
			$data['fileid'] = (int)$data['fileid'];
			$data['size'] = (int)$data['size'];
			$data['mtime'] = (int)$data['mtime'];
			$data['encrypted'] = (bool)$data['encrypted'];
		}

		return $data;
	}

	/**
	 * get the metadata of all files stored in $folder
	 *
	 * @param string $folder
	 * @return array
	 */
	public function getFolderContents($folder) {
		$fileId = $this->getId($folder);
		if ($fileId > -1) {
			$query = \OC_DB::prepare(
				'SELECT `fileid`, `storage`, `path`, `parent`, `name`, `mimetype`, `mimepart`, `size`, `mtime`, `encrypted`
			 	 FROM `*PREFIX*filecache` WHERE parent = ?');
			$result = $query->execute(array($fileId));
			return $result->fetchAll();
		} else {
			return array();
		}
	}

	/**
	 * store meta data for a file or folder
	 *
	 * @param string $file
	 * @param array $data
	 *
	 * @return int file id
	 */
	public function put($file, array $data) {
		if (($id = $this->getId($file)) > -1) {
			$this->update($id, $data);
			return $id;
		} else {
			if (isset($this->partial[$file])) { //add any saved partial data
				$data = array_merge($this->partial[$file], $data);
				unset($this->partial[$file]);
			}

			$requiredFields = array('size', 'mtime', 'mimetype');
			foreach ($requiredFields as $field) {
				if (!isset($data[$field])) { //data not complete save as partial and return
					$this->partial[$file] = $data;
					return -1;
				}
			}

			$data['path'] = $file;
			$data['parent'] = $this->getParentId($file);
			$data['name'] = basename($file);
			$data['encrypted'] = isset($data['encrypted']) ? ((int)$data['encrypted']) : 0;

			list($queryParts, $params) = $this->buildParts($data);
			$queryParts[] = '`storage`';
			$params[] = $this->storageId;
			$valuesPlaceholder = array_fill(0, count($queryParts), '?');

			$query = \OC_DB::prepare('INSERT INTO `*PREFIX*filecache`(' . implode(', ', $queryParts) . ') VALUES(' . implode(', ', $valuesPlaceholder) . ')');
			$query->execute($params);

			return (int)\OC_DB::insertid('*PREFIX*filecache');
		}
	}

	/**
	 * update the metadata in the cache
	 *
	 * @param int $id
	 * @param array $data
	 */
	public function update($id, array $data) {
		list($queryParts, $params) = $this->buildParts($data);
		$params[] = $id;

		$query = \OC_DB::prepare('UPDATE `*PREFIX*filecache` SET ' . implode(' = ?, ', $queryParts) . '=? WHERE fileid = ?');
		$query->execute($params);
	}

	/**
	 * extract query parts and params array from data array
	 *
	 * @param array $data
	 * @return array
	 */
	static function buildParts(array $data) {
		$fields = array('path', 'parent', 'name', 'mimetype', 'size', 'mtime', 'encrypted');

		$params = array();
		$queryParts = array();
		foreach ($data as $name => $value) {
			if (array_search($name, $fields) !== false) {
				$params[] = $value;
				$queryParts[] = '`' . $name . '`';
				if ($name === 'path') {
					$params[] = md5($value);
					$queryParts[] = '`path_hash`';
				} elseif ($name === 'mimetype') {
					$params[] = substr($value, 0, strpos($value, '/'));
					$queryParts[] = '`mimepart`';
				}
			}
		}
		return array($queryParts, $params);
	}

	/**
	 * get the file id for a file
	 *
	 * @param string $file
	 * @return int
	 */
	public function getId($file) {
		$pathHash = md5($file);

		$query = \OC_DB::prepare('SELECT `fileid` FROM `*PREFIX*filecache` WHERE `storage` = ? AND `path_hash` = ?');
		$result = $query->execute(array($this->storageId, $pathHash));

		if ($row = $result->fetchRow()) {
			return $row['fileid'];
		} else {
			return -1;
		}
	}

	/**
	 * get the id of the parent folder of a file
	 *
	 * @param string $file
	 * @return int
	 */
	public function getParentId($file) {
		if ($file === '') {
			return -1;
		} else {
			$parent = dirname($file);
			if ($parent === '.') {
				$parent = '';
			}
			return $this->getId($parent);
		}
	}

	/**
	 * check if a file is available in the cache
	 *
	 * @param string $file
	 * @return bool
	 */
	public function inCache($file) {
		return $this->getId($file) != -1;
	}

	/**
	 * remove a file or folder from the cache
	 *
	 * @param string $file
	 */
	public function remove($file) {
		$entry = $this->get($file);
		if ($entry['mimetype'] === 'httpd/unix-directory') {
			$children = $this->getFolderContents($file);
			foreach ($children as $child) {
				$this->remove($child['path']);
			}
		}
		$query = \OC_DB::prepare('DELETE FROM `*PREFIX*filecache` WHERE `fileid` = ?');
		$query->execute(array($entry['fileid']));
	}

	/**
	 * Move a file or folder in the cache
	 *
	 * @param string $source
	 * @param string $target
	 */
	public function move($source, $target) {
		$sourceId = $this->getId($source);
		$newParentId = $this->getParentId($target);

		//find all child entries
		$query = \OC_DB::prepare('SELECT `path`, `fileid` FROM `*PREFIX*filecache` WHERE `path` LIKE ?');
		$result = $query->execute(array($source . '/%'));
		$childEntries = $result->fetchAll();
		$sourceLength = strlen($source);
		$query = \OC_DB::prepare('UPDATE `*PREFIX*filecache` SET `path` = ?, `path_hash` = ? WHERE `fileid` = ?');

		foreach ($childEntries as $child) {
			$targetPath = $target . substr($child['path'], $sourceLength);
			$query->execute(array($targetPath, md5($targetPath), $child['fileid']));
		}

		$query = \OC_DB::prepare('UPDATE `*PREFIX*filecache` SET `path` = ?, `path_hash` = ?, `parent` =? WHERE `fileid` = ?');
		$query->execute(array($target, md5($target), $newParentId, $sourceId));
	}

	/**
	 * remove all entries for files that are stored on the storage from the cache
	 */
	public function clear() {
		$query = \OC_DB::prepare('DELETE FROM `*PREFIX*filecache` WHERE storage=?');
		$query->execute(array($this->storageId));
	}

	/**
	 * @param string $file
	 *
	 * @return int, Cache::NOT_FOUND, Cache::PARTIAL, Cache::SHALLOW or Cache::COMPLETE
	 */
	public function getStatus($file) {
		$pathHash = md5($file);
		$query = \OC_DB::prepare('SELECT `size` FROM `*PREFIX*filecache` WHERE `storage` = ? AND `path_hash` = ?');
		$result = $query->execute(array($this->storageId, $pathHash));
		if ($row = $result->fetchRow()) {
			if ((int)$row['size'] === -1) {
				return self::SHALLOW;
			} else {
				return self::COMPLETE;
			}
		} else {
			if (isset($this->partial[$file])) {
				return self::PARTIAL;
			} else {
				return self::NOT_FOUND;
			}
		}
	}

	/**
	 * search for files matching $pattern
	 *
	 * @param string $pattern
	 * @return array of file data
	 */
	public function search($pattern) {
		$query = \OC_DB::prepare('
			SELECT `fileid`, `storage`, `path`, `parent`, `name`, `mimetype`, `mimepart`, `size`, `mtime`, `encrypted`
			FROM `*PREFIX*filecache` WHERE `name` LIKE ? AND `storage` = ?'
		);
		$result = $query->execute(array($pattern, $this->storageId));
		$files = array();
		while ($row = $result->fetchRow()) {
			$files[] = $row;
		}
		return $files;
	}

	/**
	 * search for files by mimetype
	 *
	 * @param string $mimetype
	 * @return array
	 */
	public function searchByMime($mimetype) {
		if (strpos($mimetype, '/')) {
			$where = '`mimetype` = ?';
		} else {
			$where = '`mimepart` = ?';
		}
		$query = \OC_DB::prepare('
			SELECT `fileid`, `storage`, `path`, `parent`, `name`, `mimetype`, `mimepart`, `size`, `mtime`, `encrypted`
			FROM `*PREFIX*filecache` WHERE ' . $where . ' AND `storage` = ?'
		);
		$result = $query->execute(array($mimetype, $this->storageId));
		return $result->fetchAll();
	}

	/**
	 * update the folder size and the size of all parent folders
	 *
	 * @param $path
	 */
	public function correctFolderSize($path) {
		$this->calculateFolderSize($path);
		if ($path !== '') {
			$parent = dirname($path);
			if ($parent === '.') {
				$parent = '';
			}
			$this->correctFolderSize($parent);
		}
	}

	/**
	 * get the size of a folder and set it in the cache
	 *
	 * @param string $path
	 * @return int
	 */
	public function calculateFolderSize($path) {
		$id = $this->getId($path);
		if($id === -1){
			return 0;
		}
		$query = \OC_DB::prepare('SELECT `size` FROM `*PREFIX*filecache` WHERE `parent` = ? AND `storage` = ?');
		$result = $query->execute(array($id, $this->storageId));
		$totalSize = 0;
		$hasChilds = 0;
		while ($row = $result->fetchRow()) {
			$hasChilds = true;
			$size = (int)$row['size'];
			if ($size === -1) {
				$totalSize = -1;
				break;
			} else {
				$totalSize += $size;
			}
		}

		if ($hasChilds) {
			$this->update($id, array('size' => $totalSize));
		}
		return $totalSize;
	}

	/**
	 * get all file ids on the files on the storage
	 *
	 * @return int[]
	 */
	public function getAll() {
		$query = \OC_DB::prepare('SELECT `fileid` FROM `*PREFIX*filecache` WHERE `storage` = ?');
		$result = $query->execute(array($this->storageId));
		$ids = array();
		while ($row = $result->fetchRow()) {
			$ids[] = $row['fileid'];
		}
		return $ids;
	}
}
