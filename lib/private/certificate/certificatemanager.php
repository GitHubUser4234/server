<?php
/**
 * Copyright (c) 2014 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OC\Certificate;

use OC\Files\Filesystem;
use OCP\ICertificateManager;

/**
 * Manage trusted certificates for users
 */
class CertificateManager implements ICertificateManager {
	/**
	 * @var \OCP\IUser
	 */
	protected $user;

	/**
	 * @param \OCP\IUser $user
	 */
	public function __construct($user) {
		$this->user = $user;
	}

	/**
	 * Returns all certificates trusted by the user
	 *
	 * @return \OCP\ICertificate[]
	 */
	public function listCertificates() {
		$path = $this->user->getHome() . '/files_external/uploads/';
		if (!is_dir($path)) {
			return array();
		}
		$result = array();
		$handle = opendir($path);
		if (!is_resource($handle)) {
			return array();
		}
		while (false !== ($file = readdir($handle))) {
			if ($file != '.' && $file != '..') {
				$result[] = new Certificate(file_get_contents($path . $file), $file);
			}
		}
		return $result;
	}

	/**
	 * create the certificate bundle of all trusted certificated
	 */
	protected function createCertificateBundle() {
		$path = $this->user->getHome() . '/files_external/';
		$certs = $this->listCertificates();

		$fh_certs = fopen($path . '/rootcerts.crt', 'w');
		foreach ($certs as $cert) {
			$file = $path . '/uploads/' . $cert;
			$data = file_get_contents($file);
			if (strpos($data, 'BEGIN CERTIFICATE')) {
				fwrite($fh_certs, $data);
				fwrite($fh_certs, "\r\n");
			}
		}

		fclose($fh_certs);
	}

	/**
	 * Save the certificate and re-generate the certificate bundle
	 *
	 * @param string $certificate the certificate data
	 * @param string $name the filename for the certificate
	 * @return bool | \OCP\ICertificate
	 */
	public function addCertificate($certificate, $name) {
		if (!\OC\Files\Filesystem::isValidPath($name)) {
			return false;
		}
		$isValid = openssl_pkey_get_public($certificate);

		if (!$isValid) {
			$data = chunk_split(base64_encode($certificate), 64, "\n");
			$data = "-----BEGIN CERTIFICATE-----\n" . $data . "-----END CERTIFICATE-----\n";
			$isValid = openssl_pkey_get_public($data);
		}

		if ($isValid) {
			$dir = $this->user->getHome() . '/files_external/uploads/';
			if (!file_exists($dir)) {
				//path might not exist (e.g. non-standard OC_User::getHome() value)
				//in this case create full path using 3rd (recursive=true) parameter.
				//note that we use "normal" php filesystem functions here since the certs need to be local
				mkdir($dir, 0700, true);
			}
			$file = $dir . $name;
			file_put_contents($file, $certificate);
			$this->createCertificateBundle();
			return new Certificate($certificate, $name);
		} else {
			return false;
		}
	}

	/**
	 * Remove the certificate and re-generate the certificate bundle
	 *
	 * @param string $name
	 * @return bool
	 */
	public function removeCertificate($name) {
		if (!Filesystem::isValidPath($name)) {
			return false;
		}
		$path = $this->user->getHome() . '/files_external/uploads/';
		if (file_exists($path . $name)) {
			unlink($path . $name);
			$this->createCertificateBundle();
		}
		return true;
	}

	/**
	 * Get the path to the certificate bundle for this user
	 *
	 * @return string
	 */
	public function getCertificateBundle() {
		return $this->user->getHome() . '/files_external/rootcerts.crt';
	}
}
