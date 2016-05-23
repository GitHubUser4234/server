<?php

namespace Test\Files\Mount;

use OC\Files\Mount\ObjectHomeMountProvider;
use OCP\Files\Storage\IStorageFactory;
use OCP\IConfig;
use OCP\IUser;

class ObjectHomeMountProviderTest extends \Test\TestCase {

	/** @var ObjectHomeMountProvider */
	protected $provider;

	/** @var IConfig|\PHPUnit_Framework_MockObject_MockObject */
	protected $config;

	/** @var IUser|\PHPUnit_Framework_MockObject_MockObject */
	protected $user;

	/** @var IStorageFactory|\PHPUnit_Framework_MockObject_MockObject */
	protected $loader;

	public function setUp() {
		parent::setUp();

		$this->config = $this->getMock('OCP\IConfig');
		$this->user = $this->getMock('OCP\IUser');
		$this->loader = $this->getMock('OCP\Files\Storage\IStorageFactory');

		$this->provider = new ObjectHomeMountProvider($this->config);
	}

	public function testSingleBucket() {
		$this->config->expects($this->once())
			->method('getSystemValue')
			->with($this->equalTo('objectstore'), '')
			->willReturn([
				'class' => 'Test\Files\Mount\FakeObjectStore',
			]);

		$this->user->expects($this->never())->method($this->anything());
		$this->loader->expects($this->never())->method($this->anything());

		$config = $this->invokePrivate($this->provider, 'singleBucketObjectStore', [$this->user, $this->loader]);

		$this->assertArrayHasKey('class', $config);
		$this->assertEquals($config['class'], 'Test\Files\Mount\FakeObjectStore');
		$this->assertArrayHasKey('arguments', $config);
		$this->assertArrayHasKey('user', $config['arguments']);
		$this->assertSame($this->user, $config['arguments']['user']);
		$this->assertArrayHasKey('objectstore', $config['arguments']);
		$this->assertInstanceOf('Test\Files\Mount\FakeObjectStore', $config['arguments']['objectstore']);
	}

	public function testMultiBucket() {
		$this->config->expects($this->once())
			->method('getSystemValue')
			->with($this->equalTo('objectstore_multibucket'), '')
			->willReturn([
				'class' => 'Test\Files\Mount\FakeObjectStore',
			]);

		$this->user->expects($this->once())
			->method('getUID')
			->willReturn('uid');
		$this->loader->expects($this->never())->method($this->anything());

		$config = $this->invokePrivate($this->provider, 'multiBucketObjectStore', [$this->user, $this->loader]);

		$this->assertArrayHasKey('class', $config);
		$this->assertEquals($config['class'], 'Test\Files\Mount\FakeObjectStore');
		$this->assertArrayHasKey('arguments', $config);
		$this->assertArrayHasKey('user', $config['arguments']);
		$this->assertSame($this->user, $config['arguments']['user']);
		$this->assertArrayHasKey('objectstore', $config['arguments']);
		$this->assertInstanceOf('Test\Files\Mount\FakeObjectStore', $config['arguments']['objectstore']);
		$this->assertArrayHasKey('bucket', $config['arguments']);
		$this->assertEquals('987', $config['arguments']['bucket']);
	}

	public function testMultiBucketWithPrefix() {
		$this->config->expects($this->once())
			->method('getSystemValue')
			->with($this->equalTo('objectstore_multibucket'), '')
			->willReturn([
				'class' => 'Test\Files\Mount\FakeObjectStore',
				'arguments' => [
					'bucket' => 'myBucketPrefix',
				],
			]);

		$this->user->expects($this->once())
			->method('getUID')
			->willReturn('uid');
		$this->loader->expects($this->never())->method($this->anything());

		$config = $this->invokePrivate($this->provider, 'multiBucketObjectStore', [$this->user, $this->loader]);

		$this->assertArrayHasKey('class', $config);
		$this->assertEquals($config['class'], 'Test\Files\Mount\FakeObjectStore');
		$this->assertArrayHasKey('arguments', $config);
		$this->assertArrayHasKey('user', $config['arguments']);
		$this->assertSame($this->user, $config['arguments']['user']);
		$this->assertArrayHasKey('objectstore', $config['arguments']);
		$this->assertInstanceOf('Test\Files\Mount\FakeObjectStore', $config['arguments']['objectstore']);
		$this->assertArrayHasKey('bucket', $config['arguments']);
		$this->assertEquals('myBucketPrefix987', $config['arguments']['bucket']);
	}

	public function testMultiBucketConfigFirst() {
		$this->config->expects($this->once())
			->method('getSystemValue')
			->with($this->equalTo('objectstore_multibucket'))
			->willReturn([
				'class' => 'Test\Files\Mount\FakeObjectStore',
			]);

		$this->user->expects($this->exactly(2))
			->method('getUID')
			->willReturn('uid');
		$this->loader->expects($this->never())->method($this->anything());

		$mount = $this->provider->getHomeMountForUser($this->user, $this->loader);
		$this->assertInstanceOf('OC\Files\Mount\MountPoint', $mount);
	}

	public function testMultiBucketConfigFirstFallBackSingle() {
		$this->config->expects($this->at(0))
			->method('getSystemValue')
			->with($this->equalTo('objectstore_multibucket'))
			->willReturn('');

		$this->config->expects($this->at(1))
			->method('getSystemValue')
			->with($this->equalTo('objectstore'))
			->willReturn([
				'class' => 'Test\Files\Mount\FakeObjectStore',
			]);

		$this->user->expects($this->once())
			->method('getUID')
			->willReturn('uid');
		$this->loader->expects($this->never())->method($this->anything());
		
		$mount = $this->provider->getHomeMountForUser($this->user, $this->loader);
		$this->assertInstanceOf('OC\Files\Mount\MountPoint', $mount);
	}

	public function testNoObjectStore() {
		$this->config->expects($this->exactly(2))
			->method('getSystemValue')
			->willReturn('');

		$mount = $this->provider->getHomeMountForUser($this->user, $this->loader);
		$this->assertNull($mount);
	}
}

class FakeObjectStore {
	private $arguments;

	public function __construct(array $arguments) {
		$this->arguments = $arguments;
	}

	public function getArguments() {
		return $this->arguments;
	}
}