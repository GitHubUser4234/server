<?php
/**
 * Copyright (c) 2014 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OC\DB;

use \Doctrine\DBAL\DBALException;
use \Doctrine\DBAL\Schema\Index;
use \Doctrine\DBAL\Schema\Table;
use \Doctrine\DBAL\Schema\Schema;
use \Doctrine\DBAL\Schema\SchemaConfig;
use \Doctrine\DBAL\Schema\Comparator;

class Migrator {
	/**
	 * @var \Doctrine\DBAL\Connection $connection
	 */
	protected $connection;

	/**
	 * @param \Doctrine\DBAL\Connection $connection
	 */
	public function __construct(\Doctrine\DBAL\Connection $connection) {
		$this->connection = $connection;
	}

	/**
	 * @param \Doctrine\DBAL\Schema\Schema $targetSchema
	 */
	public function migrate(Schema $targetSchema) {
		$this->applySchema($targetSchema);
	}

	/**
	 * @param Schema $targetSchema
	 * @throws \OC\DB\MigrationException
	 */
	public function checkMigrate(Schema $targetSchema) {
		/**
		 * @var \Doctrine\DBAL\Schema\Table[] $tables
		 */
		$tables = $targetSchema->getTables();

		$existingTables = $this->connection->getSchemaManager()->listTableNames();

		foreach ($tables as $table) {
			if (strpos($table->getName(), '.')) {
				list(, $tableName) = explode('.', $table->getName());
			} else {
				$tableName = $table->getName();
			}
			// don't need to check for new tables
			if (array_search($tableName, $existingTables) !== false) {
				$this->checkTableMigrate($table);
			}
		}
	}

	/**
	 * Check the migration of a table on a copy so we can detect errors before messing with the real table
	 *
	 * @param \Doctrine\DBAL\Schema\Table $table
	 * @throws \OC\DB\MigrationException
	 */
	protected function checkTableMigrate(Table $table) {
		$name = $table->getName();
		$tmpName = 'oc_' . uniqid();

		$this->copyTable($name, $tmpName);

		//create the migration schema for the temporary table
		$tmpTable = $this->renameTableSchema($table, $tmpName);
		$schemaConfig = new SchemaConfig();
		$schemaConfig->setName($this->connection->getDatabase());
		$schema = new Schema(array($tmpTable), array(), $schemaConfig);

		try {
			$this->applySchema($schema);
			$this->dropTable($tmpName);
		} catch (DBALException $e) {
			// pgsql needs to commit it's failed transaction before doing anything else
			$this->connection->commit();
			$this->dropTable($tmpName);
			throw new MigrationException($table->getName(), $e->getMessage());
		}
	}

	/**
	 * @param \Doctrine\DBAL\Schema\Table $table
	 * @param string $newName
	 * @return \Doctrine\DBAL\Schema\Table
	 */
	protected function renameTableSchema(Table $table, $newName) {
		/**
		 * @var \Doctrine\DBAL\Schema\Index[] $indexes
		 */
		$indexes = $table->getIndexes();
		$newIndexes = array();
		foreach ($indexes as $index) {
			$indexName = 'oc_' . uniqid(); // avoid conflicts in index names
			$newIndexes[] = new Index($indexName, $index->getColumns(), $index->isUnique(), $index->isPrimary());
		}

		// foreign keys are not supported so we just set it to an empty array
		return new Table($newName, $table->getColumns(), $newIndexes, array(), 0, $table->getOptions());
	}

	/**
	 * @param \Doctrine\DBAL\Schema\Schema $targetSchema
	 * @param \Doctrine\DBAL\Connection $connection
	 */
	protected function applySchema(Schema $targetSchema, \Doctrine\DBAL\Connection $connection = null) {
		if (is_null($connection)) {
			$connection = $this->connection;
		}

		$sourceSchema = $this->connection->getSchemaManager()->createSchema();

		// remove tables we don't know about
		/** @var $table \Doctrine\DBAL\Schema\Table */
		foreach ($sourceSchema->getTables() as $table) {
			if (!$targetSchema->hasTable($table->getName())) {
				$sourceSchema->dropTable($table->getName());
			}
		}
		// remove sequences we don't know about
		foreach ($sourceSchema->getSequences() as $table) {
			if (!$targetSchema->hasSequence($table->getName())) {
				$sourceSchema->dropSequence($table->getName());
			}
		}

		$comparator = new Comparator();
		$schemaDiff = $comparator->compare($sourceSchema, $targetSchema);

		foreach ($schemaDiff->changedTables as $tableDiff) {
			$tableDiff->name = $this->connection->quoteIdentifier($tableDiff->name);
		}

		$connection->beginTransaction();
		foreach ($schemaDiff->toSql($connection->getDatabasePlatform()) as $sql) {
			$connection->query($sql);
		}
		$connection->commit();
	}

	/**
	 * @param string $sourceName
	 * @param string $targetName
	 */
	protected function copyTable($sourceName, $targetName) {
		$quotedSource = $this->connection->quoteIdentifier($sourceName);
		$quotedTarget = $this->connection->quoteIdentifier($targetName);

		$this->connection->exec('CREATE TABLE ' . $quotedTarget . ' (LIKE ' . $quotedSource . ')');
		$this->connection->exec('INSERT INTO ' . $quotedTarget . ' SELECT * FROM ' . $quotedSource);
	}

	/**
	 * @param string $name
	 */
	protected function dropTable($name) {
		$this->connection->exec('DROP TABLE ' . $this->connection->quoteIdentifier($name));
	}
}
