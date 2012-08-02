<?php
/**
 * ownCloud
 *
 * @author Frank Karlitschek
 * @copyright 2012 Frank Karlitschek frank@owncloud.org
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

/**
 * Class that is a namespace for all global OC variables
 * No, we can not put this class in its own file because it is used by
 * OC_autoload!
 */
class OC{
	/**
	 * Assoziative array for autoloading. classname => filename
	 */
	public static $CLASSPATH = array();
	/**
	 * The installation path for owncloud on the server (e.g. /srv/http/owncloud)
	 */
	public static $SERVERROOT = '';
	/**
	 * the current request path relative to the owncloud root (e.g. files/index.php)
	 */
	private static $SUBURI = '';
	/**
	 * the owncloud root path for http requests (e.g. owncloud/)
	 */
	public static $WEBROOT = '';
	/**
	 * The installation path of the 3rdparty folder on the server (e.g. /srv/http/owncloud/3rdparty)
	 */
	public static $THIRDPARTYROOT = '';
	/**
	 * the root path of the 3rdparty folder for http requests (e.g. owncloud/3rdparty)
	 */
	public static $THIRDPARTYWEBROOT = '';
	/**
	 * The installation path array of the apps folder on the server (e.g. /srv/http/owncloud) 'path' and web path in 'url'
	 */
	public static $APPSROOTS = array();
	/*
	 * requested app
	 */
	public static $REQUESTEDAPP = '';
	/*
	 * requested file of app
	 */
	public static $REQUESTEDFILE = '';
	/**
	 * check if owncloud runs in cli mode
	 */
	public static $CLI = false;
	/*
	 * OC router
	 */
	protected static $router = null;
	/**
	 * SPL autoload
	 */
	public static function autoload($className){
		if(array_key_exists($className,OC::$CLASSPATH)){
			/** @TODO: Remove this when necessary
			 Remove "apps/" from inclusion path for smooth migration to mutli app dir
			*/
			$path = preg_replace('/apps\//','', OC::$CLASSPATH[$className]);
			require_once $path;
		}
		elseif(strpos($className,'OC_')===0){
			require_once strtolower(str_replace('_','/',substr($className,3)) . '.php');
		}
		elseif(strpos($className,'OCP\\')===0){
			require_once 'public/'.strtolower(str_replace('\\','/',substr($className,3)) . '.php');
		}
		elseif(strpos($className,'OCA\\')===0){
			require_once 'apps/'.strtolower(str_replace('\\','/',substr($className,3)) . '.php');
		}
		elseif(strpos($className,'Sabre_')===0) {
			require_once str_replace('_','/',$className) . '.php';
		}
		elseif(strpos($className,'Symfony\\')===0){
			require_once str_replace('\\','/',$className) . '.php';
		}
		elseif(strpos($className,'Test_')===0){
			require_once 'tests/lib/'.strtolower(str_replace('_','/',substr($className,5)) . '.php');
		}
	}

