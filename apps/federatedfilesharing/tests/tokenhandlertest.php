<?php
/**
 * @author Björn Schießle <schiessle@owncloud.com>
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


namespace OCA\FederatedFileSharing\Tests;


use OCA\FederatedFileSharing\TokenHandler;
use OCP\Security\ISecureRandom;
use Test\TestCase;

class TokenHandlerTest extends TestCase {

	/** @var  TokenHandler */
	private $tokenHandler;

	/** @var  ISecureRandom | \PHPUnit_Framework_MockObject_MockObject */
	private $secureRandom;

	/** @var int */
	private $expectedTokenLength = 15;

	public function setUp() {
		parent::setUp();

		$this->secureRandom = $this->getMock('OCP\Security\ISecureRandom');

		$this->tokenHandler = new TokenHandler($this->secureRandom);
	}

	public function testGenerateToken() {

		$this->secureRandom->expects($this->once())->method('generate')
			->with(
				$this->expectedTokenLength,
				ISecureRandom::CHAR_LOWER . ISecureRandom::CHAR_UPPER . ISecureRandom::CHAR_DIGITS
			)
			->willReturn(true);

		$this->assertTrue($this->tokenHandler->generateToken());

	}

}
