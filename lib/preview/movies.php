<?php
/**
 * Copyright (c) 2013 Frank Karlitschek frank@owncloud.org
 * Copyright (c) 2013 Georg Ehrke georg@ownCloud.com
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
if(!is_null(shell_exec('ffmpeg -version'))){
	class OC_Preview_Movie extends OC_Preview_Provider{

		public function getMimeType(){
			return '/video\/.*/';
		}

		public function getThumbnail($path,$maxX,$maxY,$scalingup,$fileview) {
			$abspath = $fileview->getLocalfile($path);

			$tmppath = OC_Helper::tmpFile();

			$cmd = 'ffmpeg -y  -i ' . escapeshellarg($abspath) . ' -f mjpeg -vframes 1 -ss 1 -s ' . escapeshellarg($maxX) . 'x' . escapeshellarg($maxY) . ' ' . $tmppath;
			shell_exec($cmd);

			$image = new \OC_Image($tmppath);
			if (!$image->valid()) return false;

			return $image;
		}
	}
	OC_Preview::registerProvider('OC_Preview_Movie');
}