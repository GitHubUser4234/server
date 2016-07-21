<?php
/**
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 *
 * @author Bjoern Schiessle <bjoern@schiessle.org>
 * @author Björn Schießle <bjoern@schiessle.org>
 * @author Morris Jobke <hey@morrisjobke.de>
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

use OCA\FederatedFileSharing\AppInfo\Application;

$app = new Application();
$federatedShareProvider = $app->getFederatedShareProvider();

$tmpl = new OCP\Template('federatedfilesharing', 'settings-admin');
$tmpl->assign('outgoingServer2serverShareEnabled', $federatedShareProvider->isOutgoingServer2serverShareEnabled());
$tmpl->assign('incomingServer2serverShareEnabled', $federatedShareProvider->isIncomingServer2serverShareEnabled());

return $tmpl->fetchPage();
