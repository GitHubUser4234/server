<?php
/**
 * @author Thomas Müller <thomas.mueller@tmit.eu>
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

namespace OCA\DAV\Tests\Unit\CardDAV;

use OCA\DAV\CardDAV\AddressBook;
use OCA\DAV\CardDAV\CardDavBackend;
use Sabre\DAV\PropPatch;
use Test\TestCase;

class AddressBookTest extends TestCase {

	public function testDelete() {
		/** @var \PHPUnit_Framework_MockObject_MockObject | CardDavBackend $backend */
		$backend = $this->getMockBuilder('OCA\DAV\CardDAV\CardDavBackend')->disableOriginalConstructor()->getMock();
		$backend->expects($this->once())->method('updateShares');
		$backend->expects($this->any())->method('getShares')->willReturn([
			['href' => 'principal:user2']
		]);
		$calendarInfo = [
			'{http://owncloud.org/ns}owner-principal' => 'user1',
			'principaluri' => 'user2',
			'id' => 666
		];
		$c = new AddressBook($backend, $calendarInfo);
		$c->delete();
	}

	/**
	 * @expectedException \Sabre\DAV\Exception\Forbidden
	 */
	public function testDeleteFromGroup() {
		/** @var \PHPUnit_Framework_MockObject_MockObject | CardDavBackend $backend */
		$backend = $this->getMockBuilder('OCA\DAV\CardDAV\CardDavBackend')->disableOriginalConstructor()->getMock();
		$backend->expects($this->never())->method('updateShares');
		$backend->expects($this->any())->method('getShares')->willReturn([
			['href' => 'principal:group2']
		]);
		$calendarInfo = [
			'{http://owncloud.org/ns}owner-principal' => 'user1',
			'principaluri' => 'user2',
			'id' => 666
		];
		$c = new AddressBook($backend, $calendarInfo);
		$c->delete();
	}

	/**
	 * @expectedException \Sabre\DAV\Exception\Forbidden
	 */
	public function testPropPatch() {
		/** @var \PHPUnit_Framework_MockObject_MockObject | CardDavBackend $backend */
		$backend = $this->getMockBuilder('OCA\DAV\CardDAV\CardDavBackend')->disableOriginalConstructor()->getMock();
		$calendarInfo = [
			'{http://owncloud.org/ns}owner-principal' => 'user1',
			'principaluri' => 'user2',
			'id' => 666
		];
		$c = new AddressBook($backend, $calendarInfo);
		$c->propPatch(new PropPatch([]));
	}

	/**
	 * @dataProvider providesReadOnlyInfo
	 */
	public function testAcl($expectsWrite, $readOnlyValue, $hasOwnerSet) {
		/** @var \PHPUnit_Framework_MockObject_MockObject | CardDavBackend $backend */
		$backend = $this->getMockBuilder('OCA\DAV\CardDAV\CardDavBackend')->disableOriginalConstructor()->getMock();
		$backend->expects($this->any())->method('applyShareAcl')->willReturnArgument(1);
		$calendarInfo = [
			'principaluri' => 'user2',
			'id' => 666,
			'uri' => 'default'
		];
		if (!is_null($readOnlyValue)) {
			$calendarInfo['{http://owncloud.org/ns}read-only'] = $readOnlyValue;
		}
		if ($hasOwnerSet) {
			$calendarInfo['{http://owncloud.org/ns}owner-principal'] = 'user1';
		}
		$c = new AddressBook($backend, $calendarInfo);
		$acl = $c->getACL();
		$childAcl = $c->getChildACL();

		$expectedAcl = [[
			'privilege' => '{DAV:}read',
			'principal' => $hasOwnerSet ? 'user1' : 'user2',
			'protected' => true
		], [
			'privilege' => '{DAV:}write',
			'principal' => $hasOwnerSet ? 'user1' : 'user2',
			'protected' => true
		]];
		if ($hasOwnerSet) {
			$expectedAcl[] = [
				'privilege' => '{DAV:}read',
				'principal' => 'user2',
				'protected' => true
			];
			if ($expectsWrite) {
				$expectedAcl[] = [
					'privilege' => '{DAV:}write',
					'principal' => 'user2',
					'protected' => true
				];
			}
		}
		$this->assertEquals($expectedAcl, $acl);
		$this->assertEquals($expectedAcl, $childAcl);
	}

	public function providesReadOnlyInfo() {
		return [
			'read-only property not set' => [true, null, true],
			'read-only property is false' => [true, false, true],
			'read-only property is true' => [false, true, true],
			'read-only property not set and no owner' => [true, null, false],
			'read-only property is false and no owner' => [true, false, false],
			'read-only property is true and no owner' => [false, true, false],
		];
	}}
