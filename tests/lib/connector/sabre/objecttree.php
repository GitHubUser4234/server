<?php
/**
 * Copyright (c) 2013 Thomas Müller <thomas.mueller@tmit.eu>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace Test\OC\Connector\Sabre;


use OC\Files\FileInfo;
use OC\Connector\Sabre\Directory;
use PHPUnit_Framework_TestCase;

class TestDoubleFileView extends \OC\Files\View {

	public function __construct($updatables, $deletables, $canRename = true) {
		$this->updatables = $updatables;
		$this->deletables = $deletables;
		$this->canRename = $canRename;
	}

	public function isUpdatable($path) {
		return $this->updatables[$path];
	}

	public function isCreatable($path) {
		return $this->updatables[$path];
	}

	public function isDeletable($path) {
		return $this->deletables[$path];
	}

	public function rename($path1, $path2) {
		return $this->canRename;
	}

	public function getRelativePath($path){
		return $path;
	}
}

class ObjectTree extends \Test\TestCase {

	/**
	 * @dataProvider moveFailedProvider
	 * @expectedException \Sabre\DAV\Exception\Forbidden
	 */
	public function testMoveFailed($source, $dest, $updatables, $deletables) {
		$this->moveTest($source, $dest, $updatables, $deletables);
	}

	/**
	 * @dataProvider moveSuccessProvider
	 */
	public function testMoveSuccess($source, $dest, $updatables, $deletables) {
		$this->moveTest($source, $dest, $updatables, $deletables);
		$this->assertTrue(true);
	}

	/**
	 * @dataProvider moveFailedInvalidCharsProvider
	 * @expectedException \Sabre\DAV\Exception\BadRequest
	 */
	public function testMoveFailedInvalidChars($source, $dest, $updatables, $deletables) {
		$this->moveTest($source, $dest, $updatables, $deletables);
	}

	function moveFailedInvalidCharsProvider() {
		return array(
			array('a/b', 'a/c*', array('a' => false, 'a/b' => true, 'a/c*' => false), array()),
		);
	}

	function moveFailedProvider() {
		return array(
			array('a/b', 'a/c', array('a' => false, 'a/b' => false, 'a/c' => false), array()),
			array('a/b', 'b/b', array('a' => false, 'a/b' => false, 'b' => false, 'b/b' => false), array()),
			array('a/b', 'b/b', array('a' => false, 'a/b' => true, 'b' => false, 'b/b' => false), array()),
			array('a/b', 'b/b', array('a' => true, 'a/b' => true, 'b' => false, 'b/b' => false), array()),
			array('a/b', 'b/b', array('a' => true, 'a/b' => true, 'b' => true, 'b/b' => false), array('a/b' => false)),
		);
	}

	function moveSuccessProvider() {
		return array(
			array('a/b', 'a/c', array('a' => false, 'a/b' => true, 'a/c' => false), array()),
			array('a/b', 'b/b', array('a' => true, 'a/b' => true, 'b' => true, 'b/b' => false), array('a/b' => true)),
			// older files with special chars can still be renamed to valid names
			array('a/b*', 'b/b', array('a' => true, 'a/b*' => true, 'b' => true, 'b/b' => false), array('a/b*' => true)),
		);
	}

	/**
	 * @param $source
	 * @param $dest
	 * @param $updatables
	 */
	private function moveTest($source, $dest, $updatables, $deletables) {
		$view = new TestDoubleFileView($updatables, $deletables);

		$info = new FileInfo('', null, null, array(), null);

		$rootDir = new Directory($view, $info);
		$objectTree = $this->getMock('\OC\Connector\Sabre\ObjectTree',
			array('nodeExists', 'getNodeForPath'),
			array($rootDir, $view));

		$objectTree->expects($this->once())
			->method('getNodeForPath')
			->with($this->identicalTo($source))
			->will($this->returnValue(false));

		/** @var $objectTree \OC\Connector\Sabre\ObjectTree */
		$mountManager = \OC\Files\Filesystem::getMountManager();
		$objectTree->init($rootDir, $view, $mountManager);
		$objectTree->move($source, $dest);
	}

	/**
	 * @dataProvider nodeForPathProvider
	 */
	public function testGetNodeForPath(
			$inputFileName,
			$fileInfoQueryPath,
			$outputFileName,
			$type,
			$enableChunkingHeader
	) {

		if ($enableChunkingHeader) {
			$_SERVER['HTTP_OC_CHUNKED'] = true;
		}

		$rootNode = $this->getMockBuilder('\OC\Connector\Sabre\Directory')
			->disableOriginalConstructor()
			->getMock();
		$mountManager = $this->getMock('\OC\Files\Mount\Manager');
		$view = $this->getMock('\OC\Files\View');
		$fileInfo = $this->getMock('\OCP\Files\FileInfo');
		$fileInfo->expects($this->once())
			->method('getType')
			->will($this->returnValue($type));
		$fileInfo->expects($this->once())
			->method('getName')
			->will($this->returnValue($outputFileName));

		$view->expects($this->once())
			->method('getFileInfo')
			->with($fileInfoQueryPath)
			->will($this->returnValue($fileInfo));

		$tree = new \OC\Connector\Sabre\ObjectTree();
		$tree->init($rootNode, $view, $mountManager);

		$node = $tree->getNodeForPath($inputFileName);

		$this->assertNotNull($node);
		$this->assertEquals($outputFileName, $node->getName());

		if ($type === 'file') {
			$this->assertTrue($node instanceof \OC\Connector\Sabre\File);
		} else {
			$this->assertTrue($node instanceof \OC\Connector\Sabre\Directory);
		}

		unset($_SERVER['HTTP_OC_CHUNKED']);
	}

	function nodeForPathProvider() {
		return array(
			// regular file
			array(
				'regularfile.txt',
				'regularfile.txt',
				'regularfile.txt',
				'file',
				false
			),
			// regular directory
			array(
				'regulardir',
				'regulardir',
				'regulardir',
				'dir',
				false
			),
			// regular file with chunking
			array(
				'regularfile.txt',
				'regularfile.txt',
				'regularfile.txt',
				'file',
				true
			),
			// regular directory with chunking
			array(
				'regulardir',
				'regulardir',
				'regulardir',
				'dir',
				true
			),
			// file with chunky file name
			array(
				'regularfile.txt-chunking-123566789-10-1',
				'regularfile.txt',
				'regularfile.txt',
				'file',
				true
			),
			// regular file in subdir
			array(
				'subdir/regularfile.txt',
				'subdir/regularfile.txt',
				'regularfile.txt',
				'file',
				false
			),
			// regular directory in subdir
			array(
				'subdir/regulardir',
				'subdir/regulardir',
				'regulardir',
				'dir',
				false
			),
			// file with chunky file name in subdir
			array(
				'subdir/regularfile.txt-chunking-123566789-10-1',
				'subdir/regularfile.txt',
				'regularfile.txt',
				'file',
				true
			),
		);
	}

}
