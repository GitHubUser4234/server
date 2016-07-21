<?php
/**
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 *
 * @author Jesús Macias <jmacias@solidgear.es>
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
namespace OCP\Files;

/**
 * Storage has bad or missing config params
 * @since 9.0.0
 */
class StorageBadConfigException extends StorageNotAvailableException {

	/**
	 * ExtStorageBadConfigException constructor.
	 *
	 * @param string $message
	 * @param int $code
	 * @param \Exception $previous
	 * @since 9.0.0
	 */
	public function __construct($message = '', \Exception $previous = null) {
		$l = \OC::$server->getL10N('core');
		parent::__construct($l->t('Storage incomplete configuration. %s', $message), self::STATUS_INCOMPLETE_CONF, $previous);
	}

}
