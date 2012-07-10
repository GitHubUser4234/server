<?php

namespace OC\Pictures;

class DatabaseManager {
	private static $instance = null;
	protected $cache = array();
	const TAG = 'DatabaseManager';
	
	public static function getInstance() {
		if (self::$instance === null)
			self::$instance = new DatabaseManager();
		return self::$instance;
	}
	
	protected function getPathData($path) {
		$stmt = \OCP\DB::prepare('SELECT * FROM *PREFIX*pictures_images_cache
			WHERE uid_owner LIKE ? AND path like ? AND path not like ?');
		$path_match = $path.'/%';
		$path_notmatch = $path.'/%/%';
		$result = $stmt->execute(array(\OCP\USER::getUser(), $path_match, $path_notmatch));
		$this->cache[$path] = array();
		while (($row = $result->fetchRow()) != false) {
			$this->cache[$path][$row['path']] = $row;
		}
	}

	public function setFileData($path, $width, $height) {
		$stmt = \OCP\DB::prepare('INSERT INTO *PREFIX*pictures_images_cache (uid_owner, path, width, height) VALUES (?, ?, ?, ?)');
		$stmt->execute(array(\OCP\USER::getUser(), $path, $width, $height));
		$ret = array('path' => $path, 'width' => $width, 'height' => $height);
		unset($image);
		$this->cache[$dir][$path] = $ret;
		return $ret;
	}

	public function getFileData($path) {
		$gallery_path = \OCP\Config::getSystemValue( 'datadirectory' ).'/'.\OC_User::getUser().'/gallery';
		$path = $gallery_path.$path;
		$dir = dirname($path);
		if (!isset($this->cache[$dir])) {
			$this->getPathData($dir);
		}
		if (isset($this->cache[$dir][$path])) {
			return $this->cache[$dir][$path];
		}
		$image = new \OC_Image();
		if (!$image->loadFromFile($path)) {
			return false;
		}
		$ret = $this->setFileData($path, $image->width(), $image->height());
		unset($image);
		$this->cache[$dir][$path] = $ret;
		return $ret;
	}
	
	private function __construct() {}
}

class ThumbnailsManager {
	
	private static $instance = null;
	const TAG = 'ThumbnailManager';
	
	public static function getInstance() {
		if (self::$instance === null)
			self::$instance = new ThumbnailsManager();
		return self::$instance;
	}

	public function getThumbnail($path) {
		$gallery_path = \OCP\Config::getSystemValue( 'datadirectory' ).'/'.\OC_User::getUser().'/gallery';
		if (file_exists($gallery_path.$path)) {
			return new \OC_Image($gallery_path.$path);
		}
		if (!\OC_Filesystem::file_exists($path)) {
			\OC_Log::write(self::TAG, 'File '.$path.' don\'t exists', \OC_Log::WARN);
			return false;
		}
		$image = new \OC_Image();
		$image->loadFromFile(\OC_Filesystem::getLocalFile($path));
		if (!$image->valid()) return false;

		$image->fixOrientation();

		$ret = $image->preciseResize($this->getThumbnailWidth($image), $this->getThumbnailHeight($image));
		
		if (!$ret) {
			\OC_Log::write(self::TAG, 'Couldn\'t resize image', \OC_Log::ERROR);
			unset($image);
			return false;
		}

		$image->save($gallery_path.'/'.$path);
		return $image;
	}

	public function getThumbnailWidth($image) {
		return floor((150*$image->widthTopLeft())/$image->heightTopLeft());
	}

	public function getThumbnailHeight($image) {
		return 150;
	}

	public function getThumbnailInfo($path) {
		$arr = DatabaseManager::getInstance()->getFileData($path);
		if (!$arr) {
			if (!\OC_Filesystem::file_exists($path)) {
				\OC_Log::write(self::TAG, 'File '.$path.' don\'t exists', \OC_Log::WARN);
				return false;
			}
			$image = new \OC_Image();
			$image->loadFromFile(\OC_Filesystem::getLocalFile($path));
			if (!$image->valid()) {
				return false;
			}
			$arr = DatabaseManager::getInstance()->setFileData($path, $this->getThumbnailWidth($image), $this->getThumbnailHeight($image));
		}
		$ret = array('filepath' => $arr['path'],
					 'width' => $arr['width'],
					 'height' => $arr['height']);
		return $ret;
	}
	
	public function delete($path) {
		$thumbnail = \OCP\Config::getSystemValue('datadirectory').'/'.\OC_User::getUser()."/gallery".$path;
		if (file_exists($thumbnail)) {
			unlink($thumbnail);
		}
	}
	
	private function __construct() {}

}
