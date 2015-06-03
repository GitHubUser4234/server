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

	/** @var \PHPUnit_Framework_MockObject_MockObject */
	private $l10n;

	public function setUp() {
		parent::setUp();
		$this->config = $this->getMock('\OCP\IConfig');
		$this->logger = $this->getMock('\OCP\ILogger');
		$this->l10n = $this->getMock('\OCP\Il10n');
		$this->manager = new Manager($this->config, $this->logger, $this->l10n);
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

	public function testModuleRegistration() {
		$this->config->expects($this->any())->method('getAppValue')->willReturn('yes');

		$this->addNewEncryptionModule($this->manager, 0);
		$this->assertCount(1, $this->manager->getEncryptionModules());

		return $this->manager;
	}

	/**
	 * @depends testModuleRegistration
	 * @expectedException \OC\Encryption\Exceptions\ModuleAlreadyExistsException
	 * @expectedExceptionMessage Id "ID0" already used by encryption module "TestDummyModule0"
	 */
	public function testModuleReRegistration($manager) {
		$this->addNewEncryptionModule($manager, 0);
	}

	public function testModuleUnRegistration() {
		$this->config->expects($this->any())->method('getAppValue')->willReturn(true);
		$this->addNewEncryptionModule($this->manager, 0);
		$this->assertCount(1, $this->manager->getEncryptionModules());

		$this->manager->unregisterEncryptionModule('ID0');
		$this->assertEmpty($this->manager->getEncryptionModules());

	}

	/**
	 * @expectedException \OC\Encryption\Exceptions\ModuleDoesNotExistsException
	 * @expectedExceptionMessage Module with id: unknown does not exists.
	 */
	public function testGetEncryptionModuleUnknown() {
		$this->config->expects($this->any())->method('getAppValue')->willReturn(true);
		$this->addNewEncryptionModule($this->manager, 0);
		$this->assertCount(1, $this->manager->getEncryptionModules());
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
		global $defaultId;
		$defaultId = null;

		$this->config->expects($this->any())
			->method('getAppValue')
			->with('core', 'default_encryption_module')
			->willReturnCallback(function() { global $defaultId; return $defaultId; });

		$this->addNewEncryptionModule($this->manager, 0);
		$defaultId = 'ID0';
		$this->assertCount(1, $this->manager->getEncryptionModules());

		$en0 = $this->manager->getEncryptionModule('ID0');
		$this->assertEquals('ID0', $en0->getId());

		$en0 = self::invokePrivate($this->manager, 'getDefaultEncryptionModule');
		$this->assertEquals('ID0', $en0->getId());

		$this->assertEquals('ID0', $this->manager->getDefaultEncryptionModuleId());
	}

	public function testSetDefaultEncryptionModule() {
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

		// Default module is the first we set
		$defaultId = 'ID0';
		$this->assertEquals('ID0', $this->manager->getDefaultEncryptionModuleId());

		// Set to an existing module
		$this->config->expects($this->once())
			->method('setAppValue')
			->with('core', 'default_encryption_module', 'ID1');
		$this->assertTrue($this->manager->setDefaultEncryptionModule('ID1'));
		$defaultId = 'ID1';
		$this->assertEquals('ID1', $this->manager->getDefaultEncryptionModuleId());

		// Set to an unexisting module
		$this->assertFalse($this->manager->setDefaultEncryptionModule('ID2'));
		$this->assertEquals('ID1', $this->manager->getDefaultEncryptionModuleId());
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