	public static function initPaths(){
		// calculate the root directories
		OC::$SERVERROOT=str_replace("\\",'/',substr(__FILE__,0,-13));
		OC::$SUBURI= str_replace("\\","/",substr(realpath($_SERVER["SCRIPT_FILENAME"]),strlen(OC::$SERVERROOT)));
		$scriptName=$_SERVER["SCRIPT_NAME"];
		if(substr($scriptName,-1)=='/'){
			$scriptName.='index.php';
			//make sure suburi follows the same rules as scriptName
			if(substr(OC::$SUBURI,-9)!='index.php'){
				if(substr(OC::$SUBURI,-1)!='/'){
					OC::$SUBURI=OC::$SUBURI.'/';
				}
				OC::$SUBURI=OC::$SUBURI.'index.php';
			}
		}
                OC::$WEBROOT=substr($scriptName,0,strlen($scriptName)-strlen(OC::$SUBURI));

		if(OC::$WEBROOT!='' and OC::$WEBROOT[0]!=='/'){
			OC::$WEBROOT='/'.OC::$WEBROOT;
		}

		// ensure we can find OC_Config
		set_include_path(
			OC::$SERVERROOT.'/lib'.PATH_SEPARATOR.
			get_include_path()
		);

		// search the 3rdparty folder
		if(OC_Config::getValue('3rdpartyroot', '')<>'' and OC_Config::getValue('3rdpartyurl', '')<>''){
			OC::$THIRDPARTYROOT=OC_Config::getValue('3rdpartyroot', '');
			OC::$THIRDPARTYWEBROOT=OC_Config::getValue('3rdpartyurl', '');
		}elseif(file_exists(OC::$SERVERROOT.'/3rdparty')){
			OC::$THIRDPARTYROOT=OC::$SERVERROOT;
			OC::$THIRDPARTYWEBROOT=OC::$WEBROOT;
		}elseif(file_exists(OC::$SERVERROOT.'/../3rdparty')){
			OC::$THIRDPARTYWEBROOT=rtrim(dirname(OC::$WEBROOT), '/');
			OC::$THIRDPARTYROOT=rtrim(dirname(OC::$SERVERROOT), '/');
		}else{
			echo("3rdparty directory not found! Please put the ownCloud 3rdparty folder in the ownCloud folder or the folder above. You can also configure the location in the config.php file.");
			exit;
		}
		// search the apps folder
		$config_paths = OC_Config::getValue('apps_paths', array());
		if(! empty($config_paths)){
			foreach($config_paths as $paths) {
				if( isset($paths['url']) && isset($paths['path'])) {
					$paths['url'] = rtrim($paths['url'],'/');
					$paths['path'] = rtrim($paths['path'],'/');
					OC::$APPSROOTS[] = $paths;
				}
			}
		}elseif(file_exists(OC::$SERVERROOT.'/apps')){
			OC::$APPSROOTS[] = array('path'=> OC::$SERVERROOT.'/apps', 'url' => '/apps', 'writable' => true);
		}elseif(file_exists(OC::$SERVERROOT.'/../apps')){
			OC::$APPSROOTS[] = array('path'=> rtrim(dirname(OC::$SERVERROOT), '/').'/apps', 'url' => '/apps', 'writable' => true);
		}

		if(empty(OC::$APPSROOTS)){
			echo("apps directory not found! Please put the ownCloud apps folder in the ownCloud folder or the folder above. You can also configure the location in the config.php file.");
			exit;
		}
		$paths = array();
		foreach( OC::$APPSROOTS as $path)
			$paths[] = $path['path'];

		// set the right include path
		set_include_path(
			OC::$SERVERROOT.'/lib'.PATH_SEPARATOR.
			OC::$SERVERROOT.'/config'.PATH_SEPARATOR.
			OC::$THIRDPARTYROOT.'/3rdparty'.PATH_SEPARATOR.
			implode($paths,PATH_SEPARATOR).PATH_SEPARATOR.
			get_include_path().PATH_SEPARATOR.
			OC::$SERVERROOT
		);
	}

	public static function checkInstalled() {
		// Redirect to installer if not installed
		if (!OC_Config::getValue('installed', false) && OC::$SUBURI != '/index.php') {
			if(!OC::$CLI){
				$url = 'http://'.$_SERVER['SERVER_NAME'].OC::$WEBROOT.'/index.php';
				header("Location: $url");
			}
			exit();
		}
	}

	public static function checkSSL() {
		// redirect to https site if configured
		if( OC_Config::getValue( "forcessl", false )){
			ini_set("session.cookie_secure", "on");
			if(OC_Helper::serverProtocol()<>'https' and !OC::$CLI) {
				$url = "https://". OC_Helper::serverHost() . $_SERVER['REQUEST_URI'];
				header("Location: $url");
				exit();
			}
		}
	}

	public static function checkUpgrade() {
		if(OC_Config::getValue('installed', false)){
			$installedVersion=OC_Config::getValue('version','0.0.0');
			$currentVersion=implode('.',OC_Util::getVersion());
			if (version_compare($currentVersion, $installedVersion, '>')) {
				OC_Log::write('core','starting upgrade from '.$installedVersion.' to '.$currentVersion,OC_Log::DEBUG);
				$result=OC_DB::updateDbFromStructure(OC::$SERVERROOT.'/db_structure.xml');
				if(!$result){
					echo 'Error while upgrading the database';
					die();
				}
				if(file_exists(OC::$SERVERROOT."/config/config.php") and !is_writable(OC::$SERVERROOT."/config/config.php")) {
					$tmpl = new OC_Template( '', 'error', 'guest' );
					$tmpl->assign('errors',array(1=>array('error'=>"Can't write into config directory 'config'",'hint'=>"You can usually fix this by giving the webserver user write access to the config directory in owncloud")));
					$tmpl->printPage();
					exit;
				}

				OC_Config::setValue('version',implode('.',OC_Util::getVersion()));
				OC_App::checkAppsRequirements();
				// load all apps to also upgrade enabled apps
				OC_App::loadApps();
			}
		}
	}

