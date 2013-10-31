<?php
 /**
 * ownCloud
 *
 * @author Thomas Müller
 * @copyright 2013 Thomas Müller deepdiver@owncloud.com
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

class Test_OC_OCS_Privatedata extends PHPUnit_Framework_TestCase
{

	private $appKey;

	public function setUp() {
		\OC::$session->set('user_id', 'user1');
		$this->appKey = uniqid('app');
	}

	public function tearDown() {
	}

	public function testGetEmptyOne() {
		$params = array('app' => $this->appKey, 'key' => '123');
		$result = OC_OCS_Privatedata::get($params);
		$this->assertEquals(100, $result->getStatusCode());
		$data = $result->getData();
		$this->assertTrue(is_array($data));
		$this->assertEquals(0, sizeof($data));
	}

	public function testGetEmptyAll() {
		$params = array('app' => $this->appKey);
		$result = OC_OCS_Privatedata::get($params);
		$this->assertEquals(100, $result->getStatusCode());
		$data = $result->getData();
		$this->assertTrue(is_array($data));
		$this->assertEquals(0, sizeof($data));
	}
}
