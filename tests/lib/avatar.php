<?php
/**
 * Copyright (c) 2013 Christopher Schäpers <christopher@schaepers.it>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

class Test_Avatar extends PHPUnit_Framework_TestCase {

	public function testAvatar() {
		$avatar = new \OC_Avatar();

		$this->assertEquals(false, $avatar->get(\OC_User::getUser()));

		$expected = new OC_Image(\OC::$SERVERROOT.'/tests/data/testavatar.png');
		$avatar->set(\OC_User::getUser(), $expected->data());
		$expected->resize(64);
		$this->assertEquals($expected->data(), $avatar->get(\OC_User::getUser())->data());

		$avatar->remove(\OC_User::getUser());
		$this->assertEquals(false, $avatar->get(\OC_User::getUser()));
	}
}