	public static function initTemplateEngine() {
		// Add the stuff we need always
		OC_Util::addScript( "jquery-1.7.2.min" );
		OC_Util::addScript( "jquery-ui-1.8.16.custom.min" );
		OC_Util::addScript( "jquery-showpassword" );
		OC_Util::addScript( "jquery.infieldlabel.min" );
		OC_Util::addScript( "jquery-tipsy" );
		OC_Util::addScript( "oc-dialogs" );
		OC_Util::addScript( "js" );
		OC_Util::addScript( "eventsource" );
		OC_Util::addScript( "config" );
		//OC_Util::addScript( "multiselect" );
		OC_Util::addScript('search','result');
		OC_Util::addStyle( "styles" );
		OC_Util::addStyle( "multiselect" );
		OC_Util::addStyle( "jquery-ui-1.8.16.custom" );
		OC_Util::addStyle( "jquery-tipsy" );
	}

	public static function initSession() {
		ini_set('session.cookie_httponly','1;');
		session_start();
	}

	public static function loadapp(){
		if(file_exists(OC_App::getAppPath(OC::$REQUESTEDAPP) . '/index.php')){
			require_once(OC_App::getAppPath(OC::$REQUESTEDAPP) . '/index.php');
		}else{
			trigger_error('The requested App was not found.', E_USER_ERROR);//load default app instead?
		}
	}

	public static function loadfile(){
		if(file_exists(OC_App::getAppPath(OC::$REQUESTEDAPP) . '/' . OC::$REQUESTEDFILE)){
			if(substr(OC::$REQUESTEDFILE, -3) == 'css'){
				$file = OC_App::getAppWebPath(OC::$REQUESTEDAPP). '/' . OC::$REQUESTEDFILE;
				$minimizer = new OC_Minimizer_CSS();
				$minimizer->output(array(array(OC_App::getAppPath(OC::$REQUESTEDAPP), OC_App::getAppWebPath(OC::$REQUESTEDAPP), OC::$REQUESTEDFILE)),$file);
				exit;
			}elseif(substr(OC::$REQUESTEDFILE, -3) == 'php'){
				require_once(OC_App::getAppPath(OC::$REQUESTEDAPP). '/' . OC::$REQUESTEDFILE);
			}
		}else{
			die();
			header('HTTP/1.0 404 Not Found');
			exit;
		}
	}

	public static function getRouter() {
		if (!isset(OC::$router)) {
			OC::$router = new OC_Router();
		}

		return OC::$router;
	}

