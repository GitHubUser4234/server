<?php
/**
 * Copyright (c) 2013 Georg Ehrke georg@ownCloud.com
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
namespace OC\Preview;

class MP3 extends Provider {

	public function getMimeType() {
		return '/audio\/mpeg/';
	}

	public function getThumbnail($path, $maxX, $maxY, $scalingup, $fileview) {
		require_once('getid3/getid3.php');

		$getID3 = new \getID3();

		$tmppath = $fileview->toTmpFile($path);

		//Todo - add stream support
		$tags = $getID3->analyze($tmppath); 
		\getid3_lib::CopyTagsToComments($tags); 
		$picture = @$tags['id3v2']['APIC'][0]['data'];

		unlink($tmppath);

		$image = new \OC_Image($picture);
		return $image->valid() ? $image : $this->getNoCoverThumbnail($maxX, $maxY);
	}

	public function getNoCoverThumbnail($maxX, $maxY) {
		$image = new \OC_Image();
		return $image;
	}

}

\OC\Preview::registerProvider('OC\Preview\MP3');