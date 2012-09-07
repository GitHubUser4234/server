<?php
/**
 * Copyright (c) 2012 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OC\Files\Storage;

/**
 * local storage backnd in temporary folder for testing purpores
 */
class Temporary extends OC\Files\Storage\Local{
	public function __construct($arguments) {
		$this->datadir=\OC_Helper::tmpFolder();
	}

	public function cleanUp() {
		\OC_Helper::rmdirr($this->datadir);
	}

	public function __destruct() {
		$this->cleanUp();
	}
}
