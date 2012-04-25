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

define('LDAP_GROUP_MEMBER_ASSOC_ATTR','uniquemember');

//needed to unbind, because we use OC_LDAP only statically
class OC_LDAP_DESTRUCTOR {
	public function __destruct() {
		OC_LDAP::destruct();
	}
}

class OC_LDAP {
	static protected $ldapConnectionRes = false;
	static protected $configured = false;

	//cached settings
	static protected $ldapHost;
	static protected $ldapPort;
	static protected $ldapBase;
	static protected $ldapBaseUsers;
	static protected $ldapBaseGroups;
	static protected $ldapAgentName;
	static protected $ldapAgentPassword;
	static protected $ldapTLS;
	static protected $ldapNoCase;
	// user and group settings, that are needed in both backends
	static public $ldapUserDisplayName;

	static public function init() {
		self::readConfiguration();
		self::establishConnection();
	}

	static public function destruct() {
		@ldap_unbind(self::$ldapConnectionRes);
	}

	static public function conf($key) {
		$availableProperties = array(
			'ldapUserDisplayName',
		);

		if(in_array($key, $availableProperties)) {
			return self::$$key;
		}
	}

	/**
	 * @brief reads a given attribute for an LDAP record identified by a DN
	 * @param $dn the record in question
	 * @param $attr the attribute that shall be retrieved
	 * @returns the value on success, false otherwise
	 *
	 * Reads an attribute from an LDAP entry
	 */
	static public function readAttribute($dn, $attr) {
		$attr = strtolower($attr);
		$cr = self::getConnectionResource();

		$rr = ldap_read($cr, $dn, 'objectClass=*', array($attr));
		$er = ldap_first_entry($cr, $rr);
		$result = ldap_get_attributes($cr, $er);
		if($result['count'] > 0){
			return $result[$attr][0];
		}
		return false;
	}

	/**
	 * @brief executes an LDAP search, optimized for Users
	 * @param $filter the LDAP filter for the search
	 * @param $attr optional, when a certain attribute shall be filtered out
	 * @returns array with the search result
	 *
	 * Executes an LDAP search
	 */
	static public function searchUsers($filter, $attr = null) {
		return self::search($filter, self::$ldapBaseUsers, $attr);
	}

	/**
	 * @brief executes an LDAP search, optimized for Groups
	 * @param $filter the LDAP filter for the search
	 * @param $attr optional, when a certain attribute shall be filtered out
	 * @returns array with the search result
	 *
	 * Executes an LDAP search
	 */
	static public function searchGroups($filter, $attr = null) {
		return self::search($filter, self::$ldapBaseGroups, $attr);
	}

	/**
	 * @brief executes an LDAP search
	 * @param $filter the LDAP filter for the search
	 * @param $base the LDAP subtree that shall be searched
	 * @param $attr optional, when a certain attribute shall be filtered out
	 * @returns array with the search result
	 *
	 * Executes an LDAP search
	 */
	static private function search($filter, $base, $attr = null) {
		$sr = ldap_search(self::getConnectionResource(), $base, $filter, array($attr));
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

	/**
	 * @brief combines the input filters with AND
	 * @param $filters array, the filters to connect
	 * @returns the combined filter
	 *
	 * Combines Filter arguments with AND
	 */
	static public function combineFilterWithAnd($filters) {
		return self::combineFilter($filters,'&');
	}

	/**
	 * @brief combines the input filters with AND
	 * @param $filters array, the filters to connect
	 * @returns the combined filter
	 *
	 * Combines Filter arguments with AND
	 */
	static public function combineFilterWithOr($filters) {
		return self::combineFilter($filters,'|');
	}

	/**
	 * @brief combines the input filters with given operator
	 * @param $filters array, the filters to connect
	 * @param $operator either & or |
	 * @returns the combined filter
	 *
	 * Combines Filter arguments with AND
	 */
	static private function combineFilter($filters, $operator) {
		$combinedFilter = '('.$operator;
		foreach($filters as $filter) {
		    if(substr($filter,0,1) != '(') {
				$filter = '('.$filter.')';
		    }
		    $combinedFilter.=$filter;
		}
		$combinedFilter.=')';
		return $combinedFilter;
	}

	/**
	 * Returns the LDAP handler
	 */
	static private function getConnectionResource() {
		if(!self::$ldapConnectionRes) {
			self::init();
		}
		return self::$ldapConnectionRes;
	}

	/**
	 * Caches the general LDAP configuration.
	 */
	static private function readConfiguration() {
		if(!self::$configured) {
			self::$ldapHost            = OC_Appconfig::getValue('user_ldap', 'ldap_host', '');
			self::$ldapPort            = OC_Appconfig::getValue('user_ldap', 'ldap_port', OC_USER_BACKEND_LDAP_DEFAULT_PORT);
			self::$ldapAgentName       = OC_Appconfig::getValue('user_ldap', 'ldap_dn','');
			self::$ldapAgentPassword   = OC_Appconfig::getValue('user_ldap', 'ldap_password','');
			self::$ldapBase            = OC_Appconfig::getValue('user_ldap', 'ldap_base', '');
			self::$ldapBaseUsers       = OC_Appconfig::getValue('user_ldap', 'ldap_base_users',self::$ldapBase);
			self::$ldapBaseGroups      = OC_Appconfig::getValue('user_ldap', 'ldap_base_groups', self::$ldapBase);
			self::$ldapTLS             = OC_Appconfig::getValue('user_ldap', 'ldap_tls',0);
			self::$ldapNoCase          = OC_Appconfig::getValue('user_ldap', 'ldap_nocase', 0);
			self::$ldapUserDisplayName = OC_Appconfig::getValue('user_ldap', 'ldap_display_name', OC_USER_BACKEND_LDAP_DEFAULT_DISPLAY_NAME);

			if(
				   !empty(self::$ldapHost)
				&& !empty(self::$ldapPort)
				&& (
					   (!empty(self::$ldapAgentName) && !empty(self::$ldapAgentPassword))
					|| ( empty(self::$ldapAgentName) &&  empty(self::$ldapAgentPassword))
				)
				&& !empty(self::$ldapBase)
				&& !empty(self::$ldapBaseUsers)
				&& !empty(self::$ldapBaseGroups)
				&& !empty(self::$ldapUserDisplayName)
			)
			{
				self::$configured = true;
			}
		}
	}

	/**
	 * Connects and Binds to LDAP
	 */
	static private function establishConnection() {
		if(!self::$configured) {
			return false;
		}
		if(!self::$ldapConnectionRes) {
			self::$ldapConnectionRes = ldap_connect(self::$ldapHost, self::$ldapPort);
			if(ldap_set_option(self::$ldapConnectionRes, LDAP_OPT_PROTOCOL_VERSION, 3)) {
					if(ldap_set_option(self::$ldapConnectionRes, LDAP_OPT_REFERRALS, 0)) {
						if(self::$ldapTLS) {
							ldap_start_tls(self::$ldapConnectionRes);
						}
					}
			}

			$ldapLogin = @ldap_bind(self::$ldapConnectionRes, self::$ldapAgentName, self::$ldapAgentPassword );
			if(!$ldapLogin) {
				return false;
			}
		}
	}


 }