<?php
/**
 * @author Arthur Schiwon <blizzz@owncloud.com>
 * @author Lukas Reschke <lukas@owncloud.com>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Stephan Peijnik <speijnik@anexia-it.com>
 * @author Thomas Müller <thomas.mueller@tmit.eu>
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

namespace OC\Group;

class MetaData {
	const SORT_NONE = 0;
	const SORT_USERCOUNT = 1; // May have performance issues on LDAP backends
	const SORT_GROUPNAME = 2;

	/**
	 * @var string $user
	 */
	protected $user;

	/**
	 * @var bool $isAdmin
	 */
	protected $isAdmin;

	/**
	 * @var array $metaData
	 */
	protected $metaData = array();

	/**
	 * @var \OCP\IGroupManager $groupManager
	 */
	protected $groupManager;

	/**
	 * @var int $sorting
	 */
	protected $sorting = false;

	/**
	 * @param string $user the uid of the current user
	 * @param bool $isAdmin whether the current users is an admin
	 * @param \OCP\IGroupManager $groupManager
	 */
	public function __construct(
			$user,
			$isAdmin,
			\OCP\IGroupManager $groupManager
			) {
		$this->user = $user;
		$this->isAdmin = (bool)$isAdmin;
		$this->groupManager = $groupManager;
	}

	/**
	 * returns an array with meta data about all available groups
	 * the array is structured as follows:
	 * [0] array containing meta data about admin groups
	 * [1] array containing meta data about unprivileged groups
	 * @param string $groupSearch only effective when instance was created with
	 * isAdmin being true
	 * @param string $userSearch the pattern users are search for
	 * @return array
	 */
	public function get($groupSearch = '', $userSearch = '') {
		$key = $groupSearch . '::' . $userSearch;
		if(isset($this->metaData[$key])) {
			return $this->metaData[$key];
		}

		$adminGroups = array();
		$groups = array();
		$sortGroupsIndex = 0;
		$sortGroupsKeys = array();
		$sortAdminGroupsIndex = 0;
		$sortAdminGroupsKeys = array();

		foreach($this->getGroups($groupSearch) as $group) {
			$groupMetaData = $this->generateGroupMetaData($group, $userSearch);
			if (strtolower($group->getGID()) !== 'admin') {
				$this->addEntry(
					$groups,
					$sortGroupsKeys,
					$sortGroupsIndex,
					$groupMetaData);
			} else {
				//admin group is hard coded to 'admin' for now. In future,
				//backends may define admin groups too. Then the if statement
				//has to be adjusted accordingly.
				$this->addEntry(
					$adminGroups,
					$sortAdminGroupsKeys,
					$sortAdminGroupsIndex,
					$groupMetaData);
			}
		}

		//whether sorting is necessary is will be checked in sort()
		$this->sort($groups, $sortGroupsKeys);
		$this->sort($adminGroups, $sortAdminGroupsKeys);

		$this->metaData[$key] = array($adminGroups, $groups);
		return $this->metaData[$key];
	}

	/**
	 * sets the sort mode, see SORT_* constants for supported modes
	 *
	 * @param int $sortMode
	 */
	public function setSorting($sortMode) {
		switch ($sortMode) {
			case self::SORT_USERCOUNT:
			case self::SORT_GROUPNAME:
				$this->sorting = $sortMode;
				break;

			default:
				$this->sorting = self::SORT_NONE;
		}
	}

	/**
	 * adds an group entry to the resulting array
	 * @param array $entries the resulting array, by reference
	 * @param array $sortKeys the sort key array, by reference
	 * @param int $sortIndex the sort key index, by reference
	 * @param array $data the group's meta data as returned by generateGroupMetaData()
	 */
	private function addEntry(&$entries, &$sortKeys, &$sortIndex, $data) {
		$entries[] = $data;
		if ($this->sorting === self::SORT_USERCOUNT) {
			$sortKeys[$sortIndex] = $data['usercount'];
			$sortIndex++;
		} else if ($this->sorting === self::SORT_GROUPNAME) {
			$sortKeys[$sortIndex] = $data['name'];
			$sortIndex++;
		}
	}

	/**
	 * creates an array containing the group meta data
	 * @param \OCP\IGroup $group
	 * @param string $userSearch
	 * @return array with the keys 'id', 'name' and 'usercount'
	 */
	private function generateGroupMetaData(\OCP\IGroup $group, $userSearch) {
		return array(
				'id' => $group->getGID(),
				'name' => $group->getGID(),
				'usercount' => $this->sorting === self::SORT_USERCOUNT ? $group->count($userSearch) : 0,
			);
	}

	/**
	 * sorts the result array, if applicable
	 * @param array $entries the result array, by reference
	 * @param array $sortKeys the array containing the sort keys
	 * @param return null
	 */
	private function sort(&$entries, $sortKeys) {
		if ($this->sorting === self::SORT_USERCOUNT) {
			array_multisort($sortKeys, SORT_DESC, $entries);
		} else if ($this->sorting === self::SORT_GROUPNAME) {
			array_multisort($sortKeys, SORT_ASC, $entries);
		}
	}

	/**
	 * returns the available groups
	 * @param string $search a search string
	 * @return \OCP\IGroup[]
	 */
	private function getGroups($search = '') {
		if($this->isAdmin) {
			return $this->groupManager->search($search);
		} else {
			// FIXME: Remove static method call
			$groupIds = \OC_SubAdmin::getSubAdminsGroups($this->user);

			/* \OC_SubAdmin::getSubAdminsGroups() returns an array of GIDs, but this
			* method is expected to return an array with the GIDs as keys and group objects as
			* values, so we need to convert this information.
			*/
			$groups = array();
			foreach($groupIds as $gid) {
				$group = $this->groupManager->get($gid);
				if (!is_null($group)) {
					$groups[$gid] = $group;
				}
			}

			return $groups;
		}
	}
}
