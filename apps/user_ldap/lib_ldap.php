<?php

/**
 * ownCloud – LDAP lib
 *
 * @author Arthur Schiwon
 * @copyright 2012 Arthur Schiwon blizzz@owncloud.com
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

 class OC_LDAP {
	static protected $ldapConnectionRes = false;
	static protected $configured = false;

	//cached settings
	static protected $ldapHost;
	static protected $ldapPort;
	static protected $ldapBase;
	static protected $ldapAgentName;
	static protected $ldapAgentPassword;
	static protected $ldapTLS;
	static protected $ldapNoCase;

	static public function init() {
		self::readConfiguration();
		self::establishConnection();
	}

	static public function search($filter, $attr = null) {
		$sr = ldap_search(self::getConnectionResource(), self::$ldapBase, $filter);
		$findings = ldap_get_entries(self::getConnectionResource(), $sr );

		if(!is_null($attr)) {
			$selection = array();
			foreach($findings as $item) {
				if(isset($item[strtolower($attr)])) {
					$selection[] = $item[strtolower($attr)][0];
				}
			}
			return $selection;
		}

		return $findings;
	}

	static private function getConnectionResource() {
		if(!self::$ldapConnectionRes) {
			self::init();
		}
		return self::$ldapConnectionRes;
	}

	static private function readConfiguration() {
		if(!self::$configured) {
			self::$ldapHost          = OC_Appconfig::getValue('user_ldap', 'ldap_host', '');
			self::$ldapPort          = OC_Appconfig::getValue('user_ldap', 'ldap_port', OC_USER_BACKEND_LDAP_DEFAULT_PORT);
			self::$ldapAgentName     = OC_Appconfig::getValue('user_ldap', 'ldap_dn','');
			self::$ldapAgentPassword = OC_Appconfig::getValue('user_ldap', 'ldap_password','');
			self::$ldapBase          = OC_Appconfig::getValue('user_ldap', 'ldap_base','');
			self::$ldapTLS           = OC_Appconfig::getValue('user_ldap', 'ldap_tls',0);
			self::$ldapNoCase        = OC_Appconfig::getValue('user_ldap', 'ldap_nocase', 0);

			//TODO: sanity checking
			self::$configured = true;
		}
	}

	static private function establishConnection() {
		if(!self::$ldapConnectionRes) {
			self::$ldapConnectionRes = ldap_connect(self::$ldapHost, self::$ldapPort);
			if(ldap_set_option(self::$ldapConnectionRes, LDAP_OPT_PROTOCOL_VERSION, 3)) {
					if(ldap_set_option(self::$ldapConnectionRes, LDAP_OPT_REFERRALS, 0)) {
						if(self::$ldapTLS) {
							ldap_start_tls(self::$ldapConnectionRes);
						}
					}
			}

			//TODO: Check if it works. Before, it was outside the resource-condition
			$ldapLogin = @ldap_bind(self::$ldapConnectionRes, self::$ldapAgentName, self::$ldapAgentPassword );
			if(!$ldapLogin) {
				return false;
			}
		}
	}


 }