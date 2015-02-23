<?php
/**
 * Copyright (c) 2015 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OC\Command;

use OCP\Command\IBus;
use OCP\Command\ICommand;
use SuperClosure\Serializer;

/**
 * Asynchronous command bus that uses the background job system as backend
 */
class AsyncBus implements IBus {
	/**
	 * @var \OCP\BackgroundJob\IJobList
	 */
	private $jobList;

	/**
	 * List of traits for command which require sync execution
	 *
	 * @var string[]
	 */
	private $syncTraits = [];

	/**
	 * @param \OCP\BackgroundJob\IJobList $jobList
	 */
	function __construct($jobList) {
		$this->jobList = $jobList;
	}

	/**
	 * Schedule a command to be fired
	 *
	 * @param \OCP\Command\ICommand | callable $command
	 */
	public function push($command) {
		if ($this->canRunAsync($command)) {
			$this->jobList->add($this->getJobClass($command), $this->serializeCommand($command));
		} else {
			$this->runCommand($command);
		}
	}

	/**
	 * Require all commands using a trait to be run synchronous
	 *
	 * @param string $trait
	 */
	public function requireSync($trait) {
		$this->syncTraits[] = trim($trait, '\\');
	}

	/**
	 * @param \OCP\Command\ICommand | callable $command
	 */
	private function runCommand($command) {
		if ($command instanceof ICommand) {
			$command->handle();
		} else {
			$command();
		}
	}

	/**
	 * @param \OCP\Command\ICommand | callable $command
	 * @return string
	 */
	private function getJobClass($command) {
		if ($command instanceof \Closure) {
			return 'OC\Command\ClosureJob';
		} else if (is_callable($command)) {
			return 'OC\Command\CallableJob';
		} else if ($command instanceof ICommand) {
			return 'OC\Command\CommandJob';
		} else {
			throw new \InvalidArgumentException('Invalid command');
		}
	}

	/**
	 * @param \OCP\Command\ICommand | callable $command
	 * @return string
	 */
	private function serializeCommand($command) {
		if ($command instanceof \Closure) {
			$serializer = new Serializer();
			return $serializer->serialize($command);
		} else if (is_callable($command) or $command instanceof ICommand) {
			return serialize($command);
		} else {
			throw new \InvalidArgumentException('Invalid command');
		}
	}

	/**
	 * @param \OCP\Command\ICommand | callable $command
	 * @return bool
	 */
	private function canRunAsync($command) {
		$traits = $this->getTraits($command);
		foreach ($traits as $trait) {
			if (array_search($trait, $this->syncTraits) !== false) {
				return false;
			}
		}
		return true;
	}

	/**
	 * @param \OCP\Command\ICommand | callable $command
	 * @return string[]
	 */
	private function getTraits($command) {
		if ($command instanceof ICommand) {
			return class_uses($command);
		} else {
			return [];
		}
	}
}
