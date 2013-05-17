<?php
/**
 * Copyright (c) 2013 Frank Karlitschek frank@owncloud.org
 * Copyrigjt (c) 2013 Georg Ehrke georg@ownCloud.com
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
class OC_Preview_Image extends OC_Preview_Provider{

	public function getMimeType(){
		return '/image\/.*/';
	}
	
	public function getThumbnail($path,$maxX,$maxY,$scalingup,$fileview) {
		//new image object
		$image = new \OC_Image();
		$image->loadFromFile($fileview->getLocalFile($path));
		//check if image object is valid
		if (!$image->valid()) return false;

		return $image;
	}
}

OC_Preview::registerProvider('OC_Preview_Image');