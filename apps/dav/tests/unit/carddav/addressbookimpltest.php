<?php
/**
 * @author Björn Schießle <schiessle@owncloud.com>
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
use OCA\DAV\CardDAV\AddressBookImpl;
use OCA\DAV\CardDAV\CardDavBackend;
use Sabre\VObject\Component\VCard;
use Sabre\VObject\Property\Text;
use Test\TestCase;

class AddressBookImplTest extends TestCase {

	/** @var AddressBookImpl  */
	private $addressBookImpl;

	/** @var  array */
	private $addressBookInfo;

	/** @var  AddressBook | \PHPUnit_Framework_MockObject_MockObject */
	private $addressBook;

	/** @var  CardDavBackend | \PHPUnit_Framework_MockObject_MockObject */
	private $backend;

	/** @var  VCard | \PHPUnit_Framework_MockObject_MockObject */
	private $vCard;

	public function setUp() {
		parent::setUp();

		$this->addressBookInfo = [
			'id' => 42,
			'{DAV:}displayname' => 'display name'
		];
		$this->addressBook = $this->getMockBuilder('OCA\DAV\CardDAV\AddressBook')
			->disableOriginalConstructor()->getMock();
		$this->backend = $this->getMockBuilder('\OCA\DAV\CardDAV\CardDavBackend')
			->disableOriginalConstructor()->getMock();
		$this->vCard = $this->getMock('Sabre\VObject\Component\VCard');

		$this->addressBookImpl = new AddressBookImpl(
			$this->addressBook,
			$this->addressBookInfo,
			$this->backend
		);
	}

	public function testGetKey() {
		$this->assertSame($this->addressBookInfo['id'],
			$this->addressBookImpl->getKey());
	}

	public function testGetDisplayName() {
		$this->assertSame($this->addressBookInfo['{DAV:}displayname'],
			$this->addressBookImpl->getDisplayName());
	}

	public function testSearch() {

		/** @var \PHPUnit_Framework_MockObject_MockObject | AddressBookImpl $addressBookImpl */
		$addressBookImpl = $this->getMockBuilder('OCA\DAV\CardDAV\AddressBookImpl')
			->setConstructorArgs(
				[
					$this->addressBook,
					$this->addressBookInfo,
					$this->backend
				]
			)
			->setMethods(['vCard2Array', 'readCard'])
			->getMock();

		$pattern = 'pattern';
		$searchProperties = 'properties';

		$this->backend->expects($this->once())->method('search')
			->with($this->addressBookInfo['id'], $pattern, $searchProperties)
			->willReturn(
				[
					'cardData1',
					'cardData2'
				]
			);

		$addressBookImpl->expects($this->exactly(2))->method('readCard')
			->willReturn($this->vCard);
		$addressBookImpl->expects($this->exactly(2))->method('vCard2Array')
			->with($this->vCard)->willReturn('vCard');

		$result = $addressBookImpl->search($pattern, $searchProperties, []);
		$this->assertTrue((is_array($result)));
		$this->assertSame(2, count($result));
	}

	/**
	 * @dataProvider dataTestCreate
	 *
	 * @param array $properties
	 */
	public function testCreate($properties) {

		$uid = 'uid';

		/** @var \PHPUnit_Framework_MockObject_MockObject | AddressBookImpl $addressBookImpl */
		$addressBookImpl = $this->getMockBuilder('OCA\DAV\CardDAV\AddressBookImpl')
			->setConstructorArgs(
				[
					$this->addressBook,
					$this->addressBookInfo,
					$this->backend
				]
			)
			->setMethods(['vCard2Array', 'createUid', 'createEmptyVCard'])
			->getMock();

		$addressBookImpl->expects($this->once())->method('createUid')
			->willReturn($uid);
		$addressBookImpl->expects($this->once())->method('createEmptyVCard')
			->with($uid)->willReturn($this->vCard);
		$this->vCard->expects($this->exactly(count($properties)))
			->method('createProperty');
		$this->backend->expects($this->once())->method('createCard');
		$this->backend->expects($this->never())->method('updateCard');
		$this->backend->expects($this->never())->method('getCard');
		$addressBookImpl->expects($this->once())->method('vCard2Array')
			->with($this->vCard)->willReturn(true);

		$this->assertTrue($addressBookImpl->createOrUpdate($properties));
	}

	public function dataTestCreate() {
		return [
			[[]],
			[['FN' => 'John Doe']]
		];
	}

	public function testUpdate() {

		$uid = 'uid';
		$properties = ['UID' => $uid, 'FN' => 'John Doe'];

		/** @var \PHPUnit_Framework_MockObject_MockObject | AddressBookImpl $addressBookImpl */
		$addressBookImpl = $this->getMockBuilder('OCA\DAV\CardDAV\AddressBookImpl')
			->setConstructorArgs(
				[
					$this->addressBook,
					$this->addressBookInfo,
					$this->backend
				]
			)
			->setMethods(['vCard2Array', 'createUid', 'createEmptyVCard', 'readCard'])
			->getMock();

		$addressBookImpl->expects($this->never())->method('createUid');
		$addressBookImpl->expects($this->never())->method('createEmptyVCard');
		$this->backend->expects($this->once())->method('getCard')
			->with($this->addressBookInfo['id'], $uid . '.vcf')
			->willReturn(['carddata' => 'data']);
		$addressBookImpl->expects($this->once())->method('readCard')
			->with('data')->willReturn($this->vCard);
		$this->vCard->expects($this->exactly(count($properties)))
			->method('createProperty');
		$this->backend->expects($this->never())->method('createCard');
		$this->backend->expects($this->once())->method('updateCard');
		$addressBookImpl->expects($this->once())->method('vCard2Array')
			->with($this->vCard)->willReturn(true);

		$this->assertTrue($addressBookImpl->createOrUpdate($properties));
	}

	/**
	 * @dataProvider dataTestGetPermissions
	 *
	 * @param array $permissions
	 * @param int $expected
	 */
	public function testGetPermissions($permissions, $expected) {
		$this->addressBook->expects($this->once())->method('getACL')
			->willReturn($permissions);

		$this->assertSame($expected,
			$this->addressBookImpl->getPermissions()
		);
	}

	public function dataTestGetPermissions() {
		return [
			[[], 0],
			[[['privilege' => '{DAV:}read']], 1],
			[[['privilege' => '{DAV:}write']], 6],
			[[['privilege' => '{DAV:}all']], 31],
			[[['privilege' => '{DAV:}read'],['privilege' => '{DAV:}write']], 7],
			[[['privilege' => '{DAV:}read'],['privilege' => '{DAV:}all']], 31],
			[[['privilege' => '{DAV:}all'],['privilege' => '{DAV:}write']], 31],
			[[['privilege' => '{DAV:}read'],['privilege' => '{DAV:}write'],['privilege' => '{DAV:}all']], 31],
			[[['privilege' => '{DAV:}all'],['privilege' => '{DAV:}read'],['privilege' => '{DAV:}write']], 31],
		];
	}

	public function testDelete() {
		$cardId = 1;
		$cardUri = 'cardUri';
		$this->backend->expects($this->once())->method('getCardUri')
			->with($cardId)->willReturn($cardUri);
		$this->backend->expects($this->once())->method('deleteCard')
			->with($this->addressBookInfo['id'], $cardUri)
			->willReturn(true);

		$this->assertTrue($this->addressBookImpl->delete($cardId));
	}

	public function testReadCard() {
		$vCard = new VCard();
		$vCard->add(new Text($vCard, 'UID', 'uid'));
		$vCardSerialized = $vCard->serialize();

		$result = $this->invokePrivate($this->addressBookImpl, 'readCard', [$vCardSerialized]);
		$resultSerialized = $result->serialize();

		$this->assertSame($vCardSerialized, $resultSerialized);
	}

	public function testCreateUid() {
		/** @var \PHPUnit_Framework_MockObject_MockObject | AddressBookImpl $addressBookImpl */
		$addressBookImpl = $this->getMockBuilder('OCA\DAV\CardDAV\AddressBookImpl')
			->setConstructorArgs(
				[
					$this->addressBook,
					$this->addressBookInfo,
					$this->backend
				]
			)
			->setMethods(['getUid'])
			->getMock();

		$addressBookImpl->expects($this->at(0))->method('getUid')->willReturn('uid0');
		$addressBookImpl->expects($this->at(1))->method('getUid')->willReturn('uid1');

		// simulate that 'uid0' already exists, so the second uid will be returned
		$this->backend->expects($this->exactly(2))->method('getContact')
			->willReturnCallback(
				function($id, $uid) {
					return ($uid === 'uid0.vcf');
				}
			);

		$this->assertSame('uid1',
			$this->invokePrivate($addressBookImpl, 'createUid', [])
		);

	}

	public function testCreateEmptyVCard() {
		$uid = 'uid';
		$expectedVCard = new VCard();
		$expectedVCard->add(new Text($expectedVCard, 'UID', $uid));
		$expectedVCardSerialized = $expectedVCard->serialize();

		$result = $this->invokePrivate($this->addressBookImpl, 'createEmptyVCard', [$uid]);
		$resultSerialized = $result->serialize();

		$this->assertSame($expectedVCardSerialized, $resultSerialized);
	}

}
