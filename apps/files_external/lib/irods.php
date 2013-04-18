<?php
/**
 * Copyright (c) 2013 Thomas Müller <thomas.mueller@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OC\Files\Storage;

set_include_path(get_include_path() . PATH_SEPARATOR .
	\OC_App::getAppPath('files_external') . '/3rdparty/irodsphp/prods/src');

require_once 'ProdsStreamer.class.php';

class iRODS extends \OC\Files\Storage\StreamWrapper{
	private $password;
	private $user;
	private $host;
	private $port;
	private $zone;
	private $root;
	private $use_logon_credentials;

	public function __construct($params) {
		if (isset($params['host']) && isset($params['user']) && isset($params['password'])) {
			$this->host=$params['host'];
			$this->port=$params['port'];
			$this->user=$params['user'];
			$this->password=$params['password'];
			$this->use_logon_credentials=$params['use_logon_credentials'];
			$this->zone=$params['zone'];

			$this->root=isset($params['root'])?$params['root']:'/';
			if ( ! $this->root || $this->root[0]!='/') {
				$this->root='/'.$this->root;
			}

			if ($this->use_logon_credentials && isset($_SESSION['irods-credentials']) )
			{
				$this->user = $_SESSION['irods-credentials']['uid'];
				$this->password = $_SESSION['irods-credentials']['password'];
			}

			//create the root folder if necessary
			if ( ! $this->is_dir('')) {
				$this->mkdir('');
			}
		} else {
			throw new \Exception();
		}
		
	}

	public static function login( $params ) {
		$_SESSION['irods-credentials'] = $params;
	}

	public function getId(){
		return 'irods::' . $this->user . '@' . $this->host . '/' . $this->root;
	}

	/**
	 * construct the ftp url
	 * @param string $path
	 * @return string
	 */
	public function constructUrl($path) {
		$userWithZone = $this->user.'.'.$this->zone;
		return 'rods://'.$userWithZone.':'.$this->password.'@'.$this->host.':'.$this->port.$this->root.$path;
	}
}
