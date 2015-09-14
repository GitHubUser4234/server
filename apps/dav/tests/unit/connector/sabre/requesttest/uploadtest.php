<?php
/**
 * Copyright (c) 2015 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OCA\DAV\Tests\Unit\Connector\Sabre\RequestTest;

use OC\Connector\Sabre\Exception\FileLocked;
use OCP\AppFramework\Http;
use OCP\Lock\ILockingProvider;

class UploadTest extends RequestTest {
	public function testBasicUpload() {
		$user = $this->getUniqueID();
		$view = $this->setupUser($user, 'pass');

		$this->assertFalse($view->file_exists('foo.txt'));
		$response = $this->request($view, $user, 'pass', 'PUT', '/foo.txt', 'asd');

		$this->assertEquals(Http::STATUS_CREATED, $response->getStatus());
		$this->assertTrue($view->file_exists('foo.txt'));
		$this->assertEquals('asd', $view->file_get_contents('foo.txt'));

		$info = $view->getFileInfo('foo.txt');
		$this->assertInstanceOf('\OC\Files\FileInfo', $info);
		$this->assertEquals(3, $info->getSize());
	}

	public function testUploadOverWrite() {
		$user = $this->getUniqueID();
		$view = $this->setupUser($user, 'pass');

		$view->file_put_contents('foo.txt', 'foobar');

		$response = $this->request($view, $user, 'pass', 'PUT', '/foo.txt', 'asd');

		$this->assertEquals(Http::STATUS_NO_CONTENT, $response->getStatus());
		$this->assertEquals('asd', $view->file_get_contents('foo.txt'));

		$info = $view->getFileInfo('foo.txt');
		$this->assertInstanceOf('\OC\Files\FileInfo', $info);
		$this->assertEquals(3, $info->getSize());
	}

	/**
	 * @expectedException \OC\Connector\Sabre\Exception\FileLocked
	 */
	public function testUploadOverWriteReadLocked() {
		$user = $this->getUniqueID();
		$view = $this->setupUser($user, 'pass');

		$view->file_put_contents('foo.txt', 'bar');

		$view->lockFile('/foo.txt', ILockingProvider::LOCK_SHARED);

		$this->request($view, $user, 'pass', 'PUT', '/foo.txt', 'asd');
	}

	/**
	 * @expectedException \OC\Connector\Sabre\Exception\FileLocked
	 */
	public function testUploadOverWriteWriteLocked() {
		$user = $this->getUniqueID();
		$view = $this->setupUser($user, 'pass');

		$view->file_put_contents('foo.txt', 'bar');

		$view->lockFile('/foo.txt', ILockingProvider::LOCK_EXCLUSIVE);

		$this->request($view, $user, 'pass', 'PUT', '/foo.txt', 'asd');
	}

	public function testChunkedUpload() {
		$user = $this->getUniqueID();
		$view = $this->setupUser($user, 'pass');

		$this->assertFalse($view->file_exists('foo.txt'));
		$response = $this->request($view, $user, 'pass', 'PUT', '/foo.txt-chunking-123-2-0', 'asd', ['OC-Chunked' => '1']);

		$this->assertEquals(201, $response->getStatus());
		$this->assertFalse($view->file_exists('foo.txt'));

		$response = $this->request($view, $user, 'pass', 'PUT', '/foo.txt-chunking-123-2-1', 'bar', ['OC-Chunked' => '1']);

		$this->assertEquals(Http::STATUS_CREATED, $response->getStatus());
		$this->assertTrue($view->file_exists('foo.txt'));

		$this->assertEquals('asdbar', $view->file_get_contents('foo.txt'));

		$info = $view->getFileInfo('foo.txt');
		$this->assertInstanceOf('\OC\Files\FileInfo', $info);
		$this->assertEquals(6, $info->getSize());
	}

	public function testChunkedUploadOverWrite() {
		$user = $this->getUniqueID();
		$view = $this->setupUser($user, 'pass');

		$view->file_put_contents('foo.txt', 'bar');
		$response = $this->request($view, $user, 'pass', 'PUT', '/foo.txt-chunking-123-2-0', 'asd', ['OC-Chunked' => '1']);

		$this->assertEquals(Http::STATUS_CREATED, $response->getStatus());
		$this->assertEquals('bar', $view->file_get_contents('foo.txt'));

		$response = $this->request($view, $user, 'pass', 'PUT', '/foo.txt-chunking-123-2-1', 'bar', ['OC-Chunked' => '1']);

		$this->assertEquals(Http::STATUS_CREATED, $response->getStatus());

		$this->assertEquals('asdbar', $view->file_get_contents('foo.txt'));

		$info = $view->getFileInfo('foo.txt');
		$this->assertInstanceOf('\OC\Files\FileInfo', $info);
		$this->assertEquals(6, $info->getSize());
	}

	public function testChunkedUploadOutOfOrder() {
		$user = $this->getUniqueID();
		$view = $this->setupUser($user, 'pass');

		$this->assertFalse($view->file_exists('foo.txt'));
		$response = $this->request($view, $user, 'pass', 'PUT', '/foo.txt-chunking-123-2-1', 'bar', ['OC-Chunked' => '1']);

		$this->assertEquals(Http::STATUS_CREATED, $response->getStatus());
		$this->assertFalse($view->file_exists('foo.txt'));

		$response = $this->request($view, $user, 'pass', 'PUT', '/foo.txt-chunking-123-2-0', 'asd', ['OC-Chunked' => '1']);

		$this->assertEquals(201, $response->getStatus());
		$this->assertTrue($view->file_exists('foo.txt'));

		$this->assertEquals('asdbar', $view->file_get_contents('foo.txt'));

		$info = $view->getFileInfo('foo.txt');
		$this->assertInstanceOf('\OC\Files\FileInfo', $info);
		$this->assertEquals(6, $info->getSize());
	}

	/**
	 * @expectedException \OC\Connector\Sabre\Exception\FileLocked
	 */
	public function testChunkedUploadOutOfOrderReadLocked() {
		$user = $this->getUniqueID();
		$view = $this->setupUser($user, 'pass');

		$this->assertFalse($view->file_exists('foo.txt'));

		$view->lockFile('/foo.txt', ILockingProvider::LOCK_SHARED);

		try {
			$response = $this->request($view, $user, 'pass', 'PUT', '/foo.txt-chunking-123-2-1', 'bar', ['OC-Chunked' => '1']);
		} catch (FileLocked $e) {
			$this->fail('Didn\'t expect locked error for the first chunk on read lock');
			return;
		}

		$this->assertEquals(Http::STATUS_CREATED, $response->getStatus());
		$this->assertFalse($view->file_exists('foo.txt'));

		// last chunk should trigger the locked error since it tries to assemble
		$this->request($view, $user, 'pass', 'PUT', '/foo.txt-chunking-123-2-0', 'asd', ['OC-Chunked' => '1']);
	}

	/**
	 * @expectedException \OC\Connector\Sabre\Exception\FileLocked
	 */
	public function testChunkedUploadOutOfOrderWriteLocked() {
		$user = $this->getUniqueID();
		$view = $this->setupUser($user, 'pass');

		$this->assertFalse($view->file_exists('foo.txt'));

		$view->lockFile('/foo.txt', ILockingProvider::LOCK_EXCLUSIVE);

		try {
			$response = $this->request($view, $user, 'pass', 'PUT', '/foo.txt-chunking-123-2-1', 'bar', ['OC-Chunked' => '1']);
		} catch (FileLocked $e) {
			$this->fail('Didn\'t expect locked error for the first chunk on write lock'); // maybe forbid this in the future for write locks only?
			return;
		}

		$this->assertEquals(Http::STATUS_CREATED, $response->getStatus());
		$this->assertFalse($view->file_exists('foo.txt'));

		// last chunk should trigger the locked error since it tries to assemble
		$this->request($view, $user, 'pass', 'PUT', '/foo.txt-chunking-123-2-0', 'asd', ['OC-Chunked' => '1']);
	}
}
