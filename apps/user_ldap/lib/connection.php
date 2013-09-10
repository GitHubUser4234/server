<?php

/**
 * ownCloud – LDAP Access
 *
 * @author Arthur Schiwon
 * @copyright 2012, 2013 Arthur Schiwon blizzz@owncloud.com
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

namespace OCA\user_ldap\lib;

class Connection extends LDAPUtility {
	private $ldapConnectionRes = null;
	private $configPrefix;
	private $configID;
	private $configured = false;

	//whether connection should be kept on __destruct
	private $dontDestruct = false;

	//cache handler
	protected $cache;

	//settings
	protected $config = array(
		'ldapHost' => null,
		'ldapPort' => null,
		'ldapBackupHost' => null,
		'ldapBackupPort' => null,
		'ldapBase' => null,
		'ldapBaseUsers' => null,
		'ldapBaseGroups' => null,
		'ldapAgentName' => null,
		'ldapAgentPassword' => null,
		'ldapTLS' => null,
		'ldapNoCase' => null,
		'turnOffCertCheck' => null,
		'ldapIgnoreNamingRules' => null,
		'ldapUserDisplayName' => null,
		'ldapUserFilter' => null,
		'ldapGroupFilter' => null,
		'ldapGroupDisplayName' => null,
		'ldapGroupMemberAssocAttr' => null,
		'ldapLoginFilter' => null,
		'ldapQuotaAttribute' => null,
		'ldapQuotaDefault' => null,
		'ldapEmailAttribute' => null,
		'ldapCacheTTL' => null,
		'ldapUuidAttribute' => 'auto',
		'ldapOverrideUuidAttribute' => null,
		'ldapOverrideMainServer' => false,
		'ldapConfigurationActive' => false,
		'ldapAttributesForUserSearch' => null,
		'ldapAttributesForGroupSearch' => null,
		'homeFolderNamingRule' => null,
		'hasPagedResultSupport' => false,
		'ldapExpertUsernameAttr' => null,
		'ldapExpertUUIDAttr' => null,
	);

	/**
	 * @brief Constructor
	 * @param $configPrefix a string with the prefix for the configkey column (appconfig table)
	 * @param $configID a string with the value for the appid column (appconfig table) or null for on-the-fly connections
	 */
	public function __construct(ILDAPWrapper $ldap, $configPrefix = '', $configID = 'user_ldap') {
		parent::__construct($ldap);
		$this->configPrefix = $configPrefix;
		$this->configID = $configID;
		$memcache = new \OC\Memcache\Factory();
		if($memcache->isAvailable()) {
			$this->cache = $memcache->create();
		} else {
			$this->cache = \OC_Cache::getGlobalCache();
		}
		$this->config['hasPagedResultSupport'] =
			$this->ldap->hasPagedResultSupport();
	}

	public function __destruct() {
		if(!$this->dontDestruct &&
			$this->ldap->isResource($this->ldapConnectionRes)) {
			@$this->ldap->unbind($this->ldapConnectionRes);
		};
	}

	/**
	 * @brief defines behaviour when the instance is cloned
	 */
	public function __clone() {
		//a cloned instance inherits the connection resource. It may use it,
		//but it may not disconnect it
		$this->dontDestruct = true;
	}

	public function __get($name) {
		if(!$this->configured) {
			$this->readConfiguration();
		}

		if(isset($this->config[$name])) {
			return $this->config[$name];
		}
	}

	public function __set($name, $value) {
		$changed = false;
		//only few options are writable
		if($name === 'ldapUuidAttribute') {
			\OCP\Util::writeLog('user_ldap', 'Set config ldapUuidAttribute to  '.$value, \OCP\Util::DEBUG);
			$this->config[$name] = $value;
			if(!empty($this->configID)) {
				\OCP\Config::setAppValue($this->configID, $this->configPrefix.'ldap_uuid_attribute', $value);
			}
			$changed = true;
		}
		if($changed) {
			$this->validateConfiguration();
		}
	}

	/**
	 * @brief initializes the LDAP backend
	 * @param $force read the config settings no matter what
	 *
	 * initializes the LDAP backend
	 */
	public function init($force = false) {
		$this->readConfiguration($force);
		$this->establishConnection();
	}

	/**
	 * Returns the LDAP handler
	 */
	public function getConnectionResource() {
		if(!$this->ldapConnectionRes) {
			$this->init();
		} else if(!$this->ldap->isResource($this->ldapConnectionRes)) {
			$this->ldapConnectionRes = null;
			$this->establishConnection();
		}
		if(is_null($this->ldapConnectionRes)) {
			\OCP\Util::writeLog('user_ldap', 'Connection could not be established', \OCP\Util::ERROR);
		}
		return $this->ldapConnectionRes;
	}

	private function getCacheKey($key) {
		$prefix = 'LDAP-'.$this->configID.'-'.$this->configPrefix.'-';
		if(is_null($key)) {
			return $prefix;
		}
		return $prefix.md5($key);
	}

	public function getFromCache($key) {
		if(!$this->configured) {
			$this->readConfiguration();
		}
		if(!$this->config['ldapCacheTTL']) {
			return null;
		}
		if(!$this->isCached($key)) {
			return null;

		}
		$key = $this->getCacheKey($key);

		return unserialize(base64_decode($this->cache->get($key)));
	}

	public function isCached($key) {
		if(!$this->configured) {
			$this->readConfiguration();
		}
		if(!$this->config['ldapCacheTTL']) {
			return false;
		}
		$key = $this->getCacheKey($key);
		return $this->cache->hasKey($key);
	}

	public function writeToCache($key, $value) {
		if(!$this->configured) {
			$this->readConfiguration();
		}
		if(!$this->config['ldapCacheTTL']
			|| !$this->config['ldapConfigurationActive']) {
			return null;
		}
		$key   = $this->getCacheKey($key);
		$value = base64_encode(serialize($value));
		$this->cache->set($key, $value, $this->config['ldapCacheTTL']);
	}

	public function clearCache() {
		$this->cache->clear($this->getCacheKey(null));
	}

	private function getValue($varname) {
		static $defaults;
		if(is_null($defaults)) {
			$defaults = $this->getDefaults();
		}
		return \OCP\Config::getAppValue($this->configID,
										$this->configPrefix.$varname,
										$defaults[$varname]);
	}

	private function setValue($varname, $value) {
		\OCP\Config::setAppValue($this->configID,
									$this->configPrefix.$varname,
									$value);
	}

	/**
	 * Special handling for reading Base Configuration
	 *
	 * @param $base the internal name of the config key
	 * @param $value the value stored for the base
	 */
	private function readBase($base, $value) {
		if(empty($value)) {
			$value = '';
		} else {
			$value = preg_split('/\r\n|\r|\n/', $value);
		}

		$this->config[$base] = $value;
	}

	/**
	 * Caches the general LDAP configuration.
	 */
	private function readConfiguration($force = false) {
		if((!$this->configured || $force) && !is_null($this->configID)) {
			$v = 'getValue';
			$this->config['ldapHost']       = $this->$v('ldap_host');
			$this->config['ldapBackupHost'] = $this->$v('ldap_backup_host');
			$this->config['ldapPort']       = $this->$v('ldap_port');
			$this->config['ldapBackupPort'] = $this->$v('ldap_backup_port');
			$this->config['ldapOverrideMainServer']
				= $this->$v('ldap_override_main_server');
			$this->config['ldapAgentName']  = $this->$v('ldap_dn');
			$this->config['ldapAgentPassword']
				= base64_decode($this->$v('ldap_agent_password'));
			$this->readBase('ldapBase',       $this->$v('ldap_base'));
			$this->readBase('ldapBaseUsers',  $this->$v('ldap_base_users'));
			$this->readBase('ldapBaseGroups', $this->$v('ldap_base_groups'));
			$this->config['ldapTLS']        = $this->$v('ldap_tls');
			$this->config['ldapNoCase']     = $this->$v('ldap_nocase');
			$this->config['turnOffCertCheck']
				= $this->$v('ldap_turn_off_cert_check');
			$this->config['ldapUserDisplayName']
				= mb_strtolower($this->$v('ldap_display_name'), 'UTF-8');
			$this->config['ldapUserFilter']
				= $this->$v('ldap_userlist_filter');
			$this->config['ldapGroupFilter'] = $this->$v('ldap_group_filter');
			$this->config['ldapLoginFilter'] = $this->$v('ldap_login_filter');
			$this->config['ldapGroupDisplayName']
				= mb_strtolower($this->$v('ldap_group_display_name'), 'UTF-8');
			$this->config['ldapQuotaAttribute']
				= $this->$v('ldap_quota_attr');
			$this->config['ldapQuotaDefault']
				= $this->$v('ldap_quota_def');
			$this->config['ldapEmailAttribute']
				= $this->$v('ldap_email_attr');
			$this->config['ldapGroupMemberAssocAttr']
				= $this->$v('ldap_group_member_assoc_attribute');
			$this->config['ldapIgnoreNamingRules']
				= \OCP\Config::getSystemValue('ldapIgnoreNamingRules', false);
			$this->config['ldapCacheTTL']    = $this->$v('ldap_cache_ttl');
			$this->config['ldapUuidAttribute']
				= $this->$v('ldap_uuid_attribute');
			$this->config['ldapOverrideUuidAttribute']
				= $this->$v('ldap_override_uuid_attribute');
			$this->config['homeFolderNamingRule']
				= $this->$v('home_folder_naming_rule');
			$this->config['ldapConfigurationActive']
				= $this->$v('ldap_configuration_active');
			$this->config['ldapAttributesForUserSearch']
				= preg_split('/\r\n|\r|\n/', $this->$v('ldap_attributes_for_user_search'));
			$this->config['ldapAttributesForGroupSearch']
				= preg_split('/\r\n|\r|\n/', $this->$v('ldap_attributes_for_group_search'));
			$this->config['ldapExpertUsernameAttr']
				= $this->$v('ldap_expert_username_attr');
			$this->config['ldapExpertUUIDAttr']
				= $this->$v('ldap_expert_uuid_attr');

			$this->configured = $this->validateConfiguration();
		}
	}

	/**
	 * @return returns an array that maps internal variable names to database fields
	 */
	private function getConfigTranslationArray() {
		static $array = array(
			'ldap_host'=>'ldapHost',
			'ldap_port'=>'ldapPort',
			'ldap_backup_host'=>'ldapBackupHost',
			'ldap_backup_port'=>'ldapBackupPort',
			'ldap_override_main_server' => 'ldapOverrideMainServer',
			'ldap_dn'=>'ldapAgentName',
			'ldap_agent_password'=>'ldapAgentPassword',
			'ldap_base'=>'ldapBase',
			'ldap_base_users'=>'ldapBaseUsers',
			'ldap_base_groups'=>'ldapBaseGroups',
			'ldap_userlist_filter'=>'ldapUserFilter',
			'ldap_login_filter'=>'ldapLoginFilter',
			'ldap_group_filter'=>'ldapGroupFilter',
			'ldap_display_name'=>'ldapUserDisplayName',
			'ldap_group_display_name'=>'ldapGroupDisplayName',
			'ldap_tls'=>'ldapTLS',
			'ldap_nocase'=>'ldapNoCase',
			'ldap_quota_def'=>'ldapQuotaDefault',
			'ldap_quota_attr'=>'ldapQuotaAttribute',
			'ldap_email_attr'=>'ldapEmailAttribute',
			'ldap_group_member_assoc_attribute'=>'ldapGroupMemberAssocAttr',
			'ldap_cache_ttl'=>'ldapCacheTTL',
			'home_folder_naming_rule' => 'homeFolderNamingRule',
			'ldap_turn_off_cert_check' => 'turnOffCertCheck',
			'ldap_configuration_active' => 'ldapConfigurationActive',
			'ldap_attributes_for_user_search' => 'ldapAttributesForUserSearch',
			'ldap_attributes_for_group_search' => 'ldapAttributesForGroupSearch',
			'ldap_expert_username_attr' => 'ldapExpertUsernameAttr',
			'ldap_expert_uuid_attr' => 'ldapExpertUUIDAttr',
		);
		return $array;
	}

	/**
	 * @brief set LDAP configuration with values delivered by an array, not read from configuration
	 * @param $config array that holds the config parameters in an associated array
	 * @param &$setParameters optional; array where the set fields will be given to
	 * @return true if config validates, false otherwise. Check with $setParameters for detailed success on single parameters
	 */
	public function setConfiguration($config, &$setParameters = null) {
		if(!is_array($config)) {
			return false;
		}

		$params = $this->getConfigTranslationArray();

		foreach($config as $parameter => $value) {
			if(($parameter === 'homeFolderNamingRule'
				|| (isset($params[$parameter])
					&& $params[$parameter] === 'homeFolderNamingRule'))
				&& !empty($value)) {
				$value = 'attr:'.$value;
			} else if (strpos($parameter, 'ldapBase') !== false
				|| (isset($params[$parameter])
					&& strpos($params[$parameter], 'ldapBase') !== false)) {
				$this->readBase($params[$parameter], $value);
				if(is_array($setParameters)) {
					$setParameters[] = $parameter;
				}
				continue;
			}
		    if(isset($this->config[$parameter])) {
				$this->config[$parameter] = $value;
				if(is_array($setParameters)) {
					$setParameters[] = $parameter;
				}
		    } else if(isset($params[$parameter])) {
				$this->config[$params[$parameter]] = $value;
				if(is_array($setParameters)) {
					$setParameters[] = $params[$parameter];
				}
		    }
		}

		$this->configured = $this->validateConfiguration();

		return $this->configured;
	}

	/**
	 * @brief saves the current Configuration in the database
	 */
	public function saveConfiguration() {
		$trans = array_flip($this->getConfigTranslationArray());
		foreach($this->config as $key => $value) {
			\OCP\Util::writeLog('user_ldap', 'LDAP: storing key '.$key.' value '.print_r($value, true), \OCP\Util::DEBUG);
			switch ($key) {
				case 'ldapAgentPassword':
					$value = base64_encode($value);
					break;
				case 'ldapBase':
				case 'ldapBaseUsers':
				case 'ldapBaseGroups':
				case 'ldapAttributesForUserSearch':
				case 'ldapAttributesForGroupSearch':
					if(is_array($value)) {
						$value = implode("\n", $value);
					}
					break;
				case 'ldapIgnoreNamingRules':
				case 'ldapOverrideUuidAttribute':
				case 'ldapUuidAttribute':
				case 'hasPagedResultSupport':
					continue 2;
			}
			if(is_null($value)) {
				$value = '';
			}

		    $this->setValue($trans[$key], $value);
		}
		$this->clearCache();
	}

	/**
	 * @brief get the current LDAP configuration
	 * @return array
	 */
	public function getConfiguration() {
		$this->readConfiguration();
		$trans = $this->getConfigTranslationArray();
		$config = array();
		foreach($trans as $dbKey => $classKey) {
			if($classKey === 'homeFolderNamingRule') {
				if(strpos($this->config[$classKey], 'attr:') === 0) {
					$config[$dbKey] = substr($this->config[$classKey], 5);
				} else {
					$config[$dbKey] = '';
				}
				continue;
			} else if((strpos($classKey, 'ldapBase') !== false
						|| strpos($classKey, 'ldapAttributes') !== false)
						&& is_array($this->config[$classKey])) {
				$config[$dbKey] = implode("\n", $this->config[$classKey]);
				continue;
			}
			$config[$dbKey] = $this->config[$classKey];
		}

		return $config;
	}

	/**
	 * @brief Validates the user specified configuration
	 * @returns true if configuration seems OK, false otherwise
	 */
	private function validateConfiguration() {
		// first step: "soft" checks: settings that are not really
		// necessary, but advisable. If left empty, give an info message
		if(empty($this->config['ldapBaseUsers'])) {
			\OCP\Util::writeLog('user_ldap', 'Base tree for Users is empty, using Base DN', \OCP\Util::INFO);
			$this->config['ldapBaseUsers'] = $this->config['ldapBase'];
		}
		if(empty($this->config['ldapBaseGroups'])) {
			\OCP\Util::writeLog('user_ldap', 'Base tree for Groups is empty, using Base DN', \OCP\Util::INFO);
			$this->config['ldapBaseGroups'] = $this->config['ldapBase'];
		}
		if(empty($this->config['ldapGroupFilter']) && empty($this->config['ldapGroupMemberAssocAttr'])) {
			\OCP\Util::writeLog('user_ldap',
				'No group filter is specified, LDAP group feature will not be used.',
				\OCP\Util::INFO);
		}
		$uuidAttributes = array(
			'auto', 'entryuuid', 'nsuniqueid', 'objectguid', 'guid');
		if(!in_array($this->config['ldapUuidAttribute'], $uuidAttributes)
			&& (!is_null($this->configID))) {
			\OCP\Config::setAppValue($this->configID, $this->configPrefix.'ldap_uuid_attribute', 'auto');
			\OCP\Util::writeLog('user_ldap',
				'Illegal value for the UUID Attribute, reset to autodetect.',
				\OCP\Util::INFO);
		}
		if(empty($this->config['ldapBackupPort'])) {
			//force default
			$this->config['ldapBackupPort'] = $this->config['ldapPort'];
		}
		foreach(array('ldapAttributesForUserSearch', 'ldapAttributesForGroupSearch') as $key) {
			if(is_array($this->config[$key])
				&& count($this->config[$key]) === 1
				&& empty($this->config[$key][0])) {
				$this->config[$key] = array();
			}
		}
		if((strpos($this->config['ldapHost'], 'ldaps') === 0)
			&& $this->config['ldapTLS']) {
			$this->config['ldapTLS'] = false;
			\OCP\Util::writeLog('user_ldap',
				'LDAPS (already using secure connection) and TLS do not work together. Switched off TLS.',
				\OCP\Util::INFO);
		}



		//second step: critical checks. If left empty or filled wrong, set as unconfigured and give a warning.
		$configurationOK = true;
		if(empty($this->config['ldapHost'])) {
			\OCP\Util::writeLog('user_ldap', 'No LDAP host given, won`t connect.', \OCP\Util::WARN);
			$configurationOK = false;
		}
		if(empty($this->config['ldapPort'])) {
			\OCP\Util::writeLog('user_ldap', 'No LDAP Port given, won`t connect.', \OCP\Util::WARN);
			$configurationOK = false;
		}
		if((empty($this->config['ldapAgentName']) && !empty($this->config['ldapAgentPassword']))
			|| (!empty($this->config['ldapAgentName']) && empty($this->config['ldapAgentPassword']))) {
			\OCP\Util::writeLog('user_ldap',
				'Either no password given for the user agent or a password is given, but no LDAP agent; won`t connect.',
				\OCP\Util::WARN);
			$configurationOK = false;
		}
		//TODO: check if ldapAgentName is in DN form
		if(empty($this->config['ldapBase'])
			&& (empty($this->config['ldapBaseUsers'])
			&& empty($this->config['ldapBaseGroups']))) {
			\OCP\Util::writeLog('user_ldap', 'No Base DN given, won`t connect.', \OCP\Util::WARN);
			$configurationOK = false;
		}
		if(empty($this->config['ldapUserDisplayName'])) {
			\OCP\Util::writeLog('user_ldap',
				'No user display name attribute specified, won`t connect.',
				\OCP\Util::WARN);
			$configurationOK = false;
		}
		if(empty($this->config['ldapGroupDisplayName'])) {
			\OCP\Util::writeLog('user_ldap',
				'No group display name attribute specified, won`t connect.',
				\OCP\Util::WARN);
			$configurationOK = false;
		}
		if(empty($this->config['ldapLoginFilter'])) {
			\OCP\Util::writeLog('user_ldap', 'No login filter specified, won`t connect.', \OCP\Util::WARN);
			$configurationOK = false;
		}
		if(mb_strpos($this->config['ldapLoginFilter'], '%uid', 0, 'UTF-8') === false) {
			\OCP\Util::writeLog('user_ldap',
				'Login filter does not contain %uid place holder, won`t connect.',
				\OCP\Util::WARN);
			\OCP\Util::writeLog('user_ldap', 'Login filter was ' . $this->config['ldapLoginFilter'], \OCP\Util::DEBUG);
			$configurationOK = false;
		}

		if(!empty($this->config['ldapExpertUUIDAttr'])) {
			$this->config['ldapUuidAttribute'] = $this->config['ldapExpertUUIDAttr'];
		}

		return $configurationOK;
	}

	/**
	 * @returns an associative array with the default values. Keys are correspond
	 * to config-value entries in the database table
	 */
	static public function getDefaults() {
		return array(
			'ldap_host'                         => '',
			'ldap_port'                         => '389',
			'ldap_backup_host'                  => '',
			'ldap_backup_port'                  => '',
			'ldap_override_main_server'         => '',
			'ldap_dn'                           => '',
			'ldap_agent_password'               => '',
			'ldap_base'                         => '',
			'ldap_base_users'                   => '',
			'ldap_base_groups'                  => '',
			'ldap_userlist_filter'              => 'objectClass=person',
			'ldap_login_filter'                 => 'uid=%uid',
			'ldap_group_filter'                 => 'objectClass=posixGroup',
			'ldap_display_name'                 => 'cn',
			'ldap_group_display_name'           => 'cn',
			'ldap_tls'                          => 1,
			'ldap_nocase'                       => 0,
			'ldap_quota_def'                    => '',
			'ldap_quota_attr'                   => '',
			'ldap_email_attr'                   => '',
			'ldap_group_member_assoc_attribute' => 'uniqueMember',
			'ldap_cache_ttl'                    => 600,
			'ldap_uuid_attribute'				=> 'auto',
			'ldap_override_uuid_attribute'		=> 0,
			'home_folder_naming_rule'           => '',
			'ldap_turn_off_cert_check'			=> 0,
			'ldap_configuration_active'			=> 1,
			'ldap_attributes_for_user_search'	=> '',
			'ldap_attributes_for_group_search'	=> '',
			'ldap_expert_username_attr'              => '',
			'ldap_expert_uuid_attr'             => '',
		);
	}

	/**
	 * Connects and Binds to LDAP
	 */
	private function establishConnection() {
		if(!$this->config['ldapConfigurationActive']) {
			return null;
		}
		static $phpLDAPinstalled = true;
		if(!$phpLDAPinstalled) {
			return false;
		}
		if(!$this->configured) {
			\OCP\Util::writeLog('user_ldap', 'Configuration is invalid, cannot connect', \OCP\Util::WARN);
			return false;
		}
		if(!$this->ldapConnectionRes) {
			if(!$this->ldap->areLDAPFunctionsAvailable()) {
				$phpLDAPinstalled = false;
				\OCP\Util::writeLog('user_ldap',
					'function ldap_connect is not available. Make sure that the PHP ldap module is installed.',
					\OCP\Util::ERROR);

				return false;
			}
			if($this->config['turnOffCertCheck']) {
				if(putenv('LDAPTLS_REQCERT=never')) {
					\OCP\Util::writeLog('user_ldap',
						'Turned off SSL certificate validation successfully.',
						\OCP\Util::WARN);
				} else {
					\OCP\Util::writeLog('user_ldap', 'Could not turn off SSL certificate validation.', \OCP\Util::WARN);
				}
			}
			if(!$this->config['ldapOverrideMainServer'] && !$this->getFromCache('overrideMainServer')) {
				$this->doConnect($this->config['ldapHost'], $this->config['ldapPort']);
				$bindStatus = $this->bind();
				$error = $this->ldap->isResource($this->ldapConnectionRes) ? $this->ldap->errno($this->ldapConnectionRes) : -1;
			} else {
				$bindStatus = false;
				$error = null;
			}

			//if LDAP server is not reachable, try the Backup (Replica!) Server
			if((!$bindStatus && ($error !== 0))
				|| $this->config['ldapOverrideMainServer']
				|| $this->getFromCache('overrideMainServer')) {
					$this->doConnect($this->config['ldapBackupHost'], $this->config['ldapBackupPort']);
					$bindStatus = $this->bind();
					if(!$bindStatus && $error === -1) {
						//when bind to backup server succeeded and failed to main server,
						//skip contacting him until next cache refresh
						$this->writeToCache('overrideMainServer', true);
					}
			}
			return $bindStatus;
		}
	}

	private function doConnect($host, $port) {
		if(empty($host)) {
			return false;
		}
		if(strpos($host, '://') !== false) {
			//ldap_connect ignores port paramater when URLs are passed
			$host .= ':' . $port;
		}
		$this->ldapConnectionRes = $this->ldap->connect($host, $port);
		if($this->ldap->setOption($this->ldapConnectionRes, LDAP_OPT_PROTOCOL_VERSION, 3)) {
			if($this->ldap->setOption($this->ldapConnectionRes, LDAP_OPT_REFERRALS, 0)) {
				if($this->config['ldapTLS']) {
					$this->ldap->startTls($this->ldapConnectionRes);
				}
			}
		}
	}

	/**
	 * Binds to LDAP
	 */
	public function bind() {
		static $getConnectionResourceAttempt = false;
		if(!$this->config['ldapConfigurationActive']) {
			return false;
		}
		if($getConnectionResourceAttempt) {
			$getConnectionResourceAttempt = false;
			return false;
		}
		$getConnectionResourceAttempt = true;
		$cr = $this->getConnectionResource();
		$getConnectionResourceAttempt = false;
		if(!$this->ldap->isResource($cr)) {
			return false;
		}
		$ldapLogin = @$this->ldap->bind($cr, $this->config['ldapAgentName'], $this->config['ldapAgentPassword']);
		if(!$ldapLogin) {
			\OCP\Util::writeLog('user_ldap',
				'Bind failed: ' . $this->ldap->errno($cr) . ': ' . $this->ldap->error($cr),
				\OCP\Util::ERROR);
			$this->ldapConnectionRes = null;
			return false;
		}
		return true;
	}

}
