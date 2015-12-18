<?php
/**
 * @author Jörn Friedrich Dreyer <jfd@butonic.de>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Robin Appelman <icewind@owncloud.com>
 * @author Robin McCorkell <rmccorkell@karoshi.org.uk>
 *
 * @copyright Copyright (c) 2015, ownCloud, Inc.
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

namespace OC\BackgroundJob;

use OCP\BackgroundJob\IJobList;
use OCP\AutoloadNotAllowedException;

class JobList implements IJobList {
	/** @var \OCP\IDBConnection */
	protected $connection;

	/**
	 * @var \OCP\IConfig $config
	 */
	protected $config;

	/**
	 * @param \OCP\IDBConnection $connection
	 * @param \OCP\IConfig $config
	 */
	public function __construct($connection, $config) {
		$this->connection = $connection;
		$this->config = $config;
	}

	/**
	 * @param Job|string $job
	 * @param mixed $argument
	 */
	public function add($job, $argument = null) {
		if (!$this->has($job, $argument)) {
			if ($job instanceof Job) {
				$class = get_class($job);
			} else {
				$class = $job;
			}

			$argument = json_encode($argument);
			if (strlen($argument) > 4000) {
				throw new \InvalidArgumentException('Background job arguments can\'t exceed 4000 characters (json encoded)');
			}

			$query = $this->connection->getQueryBuilder();
			$query->insert('jobs')
				->values([
					'class' => $query->createNamedParameter($class),
					'argument' => $query->createNamedParameter($argument),
					'last_run' => $query->createNamedParameter(0, \PDO::PARAM_INT),
				]);
			$query->execute();
		}
	}

	/**
	 * @param Job|string $job
	 * @param mixed $argument
	 */
	public function remove($job, $argument = null) {
		if ($job instanceof Job) {
			$class = get_class($job);
		} else {
			$class = $job;
		}

		$query = $this->connection->getQueryBuilder();
		$query->delete('jobs')
			->where($query->expr()->eq('class', $query->createNamedParameter($class)));
		if (!is_null($argument)) {
			$argument = json_encode($argument);
			$query->andWhere($query->expr()->eq('argument', $query->createNamedParameter($argument)));
		}
		$query->execute();
	}

	/**
	 * @param int $id
	 */
	protected function removeById($id) {
		$query = $this->connection->getQueryBuilder();
		$query->delete('jobs')
			->where($query->expr()->eq('id', $query->createNamedParameter($id, \PDO::PARAM_INT)));
		$query->execute();
	}

	/**
	 * check if a job is in the list
	 *
	 * @param Job|string $job
	 * @param mixed $argument
	 * @return bool
	 */
	public function has($job, $argument) {
		if ($job instanceof Job) {
			$class = get_class($job);
		} else {
			$class = $job;
		}
		$argument = json_encode($argument);

		$query = $this->connection->getQueryBuilder();
		$query->select('id')
			->from('jobs')
			->where($query->expr()->eq('class', $query->createNamedParameter($class)))
			->andWhere($query->expr()->eq('argument', $query->createNamedParameter($argument)))
			->setMaxResults(1);

		$result = $query->execute();
		$row = $result->fetch();
		$result->closeCursor();

		return (bool) $row;
	}

	/**
	 * get all jobs in the list
	 *
	 * @return Job[]
	 */
	public function getAll() {
		$query = $this->connection->getQueryBuilder();
		$query->select('*')
			->from('jobs');
		$result = $query->execute();

		$jobs = [];
		while ($row = $result->fetch()) {
			$job = $this->buildJob($row);
			if ($job) {
				$jobs[] = $job;
			}
		}
		$result->closeCursor();

		return $jobs;
	}

	/**
	 * get the next job in the list
	 *
	 * @return Job
	 */
	public function getNext() {
		$lastId = $this->getLastJob();

		$query = $this->connection->getQueryBuilder();
		$query->select('*')
			->from('jobs')
			->where($query->expr()->gt('id', $query->createNamedParameter($lastId, \PDO::PARAM_INT)))
			->orderBy('id', 'ASC')
			->setMaxResults(1);
		$result = $query->execute();
		$row = $result->fetch();
		$result->closeCursor();

		if ($row) {
			$jobId = $row['id'];
			$job = $this->buildJob($row);
		} else {
			//begin at the start of the queue
			$query = $this->connection->getQueryBuilder();
			$query->select('*')
				->from('jobs')
				->orderBy('id', 'ASC')
				->setMaxResults(1);
			$result = $query->execute();
			$row = $result->fetch();
			$result->closeCursor();

			if ($row) {
				$jobId = $row['id'];
				$job = $this->buildJob($row);
			} else {
				return null; //empty job list
			}
		}

		if (is_null($job)) {
			$this->removeById($jobId);
			return $this->getNext();
		} else {
			return $job;
		}
	}

	/**
	 * @param int $id
	 * @return Job|null
	 */
	public function getById($id) {
		$query = $this->connection->getQueryBuilder();
		$query->select('*')
			->from('jobs')
			->where($query->expr()->eq('id', $query->createNamedParameter($id, \PDO::PARAM_INT)));
		$result = $query->execute();
		$row = $result->fetch();
		$result->closeCursor();

		if ($row) {
			return $this->buildJob($row);
		} else {
			return null;
		}
	}

	/**
	 * get the job object from a row in the db
	 *
	 * @param array $row
	 * @return Job
	 */
	private function buildJob($row) {
		$class = $row['class'];
		/**
		 * @var Job $job
		 */
		try {
			if (!class_exists($class)) {
				// job from disabled app or old version of an app, no need to do anything
				return null;
			}
			$job = new $class();
			$job->setId($row['id']);
			$job->setLastRun($row['last_run']);
			$job->setArgument(json_decode($row['argument'], true));
			return $job;
		} catch (AutoloadNotAllowedException $e) {
			// job is from a disabled app, ignore
		}
		return null;
	}

	/**
	 * set the job that was last ran
	 *
	 * @param Job $job
	 */
	public function setLastJob($job) {
		$this->config->setAppValue('backgroundjob', 'lastjob', $job->getId());
	}

	/**
	 * get the id of the last ran job
	 *
	 * @return string
	 */
	public function getLastJob() {
		return $this->config->getAppValue('backgroundjob', 'lastjob', 0);
	}

	/**
	 * set the lastRun of $job to now
	 *
	 * @param Job $job
	 */
	public function setLastRun($job) {
		$query = $this->connection->getQueryBuilder();
		$query->update('jobs')
			->set('last_run', $query->createNamedParameter(time(), \PDO::PARAM_INT))
			->where($query->expr()->eq('id', $query->createNamedParameter($job->getId(), \PDO::PARAM_INT)));
		$query->execute();
	}
}
