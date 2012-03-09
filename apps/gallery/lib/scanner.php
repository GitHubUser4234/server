<?php

/**
* ownCloud - gallery application
*
* @author Bartek Przybylski
* @copyright 2012 Bartek Przybylski <bartek@alefzero.eu>
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

require_once('../../../lib/base.php');

class OC_Gallery_Scanner {

  public static function getScanningRoot() {
    return OC_Filesystem::getRoot().OC_Preferences::getValue(OC_User::getUser(), 'gallery', 'root', '/');
  }

  public static function scan($root) {
    $albums = array();
    self::scanDir($root, $albums);
    return $albums;
  }

  public static function cleanUp() {
    OC_Gallery_Album::cleanup();
  }

  public static function createName($name) {
    return basename($name);
  }

  public static function scanDir($path, &$albums) {
    $current_album = array('name'=> $path, 'imagesCount' => 0, 'images' => array());
    $current_album['name'] = self::createName($current_album['name']);

    if ($dh = OC_Filesystem::opendir($path.'/')) {
      while (($filename = readdir($dh)) !== false) {
        $filepath = ($path[strlen($path)-1]=='/'?$path:$path.'/').$filename;
        if (substr($filename, 0, 1) == '.') continue;
        if (self::isPhoto($path.'/'.$filename)) {
          $current_album['images'][] = $filepath;
        }
      }
    }
    $current_album['imagesCount'] = count($current_album['images']);
    $albums['imagesCount'] = $current_album['imagesCount'];
    $albums['albumName'] = utf8_encode($current_album['name']);

    $result = OC_Gallery_Album::find(OC_User::getUser(), /*$current_album['name']*/ null, $path);
    // don't duplicate galleries with same path (bug oc-33)
    if (!($albumId = $result->fetchRow()) && count($current_album['images'])) {
        OC_Gallery_Album::create(OC_User::getUser(), $current_album['name'], $path);
	    $result = OC_Gallery_Album::find(OC_User::getUser(), $current_album['name']);
	    $albumId = $result->fetchRow();
    }
    $albumId = $albumId['album_id'];
    foreach ($current_album['images'] as $img) {
      $result = OC_Gallery_Photo::find($albumId, $img);
      if (!$result->fetchRow()) {
	      OC_Gallery_Photo::create($albumId, $img);
      }
    }
    if (count($current_album['images'])) {
      self::createThumbnail($current_album['name'],$current_album['images']);
    }
  }

  public static function createThumbnail($albumName, $files) {
    $file_count = min(count($files), 10);
    $thumbnail = imagecreatetruecolor($file_count*200, 200);
    for ($i = 0; $i < $file_count; $i++) {
      $image = OC_Gallery_Photo::getThumbnail($files[$i]);
      if ($image && $image->valid()) {
	      imagecopyresampled($thumbnail, $image->resource(), $i*200, 0, 0, 0, 200, 200, 200, 200);
      }
    }
    imagepng($thumbnail, OC_Config::getValue("datadirectory").'/'. OC_User::getUser() .'/gallery/' . $albumName.'.png');
  }

  public static function isPhoto($filename) {
    $ext = strtolower(substr($filename, strrpos($filename, '.')+1));
    return $ext=='png' || $ext=='jpeg' || $ext=='jpg' || $ext=='gif';
  }

  public static function find_paths($path) {
  $images=OC_FileCache::searchByMime('image','', self::getScanningRoot());
	$paths=array();
	foreach($images as $image){
    $path=substr(dirname($image), strlen(self::getScanningRoot()));;
		if(array_search($path,$paths)===false){
			$paths[]=$path;
		}
	}
	return $paths;
  }
}

?>
