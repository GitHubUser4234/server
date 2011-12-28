<?php

require_once('base.php'); // base lib
require_once('images_utils.php');

class OC_Gallery_Scanner {

  public static function scan($root) {
    $albums = array();
    self::scanDir($root, $albums);
    return $albums;
  }

  public static function cleanUp() {
    $stmt = OC_DB::prepare('DELETE FROM *PREFIX*gallery_albums');
    $stmt->execute(array());
    $stmt = OC_DB::prepare('DELETE FROM *PREFIX*gallery_photos');
    $stmt->execute(array());
  }

  public static function scanDir($path, &$albums) {
    $current_album = array('name'=> $path, 'imagesCount' => 0, 'images' => array());
    $current_album['name'] = str_replace('/', '.', str_replace(OC::$CONFIG_DATADIRECTORY, '', $current_album['name']));
    $current_album['name'] = ($current_album['name']==='')?'main':$current_album['name'];

    if ($dh = OC_Filesystem::opendir($path)) {
      while (($filename = readdir($dh)) !== false) {
        $filepath = $path.'/'.$filename;
        if (substr($filename, 0, 1) == '.') continue;
        if (OC_Filesystem::is_dir($filepath)) {
          self::scanDir($filepath, $albums);
        } elseif (self::isPhoto($path.'/'.$filename)) {
          $current_album['images'][] = $filepath;
        }
      }
    }
    $current_album['imagesCount'] = count($current_album['images']);
    $albums[] = $current_album;

    $result = OC_Gallery_Album::find(OC_User::getUser(), $current_album['name']);
    if ($result->numRows() == 0 && count($current_album['images'])) {
	    OC_Gallery_Album::create(OC_User::getUser(), $current_album['name']);
	    $result = OC_Gallery_Album::find(OC_User::getUser(), $current_album['name']);
    }
    $albumId = $result->fetchRow();
    $albumId = $albumId['album_id'];
    foreach ($current_album['images'] as $img) {
      $result = OC_Gallery_Photo::find($albumId, $img);
      if ($result->numRows() == 0) {
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
      CroppedThumbnail(OC_Config::getValue("datadirectory").'/'. OC_User::getUser() .'/files/'.$files[$i], 200, 200, $thumbnail, $i*200);
    }
    imagepng($thumbnail, OC_Config::getValue("datadirectory").'/'. OC_User::getUser() .'/gallery/' . $albumName.'.png');
  }

  public static function isPhoto($filename) {
    if (substr(OC_Filesystem::getMimeType($filename), 0, 6) == "image/")
      return 1;
    return 0;
  }
}
?>
