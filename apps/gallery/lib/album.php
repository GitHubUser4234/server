<?php

/**
* ownCloud - gallery application
*
* @author Bartek Przybylski
* @copyright 2012 Bartek Przybylski bart.p.pl@gmail.com
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

class OC_Gallery_Album {
	public static function create($owner, $name, $path){
    $id = self::getParentPath($path);
		$stmt = OC_DB::prepare('INSERT INTO *PREFIX*gallery_albums (uid_owner, album_name, album_path, parent_path) VALUES (?, ?, ?, ?)');
		$stmt->execute(array($owner, $name, $path, $id));
	}

	public static function rename($oldname, $newname, $owner) {
	    $stmt = OC_DB::prepare('UPDATE *PREFIX*gallery_albums SET album_name=? WHERE uid_owner=? AND album_name=?');
		$stmt->execute(array($newname, $owner, $oldname));
	}

  public static function cleanup() {
    $albums = self::find(OC_User::getUser());
    while ($r = $albums->fetchRow()) {
      OC_Gallery_Photo::removeByAlbumId($r['album_id']);
      self::remove(OC_User::getUser(), $r['album_name']);
    }
  }

  public static function getParentPath($path) {
    if (strlen($path)==1) return '';
    $path = substr($path, 0, strrpos($path, '/'));
    if ($path == '') $path = '/';
    return $path;
  }

	public static function remove($owner, $name=null) {
		$sql = 'DELETE FROM *PREFIX*gallery_albums WHERE uid_owner = ?';
		$args = array($owner);
		if (!is_null($name)){
			$sql .= ' AND album_name = ?';
			$args[] = $name;
		}
		$stmt = OC_DB::prepare($sql);
		return $stmt->execute($args);
	}

  public static function removeByPath($path, $owner) {
    $album = self::find($owner, null, $path);
    $album = $album->fetchRow();
    self::remove($owner, $album['album_name']);
    OC_Gallery_Photo::removeByAlbumId($album['album_id']);
    // find and remove any gallery which might be stored lower in dir hierarchy
    $path = $path.'/%';
    $stmt = OC_DB::prepare('SELECT * FROM *PREFIX*gallery_albums WHERE album_path LIKE ? AND uid_owner = ?');
    $result = $stmt->execute(array($path, $owner));
    while (($album = $result->fetchRow())) {
      OC_Gallery_Photo::removeByAlbumId($album['album_id']);
      self::remove($owner, $album['album_name']);
    }
  }
	
  public static function find($owner, $name=null, $path=null, $parent=null){
		$sql = 'SELECT * FROM *PREFIX*gallery_albums WHERE uid_owner = ?';
		$args = array($owner);
		if (!is_null($name)){
			$sql .= ' AND album_name = ?';
			$args[] = $name;
    }
    if (!is_null($path)){
      $sql .= ' AND album_path = ?';
      $args[] = $path;
    }
    if (!is_null($parent)){
      $sql .= ' AND parent_path = ?';
      $args[] = $parent;
    }
    $order = OC_Preferences::getValue(OC_User::getUser(), 'gallery', 'order', 'ASC');
    $sql .= ' ORDER BY album_name ' . $order;

		$stmt = OC_DB::prepare($sql);
		return $stmt->execute($args);
	}

  public static function changePath($oldname, $newname, $owner) {
    $stmt = OC_DB::prepare('UPDATE *PREFIX*gallery_albums SET album_path=? WHERE uid_owner=? AND album_path=?');
    $stmt->execute(array($newname, $owner, $oldname));
  }

  public static function changeThumbnailPath($oldname, $newname) {
    require_once('../../../lib/base.php');
    $thumbpath = OC::$CONFIG_DATADIRECTORY.'/../gallery/';
    rename($thumbpath.$oldname.'.png', $thumbpath.$newname.'.png');
  }

}

?>
