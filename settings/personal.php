<?php

require_once('../lib/base.php');
if( !OC_User::isLoggedIn()){
    header( "Location: ".OC_Helper::linkTo( "", "index.php" ));
    exit();
}

// Highlight navigation entry
OC_Util::addScript( "settings", "personal" );
OC_Util::addStyle( "settings", "settings" );
OC_App::setActiveNavigationEntry( "settings" );

// calculate the disc space
$used=OC_Filesystem::filesize('/');
$free=OC_Filesystem::free_space();
$total=$free+$used;
$relative=round(($used/$total)*100);

$lang=OC_Preferences::getValue( OC_User::getUser(), 'core', 'lang', 'en' );
$languages=OC_L10N::findAvailableLanguages();
//put the current language in the front
unset($languages[array_search($lang,$languages)]);
array_unshift($languages,$lang);

// Return template
$tmpl = new OC_Template( "settings", "personal", "user");
$tmpl->assign('usage',OC_Helper::humanFileSize($used));
$tmpl->assign('total_space',OC_Helper::humanFileSize($total));
$tmpl->assign('usage_relative',$relative);
$tmpl->assign('languages',$languages);

$forms=OC_App::getForms('personal');
$tmpl->assign('forms',array());
foreach($forms as $form){
	$tmpl->append('forms',$form);
}
$tmpl->printPage();

?>
