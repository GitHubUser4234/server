<?php
/**
 * Copyright (c) 2012 Bart Visscher <bartv@thisnet.nl>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

class OC_TemplateLayout extends OC_Template {
	public function __construct( $renderas ){
		// Decide which page we show
		if( $renderas == 'user' ){
			parent::__construct( 'core', 'layout.user' );
			$this->assign('searchurl',OC_Helper::linkTo( 'search', 'index.php' ), false);
			if(array_search(OC_APP::getCurrentApp(),array('settings','admin','help'))!==false){
				$this->assign('bodyid','body-settings', false);
			}else{
				$this->assign('bodyid','body-user', false);
			}

			// Add navigation entry
			$navigation = OC_App::getNavigation();
			$this->assign( 'navigation', $navigation, false);
			$this->assign( 'settingsnavigation', OC_App::getSettingsNavigation(), false);
			foreach($navigation as $entry) {
				if ($entry['active']) {
					$this->assign( 'application', $entry['name'], false );
					break;
				}
			}
		}else{
			parent::__construct( 'core', 'layout.guest' );
		}

		// Add the core js files or the js files provided by the selected theme
		$jsfiles = $this->findScripts(OC_Util::$scripts);
		$this->assign('jsfiles', array(), false);
		foreach($jsfiles as $info) {
			$root = $info[0];
			$web = $info[1];
			$file = $info[2];
			$this->append( 'jsfiles', $web.'/'.$file);
		}

		// Add the css files
		$cssfiles = $this->findStyles(OC_Util::$styles);
		$this->assign('cssfiles', array());
		foreach($cssfiles as $info) {
			$root = $info[0];
			$web = $info[1];
			$file = $info[2];
			$paths = explode('/', $file);
			if($root == OC::$APPSROOT && $paths[0] == 'apps'){
				$app = $paths[1];
				unset($paths[0]);
				unset($paths[1]);
				$path = implode('/', $paths);
				$this->append( 'cssfiles', OC_Helper::linkTo($app, $path));
			}else{
				$this->append( 'cssfiles', $web.'/'.$file);
			}
		}
	}

	/*
	 * @brief append the $file-url if exist at $root
	 * @param $files array to append file info to
	 * @param $root path to check
	 * @param $web base for path
	 * @param $file the filename
	 */
        public function appendIfExist(&$files, $root, $webroot, $file) {
                if (is_file($root.'/'.$file)) {
			$files[] = array($root, $webroot, $file);
			return true;
                }
                return false;
        }

	public function findStyles($styles){
		// Read the selected theme from the config file
		$theme=OC_Config::getValue( 'theme' );

		// Read the detected formfactor and use the right file name.
		$fext = self::getFormFactorExtension();

		$files = array();
		foreach($styles as $style){
			// is it in 3rdparty?
			if($this->appendIfExist($files, OC::$THIRDPARTYROOT, OC::$THIRDPARTYWEBROOT, $style.'.css')) {

			// or in apps?
			}elseif($this->appendIfExist($files, OC::$APPSROOT, OC::$APPSWEBROOT, "apps/$style$fext.css" )) {
			}elseif($this->appendIfExist($files, OC::$APPSROOT, OC::$APPSWEBROOT, "apps/$style.css" )) {

			// or in the owncloud root?
			}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "$style$fext.css" )) {
			}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "$style.css" )) {

			// or in core ?
			}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "core/$style$fext.css" )) {
			}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "core/$style.css" )) {

			}else{
				echo('css file not found: style:'.$style.' formfactor:'.$fext.' webroot:'.OC::$WEBROOT.' serverroot:'.OC::$SERVERROOT);
				die();
			}
		}
		// Add the theme css files. you can override the default values here
		if(!empty($theme)) {
			foreach($styles as $style){
				     if($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "themes/$theme/apps/$style$fext.css" )) {
				}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "themes/$theme/apps/$style.css" )) {

				}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "themes/$theme/$style$fext.css" )) {
				}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "themes/$theme/$style.css" )) {

				}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "themes/$theme/core/$style$fext.css" )) {
				}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "themes/$theme/core/$style.css" )) {
				}
			}
		}
		return $files;
	}

	public function findScripts($scripts){
		// Read the selected theme from the config file
		$theme=OC_Config::getValue( 'theme' );

		// Read the detected formfactor and use the right file name.
		$fext = self::getFormFactorExtension();

		$files = array();
		foreach($scripts as $script){
			// Is it in 3rd party?
			if($this->appendIfExist($files, OC::$THIRDPARTYROOT, OC::$THIRDPARTYWEBROOT, $script.'.js')) {

			// Is it in apps and overwritten by the theme?
			}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "themes/$theme/apps/$script$fext.js" )) {
			}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "themes/$theme/apps/$script.js" )) {

			// Is it part of an app?
			}elseif($this->appendIfExist($files, OC::$APPSROOT, OC::$APPSWEBROOT, "apps/$script$fext.js" )) {
			}elseif($this->appendIfExist($files, OC::$APPSROOT, OC::$APPSWEBROOT, "apps/$script.js" )) {

			// Is it in the owncloud root but overwritten by the theme?
			}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "themes/$theme/$script$fext.js" )) {
			}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "themes/$theme/$script.js" )) {

			// Is it in the owncloud root ?
			}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "$script$fext.js" )) {
			}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "$script.js" )) {

			// Is in core but overwritten by a theme?
			}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "themes/$theme/core/$script$fext.js" )) {
			}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "themes/$theme/core/$script.js" )) {

			// Is it in core?
			}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "core/$script$fext.js" )) {
			}elseif($this->appendIfExist($files, OC::$SERVERROOT, OC::$WEBROOT, "core/$script.js" )) {

			}else{
				echo('js file not found: script:'.$script.' formfactor:'.$fext.' webroot:'.OC::$WEBROOT.' serverroot:'.OC::$SERVERROOT);
				die();

			}
		}
		return $files;
	}
}
