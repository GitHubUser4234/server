<?php
/**
 * @copyright Copyright (c) 2017 Roger Szabo <roger.szabo@web.de>
 *
 * @author Roger Szabo <roger.szabo@web.de>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OC\Authentication\TwoFactorAuth;

use OCP\IConfig;

class TwoFactorAuthFilter {

	/**
	 * Determine whether client IP is in white list for skipping 2FA
	 *
	 * @param IConfig $config
	 *
	 * @return boolean
	 */
	public static function skipTwoFactorAuthentication(IConfig $config) {
		$ipWhiteList = $config->getSystemValue('no_2fa_ip_list', []);
		if (!is_array($ipWhiteList)) {
			return false;
		}
		$clientIP =  $_SERVER['REMOTE_ADDR'];
		if(in_array($clientIP, $ipWhiteList)) {
			return true;
		}
		return false;
	}
}
