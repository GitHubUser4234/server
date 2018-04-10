<?php
/**
 *
 * @copyright Copyright (c) 2016, Roger Szabo (roger.szabo@web.de)
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */


namespace OC\Security;

use phpseclib\Crypt\AES;

/**
 * Crypto util class using AES-CBC for operation
 *
 * @package OC\Security
 */
class CryptoUtil {
	/** @var AES $cipher */
	private $cipher;
	/** @var string */
	private $cipherSec = "49ed73673bc33720283354cbdec7e4db";

	/**
	 */
	function __construct() {
		$this->cipher = new AES();
	}

	/**
	 * Decrypts a value
	 * @param string $encryptedDBPassword
	 * @return string plaintext
	 * @throws \Exception If the DB password could not be decoded
	 */
	public function decryptDBPassword($encryptedDBPassword) {
		$this->cipher->setPassword($this->cipherSec);

		$parts = explode('|', $encryptedDBPassword);
		if(sizeof($parts) !== 2) {
			throw new \Exception('Encrypted DB password could not be decoded.');
		}

		$ciphertext = hex2bin($parts[0]);
		$iv = $parts[1];

		$this->cipher->setIV($iv);

		return $this->cipher->decrypt($ciphertext);
	}

}
