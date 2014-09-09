<?php
/**
 * Copyright (c) 2014 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */


namespace OC\DB;

class AdapterMySQL extends Adapter {
	public function fixupStatement($statement) {
		$statement = str_replace(' ILIKE ', ' COLLATE utf8_general_ci LIKE ', $statement);
		return $statement;
	}
}
