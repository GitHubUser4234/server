<?php
/**
 * @author Scrutinizer Auto-Fixer <auto-fixer@scrutinizer-ci.com>
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

namespace OCA\DAV\SystemTag;

use Sabre\DAV\Exception\Forbidden;
use Sabre\DAV\Exception\MethodNotAllowed;
use Sabre\DAV\ICollection;

use OCP\SystemTag\ISystemTagManager;
use OCP\SystemTag\ISystemTagObjectMapper;

/**
 * Collection containing object ids by object type
 */
class SystemTagsObjectTypeCollection implements ICollection {

	/**
	 * @var string
	 */
	private $objectType;

	/**
	 * @var ISystemTagManager
	 */
	private $tagManager;

	/**
	 * @var ISystemTagObjectMapper
	 */
	private $tagMapper;

	/**
	 * Whether to return results only visible for admins
	 *
	 * @var bool
	 */
	private $isAdmin;

	/**
	 * Constructor
	 *
	 * @param string $objectType object type
	 * @param bool $isAdmin whether to return results visible only for admins
	 * @param ISystemTagManager $tagManager
	 * @param ISystemTagObjectMapper $tagMapper
	 */
	public function __construct($objectType, $isAdmin, $tagManager, $tagMapper) {
		$this->tagManager = $tagManager;
		$this->tagMapper = $tagMapper;
		$this->objectType = $objectType;
		$this->isAdmin = $isAdmin;
	}

	/**
	 * @param string $name
	 * @param resource|string $data Initial payload
	 * @throws Forbidden
	 */
	function createFile($name, $data = null) {
		throw new Forbidden('Permission denied to create nodes');
	}

	/**
	 * @param string $name
	 */
	function createDirectory($name) {
		throw new Forbidden('Permission denied to create collections');
	}

	/**
	 * @param string $objectId
	 */
	function getChild($objectId) {
		return new SystemTagsObjectMappingCollection(
			$objectId,
			$this->objectType,
			$this->isAdmin,
			$this->tagManager,
			$this->tagMapper
		);
	}

	function getChildren() {
		// do not list object ids
		throw new MethodNotAllowed();
	}

	/**
	 * @param string $name
	 */
	function childExists($name) {
		return true;
	}

	function delete() {
		throw new Forbidden('Permission denied to delete this collection');
	}

	function getName() {
		return $this->objectType;
	}

	/**
	 * @param string $name
	 */
	function setName($name) {
		throw new Forbidden('Permission denied to rename this collection');
	}

	/**
	 * Returns the last modification time, as a unix timestamp
	 *
	 * @return int
	 */
	function getLastModified() {
		return null;
	}
}
