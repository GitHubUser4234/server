<?php
/**
 * Copyright (c) 2012 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

class Test_Filestorage_Archive_Zip extends Test_FileStorage {
	/**
	 * @var string tmpDir
	 */
	public function setUp(){
		$tmpFile=OC_Helper::tmpFile('.zip');
		$this->instance=new OC_Filestorage_Archive(array('archive'=>$tmpFile));
	}
}

?>