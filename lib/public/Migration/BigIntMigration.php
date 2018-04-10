<?php
/**
 * @copyright Copyright (c) 2017 Joas Schilling <coding@schilljs.com>
 *
 * @author Joas Schilling <coding@schilljs.com>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCP\Migration;

use Doctrine\DBAL\Types\Type;
use OCP\DB\ISchemaWrapper;

/**
 * @since 13.0.0
 */
abstract class BigIntMigration extends SimpleMigrationStep {

	/**
	 * @return array Returns an array with the following structure
	 * ['table1' => ['column1', 'column2'], ...]
	 * @since 13.0.0
	 */
	abstract protected function getColumnsByTable();

	/**
	 * @param IOutput $output
	 * @param \Closure $schemaClosure The `\Closure` returns a `ISchemaWrapper`
	 * @param array $options
	 * @return null|ISchemaWrapper
	 * @since 13.0.0
	 */
	public function changeSchema(IOutput $output, \Closure $schemaClosure, array $options) {
		/** @var ISchemaWrapper $schema */
		$schema = $schemaClosure();

		$tables = $this->getColumnsByTable();

		foreach ($tables as $tableName => $columns) {
			$table = $schema->getTable($tableName);

			foreach ($columns as $columnName) {
				$column = $table->getColumn($columnName);
				if ($column->getType()->getName() !== Type::BIGINT) {
					$column->setType(Type::getType(Type::BIGINT));
					$column->setOptions(['length' => 20]);
				}
			}
		}

		return $schema;
	}
}
