<?php

/**
 * Copyright (c) 2013 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace Test\Memcache;

class Memcached extends Cache {
	public function setUp() {
		if (!\OC\Memcache\Memcached::isAvailable()) {
			$this->markTestSkipped('The memcached extension is not available.');
			return;
		}
		$this->instance = new \OC\Memcache\Memcached(uniqid());
	}
}
