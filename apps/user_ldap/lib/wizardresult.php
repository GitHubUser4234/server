<?php

/**
 * ownCloud – LDAP Wizard Result
 *
 * @author Arthur Schiwon
 * @copyright 2013 Arthur Schiwon blizzz@owncloud.com
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\user_ldap\lib;

class WizardResult {
	protected $changes = array();

	public function addChange($key, $value) {
		$this->changes[$key] = $value;
	}

	public function hasChanges() {
		return count($this->changes) > 0;
	}

	public function getResultArray() {
		$result = array();
		$result['changes'] = $this->changes;
		return $result;
	}
}