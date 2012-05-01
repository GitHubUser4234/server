<?php

$tmpl = new OC_Template( 'user_openid', 'settings');
$identity=OC_Preferences::getValue(OCP\USER::getUser(),'user_openid','identity','');
$tmpl->assign('identity',$identity);

OC_Util::addScript('user_openid','settings');

return $tmpl->fetchPage();
?>