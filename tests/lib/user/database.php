<?php
/**
* ownCloud
*
* @author Robin Appelman
* @copyright 2012 Robin Appelman icewind@owncloud.com
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

/**
 * Class Test_User_Database
 *
 * @group DB
 */
class Test_User_Database extends Test_User_Backend {
	/** @var array */
	private $users;

	public function getUser() {
		$user = parent::getUser();
		$this->users[]=$user;
		return $user;
	}

	protected function setUp() {
		parent::setUp();
		$this->backend=new \OC\User\Database();
	}

	protected function tearDown() {
		if(!isset($this->users)) {
			return;
		}
		foreach($this->users as $user) {
			$this->backend->deleteUser($user);
		}
		parent::tearDown();
	}
}
