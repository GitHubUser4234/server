<?php
/**
 * @author Arthur Schiwon <blizzz@owncloud.com>
 * @author Georg Ehrke <georg@owncloud.com>
 * @author Joas Schilling <nickvergessen@owncloud.com>
 * @author Lukas Reschke <lukas@owncloud.com>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Robin Appelman <icewind@owncloud.com>
 * @author Thomas Müller <thomas.mueller@tmit.eu>
 * @author Vincent Petry <pvince81@owncloud.com>
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

namespace OC;

use OC\Hooks\BasicEmitter;
use OC\Hooks\Emitter;
use OC\Repair\AssetCache;
use OC\Repair\CleanTags;
use OC\Repair\Collation;
use OC\Repair\DropOldJobs;
use OC\Repair\OldGroupMembershipShares;
use OC\Repair\RemoveGetETagEntries;
use OC\Repair\SharePropagation;
use OC\Repair\SqliteAutoincrement;
use OC\Repair\DropOldTables;
use OC\Repair\FillETags;
use OC\Repair\InnoDB;
use OC\Repair\RepairLegacyStorages;
use OC\Repair\RepairMimeTypes;
use OC\Repair\SearchLuceneTables;
use OC\Repair\UpdateOutdatedOcsIds;
use OC\Repair\RepairInvalidShares;
use OCP\Migration\IOutput;
use OCP\Migration\IRepairStep;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\GenericEvent;

class Repair extends BasicEmitter implements IOutput{
	/* @var IRepairStep[] */
	private $repairSteps;
	/** @var EventDispatcher */
	private $dispatcher;

	/**
	 * Creates a new repair step runner
	 *
	 * @param IRepairStep[] $repairSteps array of RepairStep instances
	 * @param EventDispatcher $dispatcher
	 */
	public function __construct($repairSteps = [], EventDispatcher $dispatcher = null) {
		$this->repairSteps = $repairSteps;
		$this->dispatcher = $dispatcher;
	}

	/**
	 * Run a series of repair steps for common problems
	 */
	public function run() {
		$self = $this;
		if (count($this->repairSteps) === 0) {
			$this->emit('\OC\Repair', 'info', array('No repair steps available'));
			return;
		}
		// run each repair step
		foreach ($this->repairSteps as $step) {
			$this->emit('\OC\Repair', 'step', array($step->getName()));

			if ($step instanceof Emitter) {
				$step->listen('\OC\Repair', 'warning', function ($description) use ($self) {
					$self->emit('\OC\Repair', 'warning', array($description));
				});
				$step->listen('\OC\Repair', 'info', function ($description) use ($self) {
					$self->emit('\OC\Repair', 'info', array($description));
				});
			}

			$step->run($this);
		}
	}

	/**
	 * Add repair step
	 *
	 * @param IRepairStep|string $repairStep repair step
	 * @throws \Exception
	 */
	public function addStep($repairStep) {
		if (is_string($repairStep)) {
			if (class_exists($repairStep)) {
				$s = new $repairStep();
				if ($s instanceof IRepairStep) {
					$this->repairSteps[] = $s;
				} else {
					throw new \Exception("Repair step '$repairStep' is not of type \\OCP\\Migration\\IRepairStep");
				}
			} else {
				throw new \Exception("Repair step '$repairStep' is unknown");
			}
		} else {
			$this->repairSteps[] = $repairStep;
		}
	}

	/**
	 * Returns the default repair steps to be run on the
	 * command line or after an upgrade.
	 *
	 * @return IRepairStep[]
	 */
	public static function getRepairSteps() {
		return [
			new RepairMimeTypes(\OC::$server->getConfig()),
			new RepairLegacyStorages(\OC::$server->getConfig(), \OC::$server->getDatabaseConnection()),
			new AssetCache(),
			new FillETags(\OC::$server->getDatabaseConnection()),
			new CleanTags(\OC::$server->getDatabaseConnection()),
			new DropOldTables(\OC::$server->getDatabaseConnection()),
			new DropOldJobs(\OC::$server->getJobList()),
			new RemoveGetETagEntries(\OC::$server->getDatabaseConnection()),
			new UpdateOutdatedOcsIds(\OC::$server->getConfig()),
			new RepairInvalidShares(\OC::$server->getConfig(), \OC::$server->getDatabaseConnection()),
			new SharePropagation(\OC::$server->getConfig()),
		];
	}

	/**
	 * Returns expensive repair steps to be run on the
	 * command line with a special option.
	 *
	 * @return IRepairStep[]
	 */
	public static function getExpensiveRepairSteps() {
		return [
			new OldGroupMembershipShares(\OC::$server->getDatabaseConnection(), \OC::$server->getGroupManager()),
		];
	}

	/**
	 * Returns the repair steps to be run before an
	 * upgrade.
	 *
	 * @return IRepairStep[]
	 */
	public static function getBeforeUpgradeRepairSteps() {
		$connection = \OC::$server->getDatabaseConnection();
		$steps = [
			new InnoDB(),
			new Collation(\OC::$server->getConfig(), $connection),
			new SqliteAutoincrement($connection),
			new SearchLuceneTables(),
		];

		//There is no need to delete all previews on every single update
		//only 7.0.0 through 7.0.2 generated broken previews
		$currentVersion = \OC::$server->getConfig()->getSystemValue('version');
		if (version_compare($currentVersion, '7.0.0.0', '>=') &&
			version_compare($currentVersion, '7.0.3.4', '<=')) {
			$steps[] = new \OC\Repair\Preview();
		}

		return $steps;
	}

	/**
	 * {@inheritDoc}
	 */
	public function emit($scope, $method, array $arguments = []) {
		parent::emit($scope, $method, $arguments);
		if (!is_null($this->dispatcher)) {
			$this->dispatcher->dispatch("$scope::$method",
				new GenericEvent("$scope::$method", $arguments));
		}
	}

	public function info($string) {
		// for now just emit as we did in the past
		$this->emit('\OC\Repair', 'info', array($string));
	}

	/**
	 * @param string $message
	 */
	public function warning($message) {
		// for now just emit as we did in the past
		$this->emit('\OC\Repair', 'warning', [$message]);
	}

	/**
	 * @param int $max
	 */
	public function startProgress($max = 0) {
		// for now just emit as we did in the past
		$this->emit('\OC\Repair', 'startProgress', [$max]);
	}

	/**
	 * @param int $step
	 */
	public function advance($step = 1) {
		// for now just emit as we did in the past
		$this->emit('\OC\Repair', 'advance', [$step]);
	}

	/**
	 * @param int $max
	 */
	public function finishProgress() {
		// for now just emit as we did in the past
		$this->emit('\OC\Repair', 'finishProgress', []);
	}
}
