<?php
/**
 * @author Roeland Jago Douma <roeland@famdouma.nl>
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
namespace OCA\Files_Sharing\Tests;

use OCA\Files_Sharing\Capabilities;
use OCA\Files_Sharing\Tests\TestCase;

/**
 * Class FilesSharingCapabilitiesTest
 */
class FilesSharingCapabilitiesTest extends \Test\TestCase {

	/**
	 * Test for the general part in each return statement and assert.
	 * Strip of the general part on the way.
	 *
	 * @param string[] $data Capabilities
	 * @return string[]
	 */
	function getFilesSharingPart(array $data) {
		$this->assertArrayHasKey('capabilities', $data);
		$this->assertArrayHasKey('files_sharing', $data['capabilities']);
		return $data['capabilities']['files_sharing'];
	}

	/**
	 * Create a mock config object and insert the values in $map tot the getAppValue
	 * function. Then obtain the capabilities and extract the first few
	 * levels in the array
	 *
	 * @param (string[])[] $map Map of arguments to return types for the getAppValue function in the mock
	 * @return string[]
	 */
	function getResults(array $map) {
		$stub = $this->getMockBuilder('\OCP\IConfig')->disableOriginalConstructor()->getMock();
		$stub->method('getAppValue')->will($this->returnValueMap($map));
		$cap = new Capabilities($stub);
		$result = $this->getFilesSharingPart($cap->getCaps()->getData());
		return $result;
	}

	/**
	 * @covers OCA\Files_Sharing\Capabilities::getCaps
	 */
	public function testNoLinkSharing() {
		$map = array(
			array('core', 'shareapi_allow_links', 'yes', 'no'),
		);
		$result = $this->getResults($map);
		$this->assertInternalType('array', $result['public']);
		$this->assertFalse($result['public']['enabled']);
	}

	/**
	 * @covers OCA\Files_Sharing\Capabilities::getCaps
	 */
	public function testOnlyLinkSharing() {
		$map = array(
			array('core', 'shareapi_allow_links', 'yes', 'yes'),
		);
		$result = $this->getResults($map);
		$this->assertInternalType('array', $result['public']);
		$this->assertTrue($result['public']['enabled']);
	}

	/**
	 * @covers OCA\Files_Sharing\Capabilities::getCaps
	 */
	public function testLinkPassword() {
		$map = array(
			array('core', 'shareapi_allow_links', 'yes', 'yes'),
			array('core', 'shareapi_enforce_links_password', 'yes', 'yes'),
		);
		$result = $this->getResults($map);
		$this->assertArrayHasKey('password_enforced', $result['public']);
		$this->assertTrue($result['public']['password_enforced']);
	}

	/**
	 * @covers OCA\Files_Sharing\Capabilities::getCaps
	 */
	public function testLinkNoPassword() {
		$map = array(
			array('core', 'shareapi_allow_links', 'yes', 'yes'),
			array('core', 'shareapi_enforce_links_password', 'yes', 'no'),
		);
		$result = $this->getResults($map);
		$this->assertArrayHasKey('password_enforced', $result['public']);
		$this->assertFalse($result['public']['password_enforced']);
	}

	/**
	 * @covers OCA\Files_Sharing\Capabilities::getCaps
	 */
	public function testLinkNoExpireDate() {
		$map = array(
			array('core', 'shareapi_allow_links', 'yes', 'yes'),
			array('core', 'shareapi_default_expire_date', 'yes', 'no'),
		);
		$result = $this->getResults($map);
		$this->assertArrayHasKey('expire_date', $result['public']);
		$this->assertInternalType('array', $result['public']['expire_date']);
		$this->assertFalse($result['public']['expire_date']['enabled']);
	}

	/**
	 * @covers OCA\Files_Sharing\Capabilities::getCaps
	 */
	public function testLinkExpireDate() {
		$map = array(
			array('core', 'shareapi_allow_links', 'yes', 'yes'),
			array('core', 'shareapi_default_expire_date', 'yes', 'yes'),
			array('core', 'shareapi_expire_after_n_days', '7', '7'),
			array('core', 'shareapi_enforce_expire_date', 'yes', 'no'),
		);
		$result = $this->getResults($map);
		$this->assertArrayHasKey('expire_date', $result['public']);
		$this->assertInternalType('array', $result['public']['expire_date']);
		$this->assertTrue($result['public']['expire_date']['enabled']);
		$this->assertArrayHasKey('days', $result['public']['expire_date']);
		$this->assertFalse($result['public']['expire_date']['enforce']);
	}

	/**
	 * @covers OCA\Files_Sharing\Capabilities::getCaps
	 */
	public function testLinkExpireDateEnforced() {
		$map = array(
			array('core', 'shareapi_allow_links', 'yes', 'yes'),
			array('core', 'shareapi_default_expire_date', 'yes', 'yes'),
			array('core', 'shareapi_enforce_expire_date', 'yes', 'yes'),
		);
		$result = $this->getResults($map);
		$this->assertArrayHasKey('expire_date', $result['public']);
		$this->assertInternalType('array', $result['public']['expire_date']);
		$this->assertTrue($result['public']['expire_date']['enforce']);
	}

	/**
	 * @covers OCA\Files_Sharing\Capabilities::getCaps
	 */
	public function testLinkSendMail() {
		$map = array(
			array('core', 'shareapi_allow_links', 'yes', 'yes'),
			array('core', 'shareapi_allow_public_notification', 'yes', 'yes'),
		);
		$result = $this->getResults($map);
		$this->assertTrue($result['public']['send_mail']);
	}

	/**
	 * @covers OCA\Files_Sharing\Capabilities::getCaps
	 */
	public function testLinkNoSendMail() {
		$map = array(
			array('core', 'shareapi_allow_links', 'yes', 'yes'),
			array('core', 'shareapi_allow_public_notification', 'yes', 'no'),
		);
		$result = $this->getResults($map);
		$this->assertFalse($result['public']['send_mail']);
	}

	/**
	 * @covers OCA\Files_Sharing\Capabilities::getCaps
	 */
	public function testUserSendMail() {
		$map = array(
			array('core', 'shareapi_allow_mail_notification', 'yes', 'yes'),
		);
		$result = $this->getResults($map);
		$this->assertTrue($result['user']['send_mail']);
	}

	/**
	 * @covers OCA\Files_Sharing\Capabilities::getCaps
	 */
	public function testUserNoSendMail() {
		$map = array(
			array('core', 'shareapi_allow_mail_notification', 'yes', 'no'),
		);
		$result = $this->getResults($map);
		$this->assertFalse($result['user']['send_mail']);
	}

	/**
	 * @covers OCA\Files_Sharing\Capabilities::getCaps
	 */
	public function testResharing() {
		$map = array(
			array('core', 'shareapi_allow_resharing', 'yes', 'yes'),
		);
		$result = $this->getResults($map);
		$this->assertTrue($result['resharing']);
	}

	/**
	 * @covers OCA\Files_Sharing\Capabilities::getCaps
	 */
	public function testNoResharing() {
		$map = array(
			array('core', 'shareapi_allow_resharing', 'yes', 'no'),
		);
		$result = $this->getResults($map);
		$this->assertFalse($result['resharing']);
	}
}
