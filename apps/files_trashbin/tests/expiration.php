<?php
/**
 * @author Victor Dubiniuk <dubiniuk@owncloud.com>
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

use \OCA\Files_Trashbin\Expiration;

class Expiration_Test extends \PHPUnit_Framework_TestCase {
	const SECONDS_PER_DAY = 86400; //60*60*24

	public function expirationData(){
		$today = 100*self::SECONDS_PER_DAY;
		$back10Days = (100-10)*self::SECONDS_PER_DAY;
		$back20Days = (100-20)*self::SECONDS_PER_DAY;
		$back30Days = (100-30)*self::SECONDS_PER_DAY;
		$back35Days = (100-35)*self::SECONDS_PER_DAY;

		// it should never happen, but who knows :/
		$ahead100Days = (100+100)*self::SECONDS_PER_DAY;

		return [
			// Expiration is disabled - always should return false
			[ 'disabled', $today, $back10Days, false, false],
			[ 'disabled', $today, $back10Days, true, false],
			[ 'disabled', $today, $ahead100Days, true, false],

			// Default: expire in 30 days or earlier when quota requirements are met
			[ 'auto', $today, $back10Days, false, false],
			[ 'auto', $today, $back35Days, false, false],
			[ 'auto', $today, $back10Days, true, true],
			[ 'auto', $today, $back35Days, true, true],
			[ 'auto', $today, $ahead100Days, true, true],

			// The same with 'auto'
			[ 'auto, auto', $today, $back10Days, false, false],
			[ 'auto, auto', $today, $back35Days, false, false],
			[ 'auto, auto', $today, $back10Days, true, true],
			[ 'auto, auto', $today, $back35Days, true, true],

			// Keep for 15 days but expire anytime if space needed
			[ '15, auto', $today, $back10Days, false, false],
			[ '15, auto', $today, $back20Days, false, false],
			[ '15, auto', $today, $back10Days, true, true],
			[ '15, auto', $today, $back20Days, true, true],
			[ '15, auto', $today, $ahead100Days, true, true],

			// Expire anytime if space needed, Expire all older than max
			[ 'auto, 15', $today, $back10Days, false, false],
			[ 'auto, 15', $today, $back20Days, false, true],
			[ 'auto, 15', $today, $back10Days, true, true],
			[ 'auto, 15', $today, $back20Days, true, true],
			[ 'auto, 15', $today, $ahead100Days, true, true],

			// Expire all older than max OR older than min if space needed
			[ '15, 25', $today, $back10Days, false, false],
			[ '15, 25', $today, $back20Days, false, false],
			[ '15, 25', $today, $back30Days, false, true],
			[ '15, 25', $today, $back10Days, false, false],
			[ '15, 25', $today, $back20Days, true, true],
			[ '15, 25', $today, $back30Days, true, true],
			[ '15, 25', $today, $ahead100Days, true, false],

			// Expire all older than max OR older than min if space needed
			// Max<Min case
			[ '25, 15', $today, $back10Days, false, false],
			[ '25, 15', $today, $back20Days, false, false],
			[ '25, 15', $today, $back30Days, false, true],
			[ '25, 15', $today, $back10Days, false, false],
			[ '25, 15', $today, $back20Days, true, false],
			[ '25, 15', $today, $back30Days, true, true],
			[ '25, 15', $today, $ahead100Days, true, false],
		];
	}

	/**
	 * @dataProvider expirationData
	 *
	 * @param string $retentionObligation
	 * @param int $timeNow
	 * @param int $timestamp
	 * @param bool $quotaExceeded
	 * @param string $expectedResult
	 */
	public function testExpiration($retentionObligation, $timeNow, $timestamp, $quotaExceeded, $expectedResult){
		$mockedConfig = $this->getMockBuilder('\OCP\IConfig')
				->disableOriginalConstructor()
				->setMethods(
					[
						'getValue',
						'setSystemValues',
						'setSystemValue',
						'getSystemValue',
						'deleteSystemValue',
						'getAppKeys',
						'setAppValue',
						'getAppValue',
						'deleteAppValue',
						'deleteAppValues',
						'setUserValue',
						'getUserValue',
						'getUserValueForUsers',
						'getUserKeys',
						'deleteUserValue',
						'deleteAllUserValues',
						'deleteAppFromAllUsers',
						'getUsersForUserValue'
					]
				)
				->getMock()
		;
		$mockedConfig->expects($this->any())->method('getValue')->will(
				$this->returnValue($retentionObligation)
		);

		$mockedTimeFactory = $this->getMockBuilder('\OCP\AppFramework\Utility\ITimeFactory')
				->disableOriginalConstructor()
				->setMethods(['getTime'])
				->getMock()
		;
		$mockedTimeFactory->expects($this->any())->method('getTime')->will(
				$this->returnValue($timeNow)
		);

		$expiration = new Expiration($mockedConfig, $mockedTimeFactory);
		$actualResult = $expiration->isExpired($timestamp, $quotaExceeded);
		
		$this->assertEquals($expectedResult, $actualResult);
	}
}
