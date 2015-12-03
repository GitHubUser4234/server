<?php
/**
 * Copyright (c) 2015 Vincent Petry <pvince81@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OCA\DAV\Tests\Unit\SystemTag;

use OC\SystemTag\SystemTag;
use OCP\SystemTag\TagAlreadyExistsException;

class SystemTagPlugin extends \Test\TestCase {

	const ID_PROPERTYNAME = \OCA\DAV\SystemTag\SystemTagPlugin::ID_PROPERTYNAME;
	const DISPLAYNAME_PROPERTYNAME = \OCA\DAV\SystemTag\SystemTagPlugin::DISPLAYNAME_PROPERTYNAME;
	const USERVISIBLE_PROPERTYNAME = \OCA\DAV\SystemTag\SystemTagPlugin::USERVISIBLE_PROPERTYNAME;
	const USERASSIGNABLE_PROPERTYNAME = \OCA\DAV\SystemTag\SystemTagPlugin::USERASSIGNABLE_PROPERTYNAME;

	/**
	 * @var \Sabre\DAV\Server
	 */
	private $server;

	/**
	 * @var \Sabre\DAV\Tree
	 */
	private $tree;

	/**
	 * @var \OCP\SystemTag\ISystemTagManager
	 */
	private $tagManager;

	/**
	 * @var \OCA\DAV\Connector\Sabre\TagsPlugin
	 */
	private $plugin;

	public function setUp() {
		parent::setUp();
		$this->tree = $this->getMockBuilder('\Sabre\DAV\Tree')
			->disableOriginalConstructor()
			->getMock();

		$this->server = new \Sabre\DAV\Server($this->tree);

		$this->tagManager = $this->getMock('\OCP\SystemTag\ISystemTagManager');

		$this->plugin = new \OCA\DAV\SystemTag\SystemTagPlugin($this->tagManager);
		$this->plugin->initialize($this->server);
	}

	public function testGetProperties() {
		$systemTag = new SystemTag(1, 'Test', true, true);
		$requestedProperties = [
			self::ID_PROPERTYNAME,
			self::DISPLAYNAME_PROPERTYNAME,
			self::USERVISIBLE_PROPERTYNAME,
			self::USERASSIGNABLE_PROPERTYNAME
		];
		$expectedProperties = [
			200 => [
				self::ID_PROPERTYNAME => '1',
				self::DISPLAYNAME_PROPERTYNAME => 'Test',
				self::USERVISIBLE_PROPERTYNAME => 1,
				self::USERASSIGNABLE_PROPERTYNAME => 1,
			]
		];

		$node = $this->getMockBuilder('\OCA\DAV\SystemTag\SystemTagNode')
			->disableOriginalConstructor()
			->getMock();
		$node->expects($this->any())
			->method('getSystemTag')
			->will($this->returnValue($systemTag));

		$this->tree->expects($this->any())
			->method('getNodeForPath')
			->with('/systemtag/1')
			->will($this->returnValue($node));

		$propFind = new \Sabre\DAV\PropFind(
			'/systemtag/1',
			$requestedProperties,
			0
		);

		$this->plugin->handleGetProperties(
			$propFind,
			$node
		);

		$result = $propFind->getResultForMultiStatus();

		$this->assertEmpty($result[404]);
		unset($result[404]);
		$this->assertEquals($expectedProperties, $result);
	}

	public function testUpdateProperties() {
		$systemTag = new SystemTag(1, 'Test', true, false);
		$node = $this->getMockBuilder('\OCA\DAV\SystemTag\SystemTagNode')
			->disableOriginalConstructor()
			->getMock();
		$node->expects($this->any())
			->method('getSystemTag')
			->will($this->returnValue($systemTag));

		$this->tree->expects($this->any())
			->method('getNodeForPath')
			->with('/systemtag/1')
			->will($this->returnValue($node));

		$node->expects($this->once())
			->method('update')
			->with('Test changed', false, true);

		// properties to set
		$propPatch = new \Sabre\DAV\PropPatch(array(
			self::DISPLAYNAME_PROPERTYNAME => 'Test changed',
			self::USERVISIBLE_PROPERTYNAME => 0,
			self::USERASSIGNABLE_PROPERTYNAME => 1,
		));

		$this->plugin->handleUpdateProperties(
			'/systemtag/1',
			$propPatch
		);

		$propPatch->commit();

		// all requested properties removed, as they were processed already
		$this->assertEmpty($propPatch->getRemainingMutations());

		$result = $propPatch->getResult();
		$this->assertEquals(200, $result[self::DISPLAYNAME_PROPERTYNAME]);
		$this->assertEquals(200, $result[self::USERASSIGNABLE_PROPERTYNAME]);
		$this->assertEquals(200, $result[self::USERVISIBLE_PROPERTYNAME]);
	}

	public function testCreateTagInByIdCollection() {
		$systemTag = new SystemTag(1, 'Test', true, false);

		$requestData = json_encode([
			'name' => 'Test',
			'userVisible' => true,
			'userAssignable' => false,
		]);

		$node = $this->getMockBuilder('\OCA\DAV\SystemTag\SystemTagsByIdCollection')
			->disableOriginalConstructor()
			->getMock();
		$this->tagManager->expects($this->once())
			->method('createTag')
			->with('Test', true, false)
			->will($this->returnValue($systemTag));

		$this->tree->expects($this->any())
			->method('getNodeForPath')
			->with('/systemtags')
			->will($this->returnValue($node));

		$request = $this->getMockBuilder('Sabre\HTTP\RequestInterface')
				->disableOriginalConstructor()
				->getMock();
		$response = $this->getMockBuilder('Sabre\HTTP\ResponseInterface')
				->disableOriginalConstructor()
				->getMock();

		$request->expects($this->once())
			->method('getPath')
			->will($this->returnValue('/systemtags'));

		$request->expects($this->once())
			->method('getBodyAsString')
			->will($this->returnValue($requestData));

		$request->expects($this->once())
			->method('getHeader')
			->with('Content-Type')
			->will($this->returnValue('application/json'));	

		$request->expects($this->once())
			->method('getUrl')
			->will($this->returnValue('http://example.com/dav/systemtags'));

		$response->expects($this->once())
			->method('setHeader')
			->with('Location', 'http://example.com/dav/systemtags/1');

		$this->plugin->httpPost($request, $response);
	}

	public function nodeClassProvider() {
		return [
			['\OCA\DAV\SystemTag\SystemTagsByIdCollection'],
			['\OCA\DAV\SystemTag\SystemTagsObjectMappingCollection'],
		];
	}

	public function testCreateTagInMappingCollection() {
		$systemTag = new SystemTag(1, 'Test', true, false);

		$requestData = json_encode([
			'name' => 'Test',
			'userVisible' => true,
			'userAssignable' => false,
		]);

		$node = $this->getMockBuilder('\OCA\DAV\SystemTag\SystemTagsObjectMappingCollection')
			->disableOriginalConstructor()
			->getMock();

		$this->tagManager->expects($this->once())
			->method('createTag')
			->with('Test', true, false)
			->will($this->returnValue($systemTag));

		$this->tree->expects($this->any())
			->method('getNodeForPath')
			->with('/systemtags-relations/files/12')
			->will($this->returnValue($node));

		$node->expects($this->once())
			->method('createFile')
			->with(1);

		$request = $this->getMockBuilder('Sabre\HTTP\RequestInterface')
				->disableOriginalConstructor()
				->getMock();
		$response = $this->getMockBuilder('Sabre\HTTP\ResponseInterface')
				->disableOriginalConstructor()
				->getMock();

		$request->expects($this->once())
			->method('getPath')
			->will($this->returnValue('/systemtags-relations/files/12'));

		$request->expects($this->once())
			->method('getBodyAsString')
			->will($this->returnValue($requestData));

		$request->expects($this->once())
			->method('getHeader')
			->with('Content-Type')
			->will($this->returnValue('application/json'));	

		$request->expects($this->once())
			->method('getBaseUrl')
			->will($this->returnValue('http://example.com/dav/'));

		$response->expects($this->once())
			->method('setHeader')
			->with('Location', 'http://example.com/dav/systemtags/1');

		$this->plugin->httpPost($request, $response);
	}

	/**
	 * @dataProvider nodeClassProvider
	 * @expectedException Sabre\DAV\Exception\Conflict
	 */
	public function testCreateTagConflict($nodeClass) {
		$requestData = json_encode([
			'name' => 'Test',
			'userVisible' => true,
			'userAssignable' => false,
		]);

		$node = $this->getMockBuilder($nodeClass)
			->disableOriginalConstructor()
			->getMock();
		$this->tagManager->expects($this->once())
			->method('createTag')
			->with('Test', true, false)
			->will($this->throwException(new TagAlreadyExistsException('Tag already exists')));

		$this->tree->expects($this->any())
			->method('getNodeForPath')
			->with('/systemtags')
			->will($this->returnValue($node));

		$request = $this->getMockBuilder('Sabre\HTTP\RequestInterface')
				->disableOriginalConstructor()
				->getMock();
		$response = $this->getMockBuilder('Sabre\HTTP\ResponseInterface')
				->disableOriginalConstructor()
				->getMock();

		$request->expects($this->once())
			->method('getPath')
			->will($this->returnValue('/systemtags'));

		$request->expects($this->once())
			->method('getBodyAsString')
			->will($this->returnValue($requestData));

		$request->expects($this->once())
			->method('getHeader')
			->with('Content-Type')
			->will($this->returnValue('application/json'));	

		$this->plugin->httpPost($request, $response);
	}

}
