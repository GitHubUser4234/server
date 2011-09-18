<?php

/**
* ownCloud - bookmarks plugin
*
* @author Arthur Schiwon
* @copyright 2011 Arthur Schiwon blizzz@arthur-schiwon.de
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
OC_Util::checkLoggedIn();

require_once('bookmarksHelper.php');

OC_App::setActiveNavigationEntry( 'bookmarks_index' );

OC_Util::addScript('bookmarks','addBm');
OC_Util::addStyle('bookmarks', 'bookmarks');

$tmpl = new OC_Template( 'bookmarks', 'addBm', 'user' );

$url = isset($_GET['url']) ? urldecode($_GET['url']) : '';
$metadata = getURLMetadata($url);

$tmpl->assign('URL', htmlentities($metadata['url']));
$tmpl->assign('TITLE', htmlentities($metadata['title']));
$tmpl->assign('DESCRIPTION', htmlentities($metadata['description']));

$tmpl->printPage();
