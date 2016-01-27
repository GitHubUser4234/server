<?php
/**
 * Copyright (c) 2016 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace Test\Files\Cache;

use OC\Files\Cache\MoveFromCacheTrait;

class FallBackCrossCacheMoveCache extends \OC\Files\Cache\Cache {
	use MoveFromCacheTrait;
}

/**
 * Class Cache
 *
 * @group DB
 */
class MoveFromCacheTraitTest extends Cache {
	protected function setUp() {
		parent::setUp();

		$this->storage = new \OC\Files\Storage\Temporary(array());
		$this->storage2 = new \OC\Files\Storage\Temporary(array());
		$this->cache = new FallBackCrossCacheMoveCache($this->storage);
		$this->cache2 = new FallBackCrossCacheMoveCache($this->storage2);
	}
}
