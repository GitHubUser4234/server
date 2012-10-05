<?php
/**
 * Copyright (c) 2012 Bart Visscher <bartv@thisnet.nl>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

require_once('settings/routes.php');

// Core ajax actions
// AppConfig
$this->create('core_ajax_appconfig', '/core/ajax/appconfig.php')
	->actionInclude('core/ajax/appconfig.php');
// RequestToken
$this->create('core_ajax_requesttoken', '/core/ajax/requesttoken.php')
	->actionInclude('core/ajax/requesttoken.php');
// Share
$this->create('core_ajax_share', '/core/ajax/share.php')
	->actionInclude('core/ajax/share.php');
// Translations
$this->create('core_ajax_translations', '/core/ajax/translations.php')
	->actionInclude('core/ajax/translations.php');
// VCategories
$this->create('core_ajax_vcategories_add', '/core/ajax/vcategories/add.php')
	->actionInclude('core/ajax/vcategories/add.php');
$this->create('core_ajax_vcategories_delete', '/core/ajax/vcategories/delete.php')
	->actionInclude('core/ajax/vcategories/delete.php');
$this->create('core_ajax_vcategories_edit', '/core/ajax/vcategories/edit.php')
	->actionInclude('core/ajax/vcategories/edit.php');
// Routing
$this->create('core_ajax_routes', '/core/routes.json')
	->action('OC_Router', 'JSRoutes');

// Not specifically routed
$this->create('app_css', '/apps/{app}/{file}')
	->requirements(array('file' => '.*.css'))
	->action('OC', 'loadCSSFile');
$this->create('app_index_script', '/apps/{app}/')
	->defaults(array('file' => 'index.php'))
	//->requirements(array('file' => '.*.php'))
	->action('OC', 'loadAppScriptFile');
$this->create('app_script', '/apps/{app}/{file}')
	->defaults(array('file' => 'index.php'))
	->requirements(array('file' => '.*.php'))
	->action('OC', 'loadAppScriptFile');
