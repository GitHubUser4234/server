<?php

/**
 * ownCloud
 *
 * @author Michael Gapczynski
 * @author Christian Berendt
 * @copyright 2012 Michael Gapczynski mtgap@owncloud.com
 * @copyright 2013 Christian Berendt berendt@b1-systems.de
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace OC\Files\Storage;

set_include_path(get_include_path() . PATH_SEPARATOR .
        \OC_App::getAppPath('files_external') . '/3rdparty/aws-sdk-php');
require 'aws-autoloader.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

class AmazonS3 extends \OC\Files\Storage\Common {

	private $connection;
	private $bucket;
	private static $tmpFiles = array();

	private function normalizePath($path) {
		$path = trim($path, '/');

		if ( ! $path) {
			$path = '.';
		}

		return $path;
	}

	public function __construct($params) {
		if ( ! isset($params['key']) || ! isset($params['secret']) || ! isset($params['bucket'])) {
			throw new \Exception();
		}

		$this->id = 'amazon::' . $params['key'] . md5($params['secret']);
		$this->bucket = $params['bucket'];
		$scheme = ($params['use_ssl'] === 'false') ? 'http' : 'https';

		if (isset($params['hostname']) && isset($params['port'])) {
			$base_url = $scheme.'://'.$params['hostname'].':'.$params['port'].'/';
			$this->connection = S3Client::factory(array(
				'key' => $params['key'],
				'secret' => $params['secret'],
				'base_url' => $base_url
			));
		} else {
			if ( ! isset($params['region'])) {
				$params['region'] = 'us-west-1';
			}
			$this->connection = S3Client::factory(array(
				'key' => $params['key'],
				'secret' => $params['secret'],
				'scheme' => $scheme,
				'region' => $params'[region']
			));
		}

		if ( ! $this->connection->doesBucketExist($this->bucket)) {
			$result = $this->connection->createBucket(array(
				'Bucket' => $this->bucket
			));
		}

		if ( ! $this->file_exists('.')) {
			$result = $this->connection->putObject(array(
				'Bucket' => $this->bucket,
				'Key'    => '.',
				'Body'   => '',
				'ContentType' => 'httpd/unix-directory',
				'ContentLength' => 0
			));
		}
	}

	public function mkdir($path) {
		$path = $this->normalizePath($path);

		if($this->is_dir($path)) {
			return false;
		}

		try {
			$result = $this->connection->putObject(array(
				'Bucket' => $this->bucket,
				'Key'    => $path . '/',
				'Body'   => '',
				'ContentType' => 'httpd/unix-directory',
				'ContentLength' => 0
			));
		} catch (S3Exception $e) {
			return false;
		}

		return true;
	}

	public function file_exists($path) {
		$path = $this->normalizePath($path);

		if ( ! $path) {
			$path = '.';
		} else if ($path != '.' && $this->is_dir($path)) {
			$path .= '/';
		}

		try {
			$result = $this->connection->doesObjectExist(
				$this->bucket,
				$path
			);
		} catch (S3Exception $e) {
			return false;
		}

		return $result;
	}


	public function rmdir($path) {
		$path = $this->normalizePath($path);

		if ( ! $this->file_exists($path)) {
			return false;
		}

		$dh = $this->opendir($path);
		while ($file = readdir($dh)) {
			if ($file == '.' || $file == '..') {
				continue;
			}

			if ($this->is_dir($path . '/' . $file)) {
				$this->rmdir($path . '/' . $file);
			} else {
				$this->unlink($path . '/' . $file);
			}
               	}

		try {
			$result = $this->connection->deleteObject(array(
				'Bucket' => $this->bucket,
				'Key' => $path . '/'
			));
		} catch (S3Exception $e) {
			return false;
		}

		return true;
	}

	public function opendir($path) {
		$path = $this->normalizePath($path);

		if ($path == '.') {
			$path = '';
		} else if ($path) {
			$path .= '/';
		}

		try {
			$files = array();
			$result = $this->connection->getIterator('ListObjects', array(
				'Bucket' => $this->bucket,
				'Delimiter' => '/',
				'Prefix' => $path
			), array('return_prefixes' => true));

			foreach ($result as $object) {
				$file = basename(
					isset($object['Key']) ? $object['Key'] : $object['Prefix']
				);

				if ( $file != basename($path)) {
					$files[] = $file;
				}
			}

			\OC\Files\Stream\Dir::register('amazons3' . $path, $files);

			return opendir('fakedir://amazons3' . $path);
		} catch (S3Exception $e) {
			return false;
		}
	}

	public function stat($path) {
		$path = $this->normalizePath($path);

		try {
			if ($this->is_dir($path) && $path != '.') {
				$path .= '/';
			}

			$result = $this->connection->headObject(array(
				'Bucket' => $this->bucket,
				'Key' => $path
			));

			$stat = array();
			$stat['size'] = $result['ContentLength'] ? $result['ContentLength'] : 0;
			if ($result['Metadata']['lastmodified']) {
				$stat['mtime'] = strtotime($result['Metadata']['lastmodified']);
			} else {
				$stat['mtime'] = strtotime($result['LastModified']);
			}
			$stat['atime'] = time();

			return $stat;
		} catch(S3Exception $e) {
			return false;
		}
	}

	public function filetype($path) {
		$path = $this->normalizePath($path);

		try {
			if ($path != '.' && $this->connection->doesObjectExist($this->bucket, $path)) {
				return 'file';
			}

			if ($path != '.') {
				$path .= '/';
			}

			if ($this->connection->doesObjectExist($this->bucket, $path)) {
				return 'dir';
			}
		} catch (S3Exception $e) {
			return false;
		}

		return false;
	}

	public function isReadable($path) {
		return true;
	}

	public function isUpdatable($path) {
		return true;
	}

	public function unlink($path) {
		$path = $this->normalizePath($path);

		try {
			$result = $this->connection->deleteObject(array(
				'Bucket' => $this->bucket,
				'Key' => $path
			));
		} catch (S3Exception $e) {
			return false;
		}

		$this->touch(dirname($path));
		return true;
	}

	public function fopen($path, $mode) {
		$path = $this->normalizePath($path);

		switch ($mode) {
			case 'r':
			case 'rb':
				$tmpFile = \OC_Helper::tmpFile();
				self::$tmpFiles[$tmpFile] = $path;

				try {
					$result = $this->connection->getObject(array(
						'Bucket' => $this->bucket,
						'Key' => $path,
						'SaveAs' => $tmpFile
					));
				} catch (S3Exception $e) {
					return false;
				}

				return fopen($tmpFile, 'r');
			case 'w':
			case 'wb':
			case 'a':
			case 'ab':
			case 'r+':
			case 'w+':
			case 'wb+':
			case 'a+':
			case 'x':
			case 'x+':
			case 'c':
			case 'c+':
				if (strrpos($path, '.') !== false) {
					$ext = substr($path, strrpos($path, '.'));
				} else {
					$ext = '';
				}
				$tmpFile = \OC_Helper::tmpFile($ext);
				\OC\Files\Stream\Close::registerCallback($tmpFile, array($this, 'writeBack'));
				if ($this->file_exists($path)) {
					$source = $this->fopen($path, 'r');
					file_put_contents($tmpFile, $source);
				}
				self::$tmpFiles[$tmpFile] = $path;

				return fopen('close://' . $tmpFile, $mode);
		}
		return false;
	}

	public function getMimeType($path) {
		$path = $this->normalizePath($path);

		if ($this->is_dir($path)) {
			return 'httpd/unix-directory';
		} else if ($this->file_exists($path)) {
			try {
				$result = $this->connection->headObject(array(
					'Bucket' => $this->bucket,
					'Key' => $path
				));
			} catch (S3Exception $e) {
				return false;
			}

			return $result['ContentType'];
		}
		return false;
	}

	public function touch($path, $mtime = null) {
		$path = $this->normalizePath($path);

		$metadata = array();
		if ( ! is_null($mtime)) {
			$metadata = array('lastmodified' => $mtime);
		}

		try {
			if ($this->file_exists($path)) {
				if ($this->is_dir($path) && $path != '.') {
					$path .= '/';
				}
				$result = $this->connection->copyObject(array(
					'Bucket' => $this->bucket,
					'Key' => $path,
					'Metadata' => $metadata,
					'CopySource' => $this->bucket . '/' . $path
				));
			} else {
				$result = $this->connection->putObject(array(
					'Bucket' => $this->bucket,
					'Key' => $path,
					'Metadata' => $metadata
				));
			}
		} catch (S3Exception $e) {
			return false;
		}

		return true;
	}

	public function copy($path1, $path2) {
		$path1 = $this->normalizePath($path1);
		$path2 = $this->normalizePath($path2);

		if ($this->is_file($path1)) {
			try {
				$result = $this->connection->copyObject(array(
					'Bucket' => $this->bucket,
					'Key' => $path2,
					'CopySource' => $this->bucket . '/' . $path1
				));
			} catch (S3Exception $e) {
				return false;
			}
		} else {
			if ($this->file_exists($path2)) {
				return false;
			}

			try {
				$result = $this->connection->copyObject(array(
					'Bucket' => $this->bucket,
					'Key' => $path2 . '/',
					'CopySource' => $this->bucket . '/' . $path1 . '/'
				));
			} catch (S3Exception $e) {
				return false;
			}

			$dh = $this->opendir($path1);
			while ($file = readdir($dh)) {
				if ($file == '.' || $file == '..') {
					continue;
				}

				$source = $path1 . '/' . $file;
				$target = $path2 . '/' . $file;
				$this->copy($source, $target);
                	}
		}

		return true;
	}

	public function rename($path1, $path2) {
		$path1 = $this->normalizePath($path1);
		$path2 = $this->normalizePath($path2);

		if ($this->is_file($path1)) {
			if ($this->copy($path1, $path2) == false) {
				return false;
			}

			if ($this->unlink($path1) == false) {
				$this->unlink($path2);
				return false;
			}
		} else {
			if ($this->file_exists($path2)) {
				return false;
			}

			if ($this->copy($path1, $path2) == false) {
				return false;
			}

			if($this->rmdir($path1) == false) {
				$this->rmdir($path2);
				return false;
			}
		}

		return true;
	}

	public function test() {
		$test = $this->s3->get_canonical_user_id();
		if (isset($test['id']) && $test['id'] != '') {
			return true;
		}
		return false;
	}

	public function getId() {
		return $this->id;
	}

	public function getConnection() {
		return $this->connection;
	}

	public function writeBack($tmpFile) {
		if ( ! isset(self::$tmpFiles[$tmpFile])) {
			return false;
		}

		try {
			$result= $this->connection->putObject(array(
				'Bucket' => $this->bucket,
				'Key' => self::$tmpFiles[$tmpFile],
				'SourceFile' => $tmpFile,
				'ContentType' => \OC_Helper::getMimeType($tmpFile),
				'ContentLength' => filesize($tmpFile)
			));

			unlink($tmpFile);
			$this->touch(dirname(self::$tmpFiles[$tmpFile]));
		} catch (S3Exception $e) {
			return false;
		}
	}
}
