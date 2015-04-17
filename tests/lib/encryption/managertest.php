<?php

namespace Test\Encryption;

use OC\Encryption\Manager;
use Test\TestCase;

class ManagerTest extends TestCase {

	/** @var Manager */
	private $manager;

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	private $config;

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	private $logger;

	public function setUp() {
		parent::setUp();
		$this->config = $this->getMock('\OCP\IConfig');
		$this->logger = $this->getMock('\OCP\ILogger');
		$this->manager = new Manager($this->config, $this->logger);
	}

	public function testManagerIsDisabled() {
		$this->assertFalse($this->manager->isEnabled());
	}

	public function testManagerIsDisabledIfEnabledButNoModules() {
		$this->config->expects($this->any())->method('getAppValue')->willReturn(true);
		$this->assertFalse($this->manager->isEnabled());
	}

	public function testManagerIsDisabledIfDisabledButModules() {
		$this->config->expects($this->any())->method('getAppValue')->willReturn(false);
		$em = $this->getMock('\OCP\Encryption\IEncryptionModule');
		$em->expects($this->any())->method('getId')->willReturn('id');
		$em->expects($this->any())->method('getDisplayName')->willReturn('TestDummyModule0');
		$this->manager->registerEncryptionModule('id', 'TestDummyModule0', function() use ($em) {return $em;});
		$this->assertFalse($this->manager->isEnabled());
	}

	public function testManagerIsEnabled() {
		$this->config->expects($this->any())->method('getSystemValue')->willReturn(true);
		$this->config->expects($this->any())->method('getAppValue')->willReturn('yes');
		$this->assertTrue($this->manager->isEnabled());
	}

	/**
	 * @expectedException \OC\Encryption\Exceptions\ModuleAlreadyExistsException
	 * @expectedExceptionMessage Id "id" already used by encryption module "TestDummyModule0"
	 */
	public function testModuleRegistration() {
		$this->config->expects($this->any())->method('getAppValue')->willReturn('yes');
		$em = $this->getMock('\OCP\Encryption\IEncryptionModule');
		$em->expects($this->any())->method('getId')->willReturn('id');
		$em->expects($this->any())->method('getDisplayName')->willReturn('TestDummyModule0');

		$this->manager->registerEncryptionModule('id', 'TestDummyModule0', function () use ($em) { return $em;});
		$this->assertSame(1, count($this->manager->getEncryptionModules()));
		$this->manager->registerEncryptionModule('id', 'TestDummyModule0', function () use ($em) { return $em;});
	}

	public function testModuleUnRegistration() {
		$this->config->expects($this->any())->method('getAppValue')->willReturn(true);
		$em = $this->getMock('\OCP\Encryption\IEncryptionModule');
		$em->expects($this->any())->method('getId')->willReturn('id');
		$em->expects($this->any())->method('getDisplayName')->willReturn('TestDummyModule0');
		$this->manager->registerEncryptionModule('id', 'TestDummyModule0', function () use ($em) { return $em;});
		$this->assertSame(1,
			count($this->manager->getEncryptionModules())
		);

		$this->manager->unregisterEncryptionModule('id');
		$this->assertEmpty($this->manager->getEncryptionModules());

	}

	/**
	 * @expectedException \OC\Encryption\Exceptions\ModuleDoesNotExistsException
	 * @expectedExceptionMessage Module with id: unknown does not exists.
	 */
	public function testGetEncryptionModuleUnknown() {
		$this->config->expects($this->any())->method('getAppValue')->willReturn(true);
		$em = $this->getMock('\OCP\Encryption\IEncryptionModule');
		$em->expects($this->any())->method('getId')->willReturn('id');
		$em->expects($this->any())->method('getDisplayName')->willReturn('TestDummyModule0');
		$this->manager->registerEncryptionModule('id', 'TestDummyModule0', function () use ($em) { return $em;});
		$this->assertSame(1, count($this->manager->getEncryptionModules()));
		$this->manager->getEncryptionModule('unknown');
	}

	public function testGetEncryptionModuleEmpty() {
		global $defaultId;
		$defaultId = null;

		$this->config->expects($this->any())
			->method('getAppValue')
			->with('core', 'default_encryption_module')
			->willReturnCallback(function() { global $defaultId; return $defaultId; });

		$this->addNewEncryptionModule($this->manager, 0);
		$this->assertCount(1, $this->manager->getEncryptionModules());
		$this->addNewEncryptionModule($this->manager, 1);
		$this->assertCount(2, $this->manager->getEncryptionModules());

		// Should return the default module
		$defaultId = 'ID0';
		$this->assertEquals('ID0', $this->manager->getEncryptionModule()->getId());
		$defaultId = 'ID1';
		$this->assertEquals('ID1', $this->manager->getEncryptionModule()->getId());
	}

