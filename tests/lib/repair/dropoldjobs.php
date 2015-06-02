<?php
/**
 * Copyright (c) 2015 Arthur Schiwon <blizzz@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace Test\Repair;

use OCP\BackgroundJob\IJobList;

/**
 * Tests for the dropping old tables
 *
 * @see \OC\Repair\DropOldTables
 */
class DropOldJobs extends \Test\TestCase {
	/** @var IJobList */
	protected $jobList;

	protected function setUp() {
		parent::setUp();

		$this->jobList = \OC::$server->getJobList();
		$this->jobList->add('OC\Cache\FileGlobalGC');
		$this->jobList->add('OC_Cache_FileGlobalGC');
	}

	public function testRun() {
		$this->assertTrue($this->jobList->has('OC\Cache\FileGlobalGC', null), 'Asserting that the job OC\Cache\FileGlobalGC exists before repairing');
		$this->assertTrue($this->jobList->has('OC_Cache_FileGlobalGC', null), 'Asserting that the job OC_Cache_FileGlobalGC exists before repairing');

		$repair = new \OC\Repair\DropOldJobs($this->jobList);
		$repair->run();

		$this->assertFalse($this->jobList->has('OC\Cache\FileGlobalGC', null), 'Asserting that the job OC\Cache\FileGlobalGC does not exist after repairing');
		$this->assertFalse($this->jobList->has('OC_Cache_FileGlobalGC', null), 'Asserting that the job OC_Cache_FileGlobalGC does not exist after repairing');
	}
}
