<?php
/**
 * Copyright (c) 2012 Georg Ehrke <ownclouddev at georgswebsite dot de>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

 
OC_JSON::checkLoggedIn();
OCP\App::checkAppEnabled('contacts');
$tmpl = new OC_Template('contacts', 'part.import');
$tmpl->assign('path', $_POST['path']);
$tmpl->assign('filename', $_POST['filename']);
$tmpl->printpage();
?>
