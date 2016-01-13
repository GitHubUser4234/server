<?php
/**
 * @author Jesús Macias <jmacias@solidgear.es>
 * @author Vincent Petry <pvince81@owncloud.com>
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
// Check if we are a user
OCP\User::checkLoggedIn();

$tmpl = new OCP\Template('files_external', 'list', '');

/* Load Status Manager */
\OCP\Util::addStyle('files_external', 'external');
\OCP\Util::addScript('files_external', 'statusmanager');
\OCP\Util::addScript('files_external', 'rollingqueue');

OCP\Util::addScript('files_external', 'app');
OCP\Util::addScript('files_external', 'mountsfilelist');

$tmpl->printPage();