	public static function init(){
		// register autoloader
		spl_autoload_register(array('OC','autoload'));
		setlocale(LC_ALL, 'en_US.UTF-8');

		// set some stuff
		//ob_start();
		error_reporting(E_ALL | E_STRICT);
		if (defined('DEBUG') && DEBUG){
			ini_set('display_errors', 1);
		}
		self::$CLI=(php_sapi_name() == 'cli');

		date_default_timezone_set('UTC');
		ini_set('arg_separator.output','&amp;');

		// try to switch magic quotes off.
		if(function_exists('set_magic_quotes_runtime')) {
			@set_magic_quotes_runtime(false);
		}

		//try to configure php to enable big file uploads.
		//this doesn´t work always depending on the webserver and php configuration.
		//Let´s try to overwrite some defaults anyways

		//try to set the maximum execution time to 60min
		@set_time_limit(3600);
		@ini_set('max_execution_time',3600);
		@ini_set('max_input_time',3600);

		//try to set the maximum filesize to 10G
		@ini_set('upload_max_filesize','10G');
		@ini_set('post_max_size','10G');
		@ini_set('file_uploads','50');

		//try to set the session lifetime to 60min
		@ini_set('gc_maxlifetime','3600');


		//set http auth headers for apache+php-cgi work around
		if (isset($_SERVER['HTTP_AUTHORIZATION']) && preg_match('/Basic\s+(.*)$/i', $_SERVER['HTTP_AUTHORIZATION'], $matches))
		{
			list($name, $password) = explode(':', base64_decode($matches[1]));
			$_SERVER['PHP_AUTH_USER'] = strip_tags($name);
			$_SERVER['PHP_AUTH_PW'] = strip_tags($password);
		}

		//set http auth headers for apache+php-cgi work around if variable gets renamed by apache
		if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']) && preg_match('/Basic\s+(.*)$/i', $_SERVER['REDIRECT_HTTP_AUTHORIZATION'], $matches))
		{
			list($name, $password) = explode(':', base64_decode($matches[1]));
			$_SERVER['PHP_AUTH_USER'] = strip_tags($name);
			$_SERVER['PHP_AUTH_PW'] = strip_tags($password);
		}

		self::initPaths();

		// register the stream wrappers
		require_once('streamwrappers.php');
		stream_wrapper_register("fakedir", "OC_FakeDirStream");
		stream_wrapper_register('static', 'OC_StaticStreamWrapper');
		stream_wrapper_register('close', 'OC_CloseStreamWrapper');

		self::checkInstalled();
		self::checkSSL();
		self::initSession();
		self::initTemplateEngine();
		self::checkUpgrade();

		$errors=OC_Util::checkServer();
		if(count($errors)>0) {
			OC_Template::printGuestPage('', 'error', array('errors' => $errors));
			exit;
		}

		// User and Groups
		if( !OC_Config::getValue( "installed", false )){
			$_SESSION['user_id'] = '';
		}

		OC_User::useBackend(new OC_User_Database());
		OC_Group::useBackend(new OC_Group_Database());

		// Load Apps
		// This includes plugins for users and filesystems as well
		global $RUNTIME_NOAPPS;
		global $RUNTIME_APPTYPES;
		if(!$RUNTIME_NOAPPS ){
			if($RUNTIME_APPTYPES){
				OC_App::loadApps($RUNTIME_APPTYPES);
			}else{
				OC_App::loadApps();
			}
		}

		// Check for blacklisted files
		OC_Hook::connect('OC_Filesystem','write','OC_Filesystem','isBlacklisted');

		//make sure temporary files are cleaned up
		register_shutdown_function(array('OC_Helper','cleanTmp'));

		//parse the given parameters
		self::$REQUESTEDAPP = (isset($_GET['app']) && trim($_GET['app']) != '' && !is_null($_GET['app'])?str_replace(array('\0', '/', '\\', '..'), '', strip_tags($_GET['app'])):OC_Config::getValue('defaultapp', 'files'));
		if(substr_count(self::$REQUESTEDAPP, '?') != 0){
			$app = substr(self::$REQUESTEDAPP, 0, strpos(self::$REQUESTEDAPP, '?'));
			$param = substr(self::$REQUESTEDAPP, strpos(self::$REQUESTEDAPP, '?') + 1);
			parse_str($param, $get);
			$_GET = array_merge($_GET, $get);
			self::$REQUESTEDAPP = $app;
			$_GET['app'] = $app;
		}
		self::$REQUESTEDFILE = (isset($_GET['getfile'])?$_GET['getfile']:null);
		if(substr_count(self::$REQUESTEDFILE, '?') != 0){
			$file = substr(self::$REQUESTEDFILE, 0, strpos(self::$REQUESTEDFILE, '?'));
			$param = substr(self::$REQUESTEDFILE, strpos(self::$REQUESTEDFILE, '?') + 1);
			parse_str($param, $get);
			$_GET = array_merge($_GET, $get);
			self::$REQUESTEDFILE = $file;
			$_GET['getfile'] = $file;
		}
		if(!is_null(self::$REQUESTEDFILE)){
			$subdir = OC_App::getAppPath(OC::$REQUESTEDAPP) . '/' . self::$REQUESTEDFILE;
			$parent = OC_App::getAppPath(OC::$REQUESTEDAPP);
			if(!OC_Helper::issubdirectory($subdir, $parent)){
				self::$REQUESTEDFILE = null;
				header('HTTP/1.0 404 Not Found');
				exit;
			}
		}
	}
}

// define runtime variables - unless this already has been done
if( !isset( $RUNTIME_NOSETUPFS )){
	$RUNTIME_NOSETUPFS = false;
}
if( !isset( $RUNTIME_NOAPPS )){
	$RUNTIME_NOAPPS = false;
}

if(!function_exists('get_temp_dir')) {
	function get_temp_dir() {
		if( $temp=ini_get('upload_tmp_dir') )        return $temp;
		if( $temp=getenv('TMP') )        return $temp;
		if( $temp=getenv('TEMP') )        return $temp;
		if( $temp=getenv('TMPDIR') )    return $temp;
		$temp=tempnam(__FILE__,'');
		if (file_exists($temp)) {
			unlink($temp);
			return dirname($temp);
		}
		if( $temp=sys_get_temp_dir())    return $temp;

		return null;
	}
}

OC::init();
