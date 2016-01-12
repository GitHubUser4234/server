<?php
/**
 * @author Lukas Reschke <lukas@owncloud.com>
 * @author Morris Jobke <hey@morrisjobke.de>
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

namespace OC\Appframework\Middleware\Security\Exceptions;

use OCP\AppFramework\Http;

/**
 * Class NotLoggedInException is thrown when a resource has been requested by a
 * guest user that is not accessible to the public.
 *
 * @package OC\Appframework\Middleware\Security\Exceptions
 */
class NotLoggedInException extends SecurityException {
	public function __construct() {
		parent::__construct('Current user is not logged in', Http::STATUS_UNAUTHORIZED);
	}
}