	public function testGetEncryptionModule() {
		$this->config->expects($this->any())->method('getAppValue')->willReturn(true);
		$em = $this->getMock('\OCP\Encryption\IEncryptionModule');
		$em->expects($this->any())->method('getId')->willReturn('id');
		$em->expects($this->any())->method('getDisplayName')->willReturn('TestDummyModule0');
		$this->manager->registerEncryptionModule('id', 'TestDummyModule0', function () use ($em) { return $em;});
		$this->assertSame(1, count($this->manager->getEncryptionModules()));
		$en0 = $this->manager->getEncryptionModule('id');
		$this->assertEquals('id', $en0->getId());
	}

	public function testGetDefaultEncryptionModule() {
		$this->config->expects($this->any())->method('getAppValue')->willReturn(true);
		$em = $this->getMock('\OCP\Encryption\IEncryptionModule');
		$em->expects($this->any())->method('getId')->willReturn('id');
		$em->expects($this->any())->method('getDisplayName')->willReturn('TestDummyModule0');
		$this->manager->registerEncryptionModule('id', 'TestDummyModule0', function () use ($em) { return $em;});
		$this->assertSame(1, count($this->manager->getEncryptionModules()));
		$en0 = $this->manager->getEncryptionModule('id');
		$this->assertEquals('id', $en0->getId());
	}

//	/**
//	 * @expectedException \OC\Encryption\Exceptions\ModuleAlreadyExistsException
//	 * @expectedExceptionMessage Id "0" already used by encryption module "TestDummyModule0"
//	 */
//	public function testModuleRegistration() {
//		$config = $this->getMock('\OCP\IConfig');
//		$config->expects($this->any())->method('getSystemValue')->willReturn(true);
//		$em = $this->getMock('\OCP\Encryption\IEncryptionModule');
//		$em->expects($this->any())->method('getId')->willReturn(0);
//		$em->expects($this->any())->method('getDisplayName')->willReturn('TestDummyModule0');
//		$m = new Manager($config);
//		$m->registerEncryptionModule($em);
//		$this->assertTrue($m->isEnabled());
//		$m->registerEncryptionModule($em);
//	}
//
//	public function testModuleUnRegistration() {
//		$config = $this->getMock('\OCP\IConfig');
//		$config->expects($this->any())->method('getSystemValue')->willReturn(true);
//		$em = $this->getMock('\OCP\Encryption\IEncryptionModule');
//		$em->expects($this->any())->method('getId')->willReturn(0);
//		$em->expects($this->any())->method('getDisplayName')->willReturn('TestDummyModule0');
//		$m = new Manager($config);
//		$m->registerEncryptionModule($em);
//		$this->assertTrue($m->isEnabled());
//		$m->unregisterEncryptionModule($em);
//		$this->assertFalse($m->isEnabled());
//	}
//
//	/**
//	 * @expectedException \OC\Encryption\Exceptions\ModuleDoesNotExistsException
//	 * @expectedExceptionMessage Module with id: unknown does not exists.
//	 */
//	public function testGetEncryptionModuleUnknown() {
//		$config = $this->getMock('\OCP\IConfig');
//		$config->expects($this->any())->method('getSystemValue')->willReturn(true);
//		$em = $this->getMock('\OCP\Encryption\IEncryptionModule');
//		$em->expects($this->any())->method('getId')->willReturn(0);
//		$em->expects($this->any())->method('getDisplayName')->willReturn('TestDummyModule0');
//		$m = new Manager($config);
//		$m->registerEncryptionModule($em);
//		$this->assertTrue($m->isEnabled());
//		$m->getEncryptionModule('unknown');
//	}
//
//	public function testGetEncryptionModule() {
//		$config = $this->getMock('\OCP\IConfig');
//		$config->expects($this->any())->method('getSystemValue')->willReturn(true);
//		$em = $this->getMock('\OCP\Encryption\IEncryptionModule');
//		$em->expects($this->any())->method('getId')->willReturn(0);
//		$em->expects($this->any())->method('getDisplayName')->willReturn('TestDummyModule0');
//		$m = new Manager($config);
//		$m->registerEncryptionModule($em);
//		$this->assertTrue($m->isEnabled());
//		$en0 = $m->getEncryptionModule(0);
//		$this->assertEquals(0, $en0->getId());
//	}

	protected function addNewEncryptionModule(Manager $manager, $id) {
		$encryptionModule = $this->getMock('\OCP\Encryption\IEncryptionModule');
		$encryptionModule->expects($this->any())
			->method('getId')
			->willReturn('ID' . $id);
		$encryptionModule->expects($this->any())
			->method('getDisplayName')
			->willReturn('TestDummyModule' . $id);
		/** @var \OCP\Encryption\IEncryptionModule $encryptionModule */
		$manager->registerEncryptionModule('ID' . $id, 'TestDummyModule' . $id, function() use ($encryptionModule) {
			return $encryptionModule;
		});
	}
}
