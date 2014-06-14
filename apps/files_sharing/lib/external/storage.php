<?php
/**
 * Copyright (c) 2014 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OCA\Files_Sharing\External;

use OC\Files\Filesystem;
use OC\Files\Storage\DAV;
use OCA\Files_Sharing\ISharedStorage;

class Storage extends DAV implements ISharedStorage {
	/**
	 * @var string
	 */
	private $remoteUser;

	/**
	 * @var string
	 */
	private $remote;

	/**
	 * @var string
	 */
	private $mountPoint;

	/**
	 * @var string
	 */
	private $token;

	/**
	 * @var \OCA\Files_Sharing\External\Manager
	 */
	private $manager;

	public function __construct($options) {
		$this->remote = $options['remote'];
		$this->remoteUser = $options['owner'];
		$this->manager = $options['manager'];
		list($protocol, $remote) = explode('://', $this->remote);
		list($host, $root) = explode('/', $remote);
		$secure = $protocol === 'https';
		$root .= '/public.php/webdav';
		$this->mountPoint = $options['mountpoint'];
		$this->token = $options['token'];
		parent::__construct(array(
			'secure' => $secure,
			'host' => $host,
			'root' => $root,
			'user' => $options['token'],
			'password' => $options['password']
		));
	}

	public function getRemoteUser() {
		return $this->remoteUser;
	}

	public function getRemote() {
		return $this->remote;
	}

	public function getMountPoint() {
		return $this->mountPoint;
	}

	public function getToken() {
		return $this->token;
	}

	public function getPassword() {
		return $this->password;
	}

	/**
	 * @brief get id of the mount point
	 * @return string
	 */
	public function getId() {
		return 'shared::' . md5($this->token . '@' . $this->remote);
	}

	public function getCache($path = '') {
		if (!isset($this->cache)) {
			$this->cache = new Cache($this, $this->remote, $this->remoteUser);
		}
		return $this->cache;
	}

	/**
	 * @param string $path
	 * @return \OCA\Files_Sharing\External\Scanner
	 */
	public function getScanner($path = '') {
		if (!isset($this->scanner)) {
			$this->scanner = new Scanner($this);
		}
		return $this->scanner;
	}
}
