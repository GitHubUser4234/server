<?php

/**
 * ownCloud - App Framework
 *
 * @author Bernhard Posselt
 * @author Morris Jobke
 * @copyright 2012 Bernhard Posselt nukeawhale@gmail.com
 * @copyright 2013 Morris Jobke morris.jobke@gmail.com
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


namespace OC\AppFramework\Http;


use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Http;

//require_once(__DIR__ . "/../classloader.php");



class JSONResponseTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var JSONResponse
	 */
	private $json;

	protected function setUp() {
		$this->json = new JSONResponse();
	}


	public function testHeader() {
		$headers = $this->json->getHeaders();
		$this->assertEquals('application/json; charset=utf-8', $headers['Content-type']);
	}


	public function testSetData() {
		$params = array('hi', 'yo');
		$this->json->setData($params);

		$this->assertEquals(array('hi', 'yo'), $this->json->getData());
	}


	public function testSetRender() {
		$params = array('test' => 'hi');
		$this->json->setData($params);

		$expected = '{"test":"hi"}';

		$this->assertEquals($expected, $this->json->render());
	}


	public function testRender() {
		$params = array('test' => 'hi');
		$this->json->setData($params);

		$expected = '{"test":"hi"}';

		$this->assertEquals($expected, $this->json->render());
	}

	public function testConstructorAllowsToSetData() {
		$data = array('hi');
		$code = 300;
		$response = new JSONResponse($data, $code);

		$expected = '["hi"]';
		$this->assertEquals($expected, $response->render());
		$this->assertEquals($code, $response->getStatus());
	}

	public function testChainability() {
		$params = array('hi', 'yo');
		$this->json->setData($params)
			->setStatus(Http::STATUS_NOT_FOUND);

		$this->assertEquals(Http::STATUS_NOT_FOUND, $this->json->getStatus());
		$this->assertEquals(array('hi', 'yo'), $this->json->getData());
	}

}
