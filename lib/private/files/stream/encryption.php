<?php
/**
 * @author Björn Schießle <schiessle@owncloud.com>
 * @author jknockaert <jasper@knockaert.nl>
 * @author Thomas Müller <thomas.mueller@tmit.eu>
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

namespace OC\Files\Stream;

use Icewind\Streams\Wrapper;
use OC\Encryption\Exceptions\EncryptionHeaderKeyExistsException;

class Encryption extends Wrapper {

	/** @var \OC\Encryption\Util */
	protected $util;

	/** @var \OC\Encryption\File */
	protected $file;

	/** @var \OCP\Encryption\IEncryptionModule */
	protected $encryptionModule;

	/** @var \OC\Files\Storage\Storage */
	protected $storage;

	/** @var \OC\Files\Storage\Wrapper\Encryption */
	protected $encryptionStorage;

	/** @var string */
	protected $internalPath;

	/** @var string */
	protected $cache;

	/** @var integer */
	protected $size;

	/** @var integer */
	protected $position;

	/** @var integer */
	protected $unencryptedSize;

	/** @var integer */
	protected $unencryptedBlockSize;

	/** @var array */
	protected $header;

	/** @var string */
	protected $fullPath;

	/**
	 * header data returned by the encryption module, will be written to the file
	 * in case of a write operation
	 *
	 * @var array
	 */
	protected $newHeader;

	/**
	 * user who perform the read/write operation null for public access
	 *
	 * @var string
	 */
	protected $uid;

	/** @var bool */
	protected $readOnly;

	/** @var bool */
	protected $writeFlag;

	/** @var array */
	protected $expectedContextProperties;

	public function __construct() {
		$this->expectedContextProperties = array(
			'source',
			'storage',
			'internalPath',
			'fullPath',
			'encryptionModule',
			'header',
			'uid',
			'file',
			'util',
			'size',
			'unencryptedSize',
			'encryptionStorage'
		);
	}


	/**
	 * Wraps a stream with the provided callbacks
	 *
	 * @param resource $source
	 * @param string $internalPath relative to mount point
	 * @param string $fullPath relative to data/
	 * @param array $header
	 * @param string $uid
	 * @param \OCP\Encryption\IEncryptionModule $encryptionModule
	 * @param \OC\Files\Storage\Storage $storage
	 * @param \OC\Files\Storage\Wrapper\Encryption $encStorage
	 * @param \OC\Encryption\Util $util
	 * @param \OC\Encryption\File $file
	 * @param string $mode
	 * @param int $size
	 * @param int $unencryptedSize
	 * @return resource
	 *
	 * @throws \BadMethodCallException
	 */
	public static function wrap($source, $internalPath, $fullPath, array $header,
								$uid,
								\OCP\Encryption\IEncryptionModule $encryptionModule,
								\OC\Files\Storage\Storage $storage,
								\OC\Files\Storage\Wrapper\Encryption $encStorage,
								\OC\Encryption\Util $util,
								 \OC\Encryption\File $file,
								$mode,
								$size,
								$unencryptedSize) {

		$context = stream_context_create(array(
			'ocencryption' => array(
				'source' => $source,
				'storage' => $storage,
				'internalPath' => $internalPath,
				'fullPath' => $fullPath,
				'encryptionModule' => $encryptionModule,
				'header' => $header,
				'uid' => $uid,
				'util' => $util,
				'file' => $file,
				'size' => $size,
				'unencryptedSize' => $unencryptedSize,
				'encryptionStorage' => $encStorage
			)
		));

		return self::wrapSource($source, $mode, $context, 'ocencryption', 'OC\Files\Stream\Encryption');
	}

	/**
	 * add stream wrapper
	 *
	 * @param resource $source
	 * @param string $mode
	 * @param array $context
	 * @param string $protocol
	 * @param string $class
	 * @return resource
	 * @throws \BadMethodCallException
	 */
	protected static function wrapSource($source, $mode, $context, $protocol, $class) {
		try {
			stream_wrapper_register($protocol, $class);
			if (@rewinddir($source) === false) {
				$wrapped = fopen($protocol . '://', $mode, false, $context);
			} else {
				$wrapped = opendir($protocol . '://', $context);
			}
		} catch (\BadMethodCallException $e) {
			stream_wrapper_unregister($protocol);
			throw $e;
		}
		stream_wrapper_unregister($protocol);
		return $wrapped;
	}

	/**
	 * Load the source from the stream context and return the context options
	 *
	 * @param string $name
	 * @return array
	 * @throws \BadMethodCallException
	 */
	protected function loadContext($name) {
		$context = parent::loadContext($name);

		foreach ($this->expectedContextProperties as $property) {
			if (array_key_exists($property, $context)) {
				$this->{$property} = $context[$property];
			} else {
				throw new \BadMethodCallException('Invalid context, "' . $property . '" options not set');
			}
		}
		return $context;

	}

	public function stream_open($path, $mode, $options, &$opened_path) {
		$this->loadContext('ocencryption');

		$this->position = 0;
		$this->cache = '';
		$this->writeFlag = false;
		$this->unencryptedBlockSize = $this->encryptionModule->getUnencryptedBlockSize();

		if (
			$mode === 'w'
			|| $mode === 'w+'
			|| $mode === 'wb'
			|| $mode === 'wb+'
		) {
			// We're writing a new file so start write counter with 0 bytes
			$this->unencryptedSize = 0;
			$this->size = 0;
			$this->readOnly = false;
		} else {
			$this->readOnly = true;
		}

		$sharePath = $this->fullPath;
		if (!$this->storage->file_exists($this->internalPath)) {
			$sharePath = dirname($path);
		}

		$accessList = $this->file->getAccessList($sharePath);
		$this->newHeader = $this->encryptionModule->begin($this->fullPath, $this->uid, $this->header, $accessList);

		return true;

	}

	public function stream_read($count) {

		$result = '';

		// skip the header if we read the file from the beginning
		if ($this->position === 0) {
			parent::stream_read($this->util->getHeaderSize());
		}

//		$count = min($count, $this->unencryptedSize - $this->position);
		while ($count > 0) {
			$remainingLength = $count;
			// update the cache of the current block
			$this->readCache();
			// determine the relative position in the current block
			$blockPosition = ($this->position % $this->unencryptedBlockSize);
			// if entire read inside current block then only position needs to be updated
			if ($remainingLength < ($this->unencryptedBlockSize - $blockPosition)) {
				$result .= substr($this->cache, $blockPosition, $remainingLength);
				$this->position += $remainingLength;
				$count = 0;
				// otherwise remainder of current block is fetched, the block is flushed and the position updated
			} else {
				$result .= substr($this->cache, $blockPosition);
				$this->flush();
				$this->position += ($this->unencryptedBlockSize - $blockPosition);
				$count -= ($this->unencryptedBlockSize - $blockPosition);
			}
		}
		return $result;

	}

	public function stream_write($data) {

		if ($this->position === 0) {
			$this->writeHeader();
			$this->size = $this->util->getHeaderSize();
		}

		$length = 0;
		// loop over $data to fit it in 6126 sized unencrypted blocks
		while (strlen($data) > 0) {
			$remainingLength = strlen($data);

			// set the cache to the current 6126 block
			$this->readCache();

			// for seekable streams the pointer is moved back to the beginning of the encrypted block
			// flush will start writing there when the position moves to another block
			$positionInFile = (int)floor($this->position / $this->unencryptedBlockSize) *
				$this->util->getBlockSize() + $this->util->getHeaderSize();
			$resultFseek = parent::stream_seek($positionInFile);

			// only allow writes on seekable streams, or at the end of the encrypted stream
			if (!($this->readOnly) && ($resultFseek || $positionInFile === $this->size)) {

				// switch the writeFlag so flush() will write the block
				$this->writeFlag = true;

				// determine the relative position in the current block
				$blockPosition = ($this->position % $this->unencryptedBlockSize);
				// check if $data fits in current block
				// if so, overwrite existing data (if any)
				// update position and liberate $data
				if ($remainingLength < ($this->unencryptedBlockSize - $blockPosition)) {
					$this->cache = substr($this->cache, 0, $blockPosition)
						. $data . substr($this->cache, $blockPosition + $remainingLength);
					$this->position += $remainingLength;
					$length += $remainingLength;
					$data = '';
					// if $data doesn't fit the current block, the fill the current block and reiterate
					// after the block is filled, it is flushed and $data is updatedxxx
				} else {
					$this->cache = substr($this->cache, 0, $blockPosition) .
						substr($data, 0, $this->unencryptedBlockSize - $blockPosition);
					$this->flush();
					$this->position += ($this->unencryptedBlockSize - $blockPosition);
					$length += ($this->unencryptedBlockSize - $blockPosition);
					$data = substr($data, $this->unencryptedBlockSize - $blockPosition);
				}
			} else {
				$data = '';
			}
		}
		$this->unencryptedSize = max($this->unencryptedSize, $this->position);
		return $length;
	}

	public function stream_tell() {
		return $this->position;
	}

	public function stream_seek($offset, $whence = SEEK_SET) {

		$return = false;

		switch ($whence) {
			case SEEK_SET:
				if ($offset < $this->unencryptedSize && $offset >= 0) {
					$newPosition = $offset;
				}
				break;
			case SEEK_CUR:
				if ($offset >= 0) {
					$newPosition = $offset + $this->position;
				}
				break;
			case SEEK_END:
				if ($this->unencryptedSize + $offset >= 0) {
					$newPosition = $this->unencryptedSize + $offset;
				}
				break;
			default:
				return $return;
		}

		$newFilePosition = floor($newPosition / $this->unencryptedBlockSize)
			* $this->util->getBlockSize() + $this->util->getHeaderSize();

		$oldFilePosition = parent::stream_tell();
		if (parent::stream_seek($newFilePosition)) {
			parent::stream_seek($oldFilePosition);
			$this->flush();
			parent::stream_seek($newFilePosition);
			$this->position = $newPosition;
			$return = true;
		}
		return $return;

	}

	public function stream_close() {
		$this->flush();
		$remainingData = $this->encryptionModule->end($this->fullPath);
		if ($this->readOnly === false) {
			if(!empty($remainingData)) {
				parent::stream_write($remainingData);
			}
			$this->encryptionStorage->updateUnencryptedSize($this->fullPath, $this->unencryptedSize);
		}
		return parent::stream_close();
	}

	/**
	 * write block to file
	 */
	protected function flush() {
		// write to disk only when writeFlag was set to 1
		if ($this->writeFlag) {
			// Disable the file proxies so that encryption is not
			// automatically attempted when the file is written to disk -
			// we are handling that separately here and we don't want to
			// get into an infinite loop
			$encrypted = $this->encryptionModule->encrypt($this->cache);
			parent::stream_write($encrypted);
			$this->writeFlag = false;
			$this->size = max($this->size, parent::stream_tell());
		}
		// always empty the cache (otherwise readCache() will not fill it with the new block)
		$this->cache = '';
	}

	/**
	 * read block to file
	 */
	protected function readCache() {
		// cache should always be empty string when this function is called
		// don't try to fill the cache when trying to write at the end of the unencrypted file when it coincides with new block
		if ($this->cache === '' && !($this->position === $this->unencryptedSize && ($this->position % $this->unencryptedBlockSize) === 0)) {
			// Get the data from the file handle
			$data = parent::stream_read($this->util->getBlockSize());
			$this->cache = $this->encryptionModule->decrypt($data);
		}
	}

	/**
	 * write header at beginning of encrypted file
	 *
	 * @return integer
	 * @throws EncryptionHeaderKeyExistsException if header key is already in use
	 */
	private function writeHeader() {
		$header = $this->util->createHeader($this->newHeader, $this->encryptionModule);
		return parent::stream_write($header);
	}

}
