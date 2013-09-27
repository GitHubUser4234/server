<?php
/**
 * Copyright (c) 2013 Thomas Tanghus (thomas@tanghus.net)
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OC\AppFramework\Http;

global $data;

class RequestTest extends \PHPUnit_Framework_TestCase {

	public function testRequestAccessors() {
		$vars = array(
			'get' => array('name' => 'John Q. Public', 'nickname' => 'Joey'),
			'method' => 'GET',
		);

		$request = new Request($vars);

		// Countable
		$this->assertEquals(2, count($request));
		// Array access
		$this->assertEquals('Joey', $request['nickname']);
		// "Magic" accessors
		$this->assertEquals('Joey', $request->{'nickname'});
		$this->assertTrue(isset($request['nickname']));
		$this->assertTrue(isset($request->{'nickname'}));
		$this->assertEquals(false, isset($request->{'flickname'}));
		// Only testing 'get', but same approach for post, files etc.
		$this->assertEquals('Joey', $request->get['nickname']);
		// Always returns null if variable not set.
		$this->assertEquals(null, $request->{'flickname'});

		require_once __DIR__ . '/requeststream.php';
	}

	// urlParams has precedence over POST which has precedence over GET
	public function testPrecedence() {
		$vars = array(
			'get' => array('name' => 'John Q. Public', 'nickname' => 'Joey'),
			'post' => array('name' => 'Jane Doe', 'nickname' => 'Janey'),
			'urlParams' => array('user' => 'jw', 'name' => 'Johnny Weissmüller'),
		);

		$request = new Request($vars);

		$this->assertEquals(3, count($request));
		$this->assertEquals('Janey', $request->{'nickname'});
		$this->assertEquals('Johnny Weissmüller', $request->{'name'});
	}


	/**
	* @expectedException RuntimeException
	*/
	public function testImmutableArrayAccess() {
		$vars = array(
			'get' => array('name' => 'John Q. Public', 'nickname' => 'Joey'),
		);

		$request = new Request($vars);
		$request['nickname'] = 'Janey';
	}

	/**
	* @expectedException RuntimeException
	*/
	public function testImmutableMagicAccess() {
		$vars = array(
			'get' => array('name' => 'John Q. Public', 'nickname' => 'Joey'),
		);

		$request = new Request($vars);
		$request->{'nickname'} = 'Janey';
	}

	/**
	* @expectedException LogicException
	*/
	public function testGetTheMethodRight() {
		$vars = array(
			'get' => array('name' => 'John Q. Public', 'nickname' => 'Joey'),
			'method' => 'GET',
		);

		$request = new Request($vars);
		$result = $request->post;
	}

	public function testTheMethodIsRight() {
		$vars = array(
			'get' => array('name' => 'John Q. Public', 'nickname' => 'Joey'),
			'method' => 'GET',
		);

		$request = new Request($vars);
		$this->assertEquals('GET', $request->method);
		$result = $request->get;
		$this->assertEquals('John Q. Public', $result['name']);
		$this->assertEquals('Joey', $result['nickname']);
	}

	public function testJsonPost() {
		$vars = array(
			'post' => '{"name": "John Q. Public", "nickname": "Joey"}',
			'method' => 'POST',
			'server' => array('CONTENT_TYPE' => 'application/json; utf-8'),
		);

		$request = new Request($vars);
		$this->assertEquals('POST', $request->method);
		$result = $request->post;
		$this->assertEquals('John Q. Public', $result['name']);
		$this->assertEquals('Joey', $result['nickname']);
	}

	public function testPatch() {
		global $data;
		$data = http_build_query(array('name' => 'John Q. Public', 'nickname' => 'Joey'), '', '&');

		if (in_array('fakeinput', stream_get_wrappers())) {
			stream_wrapper_unregister('fakeinput');
		}
		stream_wrapper_register('fakeinput', 'RequestStream');

		$vars = array(
			'patch' => $data,
			'method' => 'PATCH',
			'server' => array('CONTENT_TYPE' => 'application/x-www-form-urlencoded'),
		);

		$request = new Request($vars);

		$this->assertEquals('PATCH', $request->method);
		$result = $request->patch;

		$this->assertEquals('John Q. Public', $result['name']);
		$this->assertEquals('Joey', $result['nickname']);

		stream_wrapper_unregister('fakeinput');
	}

	public function testJsonPatch() {
		global $data;
		$data = '{"name": "John Q. Public", "nickname": null}';

		if (in_array('fakeinput', stream_get_wrappers())) {
			stream_wrapper_unregister('fakeinput');
		}
		stream_wrapper_register('fakeinput', 'RequestStream');

		$vars = array(
			'patch' => $data,
			'method' => 'PATCH',
			'server' => array('CONTENT_TYPE' => 'application/json; utf-8'),
		);

		$request = new Request($vars);

		$this->assertEquals('PATCH', $request->method);
		$result = $request->patch;

		$this->assertEquals('John Q. Public', $result['name']);
		$this->assertEquals(null, $result['nickname']);

		stream_wrapper_unregister('fakeinput');
	}

	public function testPutSteam() {
		global $data;
		$data = file_get_contents(__DIR__ . '/../../../data/testimage.png');

		if (in_array('fakeinput', stream_get_wrappers())) {
			stream_wrapper_unregister('fakeinput');
		}
		stream_wrapper_register('fakeinput', 'RequestStream');

		$vars = array(
			'put' => $data,
			'method' => 'PUT',
			'server' => array('CONTENT_TYPE' => 'image/png'),
		);

		$request = new Request($vars);
		$this->assertEquals('PUT', $request->method);
		$resource = $request->put;
		$contents = stream_get_contents($resource);
		$this->assertEquals($data, $contents);

		try {
			$resource = $request->put;
		} catch(\LogicException $e) {
			stream_wrapper_unregister('fakeinput');
			return;
		}
		$this->fail('Expected LogicException.');

	}
}
