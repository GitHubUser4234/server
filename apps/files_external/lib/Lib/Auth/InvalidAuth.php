<?php
/**
 * @copyright Copyright (c) 2016, ownCloud GmbH.
 *
 * @author Vincent Petry <pvince81@owncloud.com>
 *
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

namespace OCA\Files_External\Lib\Auth;

/**
 * Invalid authentication representing an auth mechanism
 * that could not be resolved0
 */
class InvalidAuth extends AuthMechanism {

	/**
	 * Constructs a new InvalidAuth with the id of the invalid auth
	 * for display purposes
	 *
	 * @param string $invalidId invalid id
	 */
	public function __construct($invalidId) {
		$this
			->setIdentifier($invalidId)
			->setScheme(self::SCHEME_NULL)
			->setText('Unknown auth mechanism backend ' . $invalidId)
		;
	}

}
