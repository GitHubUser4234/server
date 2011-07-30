<?php

/**
* ownCloud - media plugin
*
* @author Robin Appelman
* @copyright 2010 Robin Appelman icewind1991@gmail.com
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
* You should have received a copy of the GNU Lesser General Public 
* License along with this library.  If not, see <http://www.gnu.org/licenses/>.
* 
*/


require_once('../../lib/base.php');

// Check if we are a user
if( !OC_User::isLoggedIn()){
	header( "Location: ".OC_Helper::linkTo( '', 'index.php' ));
	exit();
}

require_once('lib_collection.php');
require_once('lib_scanner.php');

OC_Util::addScript('media','player');
OC_Util::addScript('media','music');
OC_Util::addScript('media','playlist');
OC_Util::addScript('media','collection');
OC_Util::addScript('media','jquery.jplayer.min');
OC_Util::addStyle('media','player');
OC_Util::addStyle('media','music');

OC_App::setActiveNavigationEntry( 'media_playlist' );

$tmpl = new OC_Template( 'media', 'music', 'user' );

$player = new OC_Template( 'media', 'player');
$playlist = new OC_Template( 'media', 'playlist');
$collection= new OC_Template( 'media', 'collection');

$tmpl->assign('player',$player->fetchPage());
$tmpl->assign('playlist',$playlist->fetchPage());
$tmpl->assign('collection',$collection->fetchPage());
$tmpl->printPage();
?>
 
