<?php
/**
 * Copyright (c) 2013 Frank Karlitschek frank@owncloud.org
 * Copyright (c) 2013 Georg Ehrke georg@ownCloud.com
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
namespace OC\Preview;

class Image extends Provider{

	public function getMimeType(){
		return '/image\/.*/';
	}

	public function getThumbnail($path,$maxX,$maxY,$scalingup,$fileview) {
		//get fileinfo
		$fileinfo = $fileview->getFileInfo($path);

		//check if file is encrypted
		if($fileinfo['encrypted'] === true){
			$image = new \OC_Image($fileview->fopen($path, 'r'));
		}else{
			$image = new \OC_Image();
			$image->loadFromFile($fileview->getLocalFile($path));
		}

		//check if image object is valid
		if (!$image->valid()) return false;

		return $image;
	}
}

\OC\Preview::registerProvider('OC\Preview\Image');