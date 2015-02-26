<?php

/**
 * ownCloud
 *
 * @author Henrik Kjölhede
 * @copyright 2013 Henrik Kjölhede hkjolhede@gmail.com
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
 */

namespace Test\Files\Storage;

class SFTP_Key extends Storage {
	private $config;

	protected function setUp() {
		parent::setUp();

		$id = $this->getUniqueID();
		$this->config = include('files_external/tests/config.php');
		if ( ! is_array($this->config) or ! isset($this->config['sftp_key']) or ! $this->config['sftp_key']['run']) {
			$this->markTestSkipped('SFTP with key backend not configured');
		}
		$this->config['sftp_key']['root'] .= '/' . $id; //make sure we have an new empty folder to work in
		$this->instance = new \OC\Files\Storage\SFTP_Key($this->config['sftp_key']);
		$this->instance->mkdir('/');
	}

	protected function tearDown() {
		if ($this->instance) {
			$this->instance->rmdir('/');
		}

		parent::tearDown();
	}

	/**
         * @expectedException InvalidArgumentException
         */
        public function testInvalidAddressShouldThrowException() {
		# I'd use example.com for this, but someone decided to break the spec and make it resolve
                $this->instance->assertHostAddressValid('notarealaddress...');
        }

	public function testValidAddressShouldPass() {
                $this->assertTrue($this->instance->assertHostAddressValid('localhost'));
        }

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testNegativePortNumberShouldThrowException() {
		$this->instance->assertPortNumberValid('-1');
	}

	/**
         * @expectedException InvalidArgumentException
         */
        public function testNonNumericalPortNumberShouldThrowException() {
                $this->instance->assertPortNumberValid('a');
        }

	/**
         * @expectedException InvalidArgumentException
         */
        public function testHighPortNumberShouldThrowException() { 
                $this->instance->assertPortNumberValid('65536');
        }

	public function testValidPortNumberShouldPass() {
                $this->assertTrue($this->instance->assertPortNumberValid('22222'));
        }
}
