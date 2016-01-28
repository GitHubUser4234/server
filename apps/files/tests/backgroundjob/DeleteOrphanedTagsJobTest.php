<?php
/**
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

namespace OCA\Files\Tests\BackgroundJob;

use OCA\Files\BackgroundJob\DeleteOrphanedTagsJob;
use OCP\DB\QueryBuilder\IQueryBuilder;

/**
 * Class DeleteOrphanedTagsJobTest
 *
 * @group DB
 *
 * @package Test\BackgroundJob
 */
class DeleteOrphanedTagsJobTest extends \Test\TestCase {

	/** @var \OCP\IDBConnection */
	protected $connection;

	protected function setup() {
		parent::setUp();
		$this->connection = \OC::$server->getDatabaseConnection();
	}

	protected function cleanMapping($table) {
		$query = $this->connection->getQueryBuilder();
		$query->delete($table)->execute();
	}

	protected function getMappings($table) {
		$query = $this->connection->getQueryBuilder();
		$query->select('*')
			->from($table);
		$result = $query->execute();
		$mapping = $result->fetchAll();
		$result->closeCursor();

		return $mapping;
	}

	/**
	 * Test clearing orphaned system tag mappings
	 */
	public function testClearSystemTagMappings() {
		$this->cleanMapping('systemtag_object_mapping');

		$query = $this->connection->getQueryBuilder();
		$query->insert('filecache')
			->values([
				'storage' => $query->createNamedParameter(1337, IQueryBuilder::PARAM_INT),
				'path' => $query->createNamedParameter('apps/files/tests/deleteorphanedtagsjobtest.php'),
				'path_hash' => $query->createNamedParameter(md5('apps/files/tests/deleteorphanedtagsjobtest.php')),
			])->execute();
		$fileId = $query->getLastInsertId();

		// Existing file
		$query = $this->connection->getQueryBuilder();
		$query->insert('systemtag_object_mapping')
			->values([
				'objectid' => $query->createNamedParameter($fileId, IQueryBuilder::PARAM_INT),
				'objecttype' => $query->createNamedParameter('files'),
				'systemtagid' => $query->createNamedParameter(1337, IQueryBuilder::PARAM_INT),
			])->execute();

		// Non-existing file
		$query = $this->connection->getQueryBuilder();
		$query->insert('systemtag_object_mapping')
			->values([
				'objectid' => $query->createNamedParameter($fileId + 1, IQueryBuilder::PARAM_INT),
				'objecttype' => $query->createNamedParameter('files'),
				'systemtagid' => $query->createNamedParameter(1337, IQueryBuilder::PARAM_INT),
			])->execute();

		$mapping = $this->getMappings('systemtag_object_mapping');
		$this->assertCount(2, $mapping);

		$job = new DeleteOrphanedTagsJob();
		$this->invokePrivate($job, 'cleanSystemTags');

		$mapping = $this->getMappings('systemtag_object_mapping');
		$this->assertCount(1, $mapping);

		$query = $this->connection->getQueryBuilder();
		$query->delete('filecache')
			->where($query->expr()->eq('fileid', $query->createNamedParameter($fileId, IQueryBuilder::PARAM_INT)))
			->execute();
		$this->cleanMapping('systemtag_object_mapping');
	}

	/**
	 * Test clearing orphaned system tag mappings
	 */
	public function testClearUserTagMappings() {
		$this->cleanMapping('vcategory_to_object');

		$query = $this->connection->getQueryBuilder();
		$query->insert('filecache')
			->values([
				'storage' => $query->createNamedParameter(1337, IQueryBuilder::PARAM_INT),
				'path' => $query->createNamedParameter('apps/files/tests/deleteorphanedtagsjobtest.php'),
				'path_hash' => $query->createNamedParameter(md5('apps/files/tests/deleteorphanedtagsjobtest.php')),
			])->execute();
		$fileId = $query->getLastInsertId();

		// Existing file
		$query = $this->connection->getQueryBuilder();
		$query->insert('vcategory_to_object')
			->values([
				'objid' => $query->createNamedParameter($fileId, IQueryBuilder::PARAM_INT),
				'type' => $query->createNamedParameter('files'),
				'categoryid' => $query->createNamedParameter(1337, IQueryBuilder::PARAM_INT),
			])->execute();

		// Non-existing file
		$query = $this->connection->getQueryBuilder();
		$query->insert('vcategory_to_object')
			->values([
				'objid' => $query->createNamedParameter($fileId + 1, IQueryBuilder::PARAM_INT),
				'type' => $query->createNamedParameter('files'),
				'categoryid' => $query->createNamedParameter(1337, IQueryBuilder::PARAM_INT),
			])->execute();

		$mapping = $this->getMappings('vcategory_to_object');
		$this->assertCount(2, $mapping);

		$job = new DeleteOrphanedTagsJob();
		$this->invokePrivate($job, 'cleanUserTags');

		$mapping = $this->getMappings('vcategory_to_object');
		$this->assertCount(1, $mapping);

		$query = $this->connection->getQueryBuilder();
		$query->delete('filecache')
			->where($query->expr()->eq('fileid', $query->createNamedParameter($fileId, IQueryBuilder::PARAM_INT)))
			->execute();
		$this->cleanMapping('vcategory_to_object');
	}

}
