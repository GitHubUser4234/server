<?php

namespace OC\Core\Setup;

class Controller {
	public function run($post) {
		// Check for autosetup:
		$post = $this->loadAutoConfig($post);
		$opts = $this->getSystemInfo();

		if(isset($post['install']) AND $post['install']=='true') {
			// We have to launch the installation process :
			$e = \OC_Setup::install($post);
			$errors = array('errors' => $e);

			if(count($e) > 0) {
				$options = array_merge($post, $opts, $errors);
				$this->display($options);
			}
			else {
				$this->finishSetup();
			}
		}
		else {
			$this->display($opts);
		}
	}

	public function display($post) {
		\OC_Util::addScript('setup');
		\OC_Template::printGuestPage('', 'installation', $post);
	}

	public function finishSetup() {
		header( 'Location: '.\OC_Helper::linkToRoute( 'post_setup_check' ));
		exit();
	}

	public function loadAutoConfig($post) {
		$autosetup_file = \OC::$SERVERROOT.'/config/autoconfig.php';
		if( file_exists( $autosetup_file )) {
			\OC_Log::write('core', 'Autoconfig file found, setting up owncloud...', \OC_Log::INFO);
			include $autosetup_file;
			$post['install'] = 'true';
			$post = array_merge ($post, $AUTOCONFIG);
			unlink($autosetup_file);
		}
		return $post;
	}

	public function getSystemInfo() {
		$hasSQLite = class_exists('SQLite3');
		$hasMySQL = is_callable('mysql_connect');
		$hasPostgreSQL = is_callable('pg_connect');
		$hasOracle = is_callable('oci_connect');
		$hasMSSQL = is_callable('sqlsrv_connect');
		$datadir = \OC_Config::getValue('datadirectory', \OC::$SERVERROOT.'/data');
		$vulnerableToNullByte = false;
		if(@file_exists(__FILE__."\0Nullbyte")) { // Check if the used PHP version is vulnerable to the NULL Byte attack (CVE-2006-7243)
			$vulnerableToNullByte = true;
		} 

		// Protect data directory here, so we can test if the protection is working
		\OC_Setup::protectDataDirectory();

		return array(
			'hasSQLite' => $hasSQLite,
			'hasMySQL' => $hasMySQL,
			'hasPostgreSQL' => $hasPostgreSQL,
			'hasOracle' => $hasOracle,
			'hasMSSQL' => $hasMSSQL,
			'directory' => $datadir,
			'secureRNG' => \OC_Util::secureRNGAvailable(),
			'htaccessWorking' => \OC_Util::isHtAccessWorking(),
			'vulnerableToNullByte' => $vulnerableToNullByte,
			'errors' => array(),
		);
	}
}
