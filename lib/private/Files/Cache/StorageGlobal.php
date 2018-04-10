<?php
/**
 * @copyright Robin Appelman <robin@icewind.nl>
 *
 * @author Robin Appelman <robin@icewind.nl>
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

namespace OC\Files\Cache;

use OCP\DB\QueryBuilder\IQueryBuilder;
use OCP\IDBConnection;

/**
 * Handle the mapping between the string and numeric storage ids
 *
 * Each storage has 2 different ids
 *    a string id which is generated by the storage backend and reflects the configuration of the storage (e.g. 'smb://user@host/share')
 *    and a numeric storage id which is referenced in the file cache
 *
 * A mapping between the two storage ids is stored in the database and accessible trough this class
 *
 * @package OC\Files\Cache
 */
class StorageGlobal {
	/** @var IDBConnection */
	private $connection;

	/** @var array[] */
	private $cache = [];

	public function __construct(IDBConnection $connection) {
		$this->connection = $connection;
	}

	/**
	 * @param string[] $storageIds
	 */
	public function loadForStorageIds(array $storageIds) {
		$builder = $this->connection->getQueryBuilder();
		$query = $builder->select(['id', 'numeric_id', 'available', 'last_checked'])
			->from('storages')
			->where($builder->expr()->in('id', $builder->createNamedParameter(array_values($storageIds), IQueryBuilder::PARAM_STR_ARRAY)));

		$result = $query->execute();
		while ($row = $result->fetch()) {
			$this->cache[$row['id']] = $row;
		}
	}

	/**
	 * @param string $storageId
	 * @return array|null
	 */
	public function getStorageInfo($storageId) {
		if (!isset($this->cache[$storageId])) {
			$this->loadForStorageIds([$storageId]);
		}
		return isset($this->cache[$storageId]) ? $this->cache[$storageId] : null;
	}

	public function clearCache() {
		$this->cache = [];
	}
}
