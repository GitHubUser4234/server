<?php
/**
* ownCloud
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

namespace OCA\user_ldap\tests;

use \OCA\user_ldap\USER_LDAP as UserLDAP;
use \OCA\user_ldap\lib\Access;
use \OCA\user_ldap\lib\Connection;
use \OCA\user_ldap\lib\ILDAPWrapper;

class Test_User_Ldap_Direct extends \PHPUnit_Framework_TestCase {
	protected $backend;

	public function setUp() {
		\OC_User::clearBackends();
		\OC_Group::clearBackends();
	}

	private function getAccessMock() {
		static $conMethods;
		static $accMethods;

		if(is_null($conMethods) || is_null($accMethods)) {
			$conMethods = get_class_methods('\OCA\user_ldap\lib\Connection');
			$accMethods = get_class_methods('\OCA\user_ldap\lib\Access');
		}
		$lw  = $this->getMock('\OCA\user_ldap\lib\ILDAPWrapper');
		$connector = $this->getMock('\OCA\user_ldap\lib\Connection',
									$conMethods,
									array($lw, null, null));
		$access = $this->getMock('\OCA\user_ldap\lib\Access',
								 $accMethods,
								 array($connector, $lw));

		return $access;
	}

	private function prepareMockForUserExists(&$access) {
		$access->expects($this->any())
			   ->method('username2dn')
			   ->will($this->returnCallback(function($uid) {
					switch ($uid) {
						case 'gunslinger':
							return 'dnOfRoland';
							break;
						case 'formerUser':
							return 'dnOfFormerUser';
							break;
						case 'newyorker':
							return 'dnOfNewYorker';
							break;
						case 'ladyofshadows':
							return 'dnOfLadyOfShadows';
							break;
						defautl:
							return false;
					}
			   }));


	}

	public function testCheckPassword() {
		$access = $this->getAccessMock();
		$backend = new UserLDAP($access);
		\OC_User::useBackend($backend);

		$access->connection->expects($this->any())
			   ->method('__get')
			   ->will($this->returnCallback(function($name) {
					if($name === 'ldapLoginFilter') {
						return '%uid';
					}
					return null;
			   }));

		$access->expects($this->any())
			   ->method('fetchListOfUsers')
			   ->will($this->returnCallback(function($filter) {
					if($filter === 'roland') {
						return array('dnOfRoland');
					}
					return array();
			   }));

		$access->expects($this->any())
			   ->method('dn2username')
			   ->with($this->equalTo('dnOfRoland'))
			   ->will($this->returnValue('gunslinger'));

		$access->expects($this->any())
			   ->method('areCredentialsValid')
			   ->will($this->returnCallback(function($dn, $pwd) {
					if($pwd === 'dt19') {
						return true;
					}
					return false;
			   }));

		$result = $backend->checkPassword('roland', 'dt19');
		$this->assertEquals('gunslinger', $result);

		$result = $backend->checkPassword('roland', 'wrong');
		$this->assertFalse($result);

		$result = $backend->checkPassword('mallory', 'evil');
		$this->assertFalse($result);
	}

	public function testGetUsers() {
		$access = $this->getAccessMock();
		$backend = new UserLDAP($access);

		$access->expects($this->any())
			   ->method('getFilterPartForUserSearch')
			   ->will($this->returnCallback(function($search) {
					return $search;
			   }));

		$access->expects($this->any())
			   ->method('combineFilterWithAnd')
			   ->will($this->returnCallback(function($param) {
					return $param[1];
			   }));

		$access->expects($this->any())
			   ->method('fetchListOfUsers')
			   ->will($this->returnCallback(function($search, $a, $l, $o) {
					$users = array('gunslinger', 'newyorker', 'ladyofshadows');
					if(empty($search)) {
						$result = $users;
					} else {
						$result = array();
						foreach($users as $user) {
							if(stripos($user,  $search) !== false) {
								$result[] = $user;
							}
						}
					}
					if(!is_null($l) || !is_null($o)) {
						$result = array_slice($result, $o, $l);
					}
					return $result;
			   }));

		$access->expects($this->any())
			   ->method('ownCloudUserNames')
			   ->will($this->returnArgument(0));

		$result = $backend->getUsers();
		$this->assertEquals(3, count($result));

		$result = $backend->getUsers('', 1, 2);
		$this->assertEquals(1, count($result));

		$result = $backend->getUsers('', 2, 1);
		$this->assertEquals(2, count($result));

		$result = $backend->getUsers('yo');
		$this->assertEquals(2, count($result));

		$result = $backend->getUsers('nix');
		$this->assertEquals(0, count($result));
	}

	public function testUserExists() {
		$access = $this->getAccessMock();
		$backend = new UserLDAP($access);
		$this->prepareMockForUserExists($access);

		$access->expects($this->any())
			   ->method('readAttribute')
			   ->will($this->returnCallback(function($dn) {
					if($dn === 'dnOfRoland') {
						return array();
					}
					return false;
			   }));

		//test for existing user
		$result = $backend->userExists('gunslinger');
		$this->assertTrue($result);

		//test for deleted user
		$result = $backend->userExists('formerUser');
		$this->assertFalse($result);

		//test for never-existing user
		$result = $backend->userExists('mallory');
		$this->assertFalse($result);
	}

	public function testDeleteUser() {
		$access = $this->getAccessMock();
		$backend = new UserLDAP($access);

		//we do not support deleting users at all
		$result = $backend->deleteUser('gunslinger');
		$this->assertFalse($result);
	}

	public function testGetHome() {
		$access = $this->getAccessMock();
		$backend = new UserLDAP($access);
		$this->prepareMockForUserExists($access);

		$access->connection->expects($this->any())
			   ->method('__get')
			   ->will($this->returnCallback(function($name) {
					if($name === 'homeFolderNamingRule') {
						return 'attr:testAttribute';
					}
					return null;
			   }));

		$access->expects($this->any())
			   ->method('readAttribute')
			   ->will($this->returnCallback(function($dn, $attr) {
					switch ($dn) {
						case 'dnOfRoland':
							if($attr === 'testAttribute') {
								return array('/tmp/rolandshome/');
							}
							return array();
							break;
						case 'dnOfLadyOfShadows':
							if($attr === 'testAttribute') {
								return array('susannah/');
							}
							return array();
							break;
						default:
							return false;
				   }
			   }));

		//absolut path
		$result = $backend->getHome('gunslinger');
		$this->assertEquals('/tmp/rolandshome/', $result);

		//datadir-relativ path
		$result = $backend->getHome('ladyofshadows');
		$datadir = \OCP\Config::getSystemValue('datadirectory',
											   \OC::$SERVERROOT.'/data');
		$this->assertEquals($datadir.'/susannah/', $result);

		//no path at all – triggers OC default behaviour
		$result = $backend->getHome('newyorker');
		$this->assertFalse($result);
	}

	public function testGetDisplayName() {
		$access = $this->getAccessMock();
		$backend = new UserLDAP($access);
		$this->prepareMockForUserExists($access);

		$access->connection->expects($this->any())
			   ->method('__get')
			   ->will($this->returnCallback(function($name) {
					if($name === 'ldapUserDisplayName') {
						return 'displayname';
					}
					return null;
			   }));

		$access->expects($this->any())
			   ->method('readAttribute')
			   ->will($this->returnCallback(function($dn, $attr) {
					switch ($dn) {
						case 'dnOfRoland':
							if($attr === 'displayname') {
								return array('Roland Deschain');
							}
							return array();
							break;

						default:
							return false;
				   }
			   }));

		//with displayName
		$result = $backend->getDisplayName('gunslinger');
		$this->assertEquals('Roland Deschain', $result);

		//empty displayname retrieved
		$result = $backend->getDisplayName('newyorker');
		$this->assertEquals(null, $result);
	}

	//no test for getDisplayNames, because it just invokes getUsers and
	//getDisplayName

}