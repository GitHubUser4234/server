<?php
/**
 * @author Lukas Reschke <lukas@owncloud.com>
 *
 * @copyright Copyright (c) 2016, ownCloud, Inc.
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

namespace OCA\UpdateNotification\Tests\Controller;

use OCA\UpdateNotification\Controller\AdminController;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Utility\ITimeFactory;
use OCP\BackgroundJob\IJobList;
use OCP\IConfig;
use OCP\IRequest;
use OCP\Security\ISecureRandom;
use Test\TestCase;

class AdminControllerTest extends TestCase {
	/** @var IRequest */
	private $request;
	/** @var IJobList */
	private $jobList;
	/** @var ISecureRandom */
	private $secureRandom;
	/** @var IConfig */
	private $config;
	/** @var AdminController */
	private $adminController;
	/** @var ITimeFactory */
	private $timeFactory;

	public function setUp() {
		parent::setUp();

		$this->request = $this->getMock('\\OCP\\IRequest');
		$this->jobList = $this->getMock('\\OCP\\BackgroundJob\\IJobList');
		$this->secureRandom = $this->getMock('\\OCP\\Security\\ISecureRandom');
		$this->config = $this->getMock('\\OCP\\IConfig');
		$this->timeFactory = $this->getMock('\\OCP\\AppFramework\\Utility\\ITimeFactory');

		$this->adminController = new AdminController(
			'updatenotification',
			$this->request,
			$this->jobList,
			$this->secureRandom,
			$this->config,
			$this->timeFactory
		);
	}

	public function testDisplayPanel() {
		$expected = new TemplateResponse('updatenotification', 'admin', [], '');
		$this->assertEquals($expected, $this->adminController->displayPanel());
	}

	public function testCreateCredentials() {
		$this->jobList
			->expects($this->once())
			->method('add')
			->with('OCA\UpdateNotification\ResetTokenBackgroundJob');
		$this->secureRandom
			->expects($this->once())
			->method('generate')
			->with(32)
			->willReturn('MyGeneratedToken');
		$this->config
			->expects($this->once())
			->method('setSystemValue')
			->with('updater.secret', 'MyGeneratedToken');
		$this->timeFactory
			->expects($this->once())
			->method('getTime')
			->willReturn(12345);
		$this->config
			->expects($this->once())
			->method('setAppValue')
			->with('core', 'updater.secret.created', 12345);

		$expected = new DataResponse('MyGeneratedToken');
		$this->assertEquals($expected, $this->adminController->createCredentials());
	}
}
