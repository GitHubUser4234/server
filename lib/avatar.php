<?php
/**
 * Copyright (c) 2013 Christopher Schäpers <christopher@schaepers.it>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

/**
 * This class gets and sets users avatars.
 */

class OC_Avatar {
	/**
	 * @brief get the users avatar
	 * @param $user string which user to get the avatar for
	 * @param $size integer size in px of the avatar, defaults to 64
	 * @return boolean|\OC_Image containing the avatar or false if there's no image
	*/
	public function get ($user, $size = 64) {
		$view = new \OC\Files\View('/'.$user);

		if ($view->file_exists('avatar.jpg')) {
			$ext = 'jpg';
		} elseif ($view->file_exists('avatar.png')) {
			$ext = 'png';
		} else {
			return false;
		}

		$avatar = new OC_Image();
		$avatar->loadFromData($view->file_get_contents('avatar.'.$ext));
		$avatar->resize($size);
		return $avatar;
	}

	/**
	 * @brief sets the users avatar
	 * @param $user string user to set the avatar for
	 * @param $data mixed imagedata or path to set a new avatar
	 * @throws Exception if the provided file is not a jpg or png image
	 * @throws Exception if the provided image is not valid
	 * @throws \OC\NotSquareException if the image is not square
	 * @return void
	*/
	public function set ($user, $data) {
		if (\OC_Appconfig::getValue('files_encryption', 'enabled') === "yes") {
			$l = \OC_L10N::get('lib');
			throw new \Exception($l->t("Custom profile pictures don't work with encryption yet"));
		}

		$view = new \OC\Files\View('/'.$user);

		$img = new OC_Image($data);
		$type = substr($img->mimeType(), -3);
		if ($type === 'peg') { $type = 'jpg'; }
		if ($type !== 'jpg' && $type !== 'png') {
			$l = \OC_L10N::get('lib');
			throw new \Exception($l->t("Unknown filetype"));
		}

		if (!$img->valid()) {
			$l = \OC_L10N::get('lib');
			throw new \Exception($l->t("Invalid image"));
		}

		if (!($img->height() === $img->width())) {
			throw new \OC\NotSquareException();
		}

		$view->unlink('avatar.jpg');
		$view->unlink('avatar.png');
		$view->file_put_contents('avatar.'.$type, $data);
	}

	/**
	 * @brief remove the users avatar
	 * @param $user string user to delete the avatar from
	 * @return void
	*/
	public function remove ($user) {
		$view = new \OC\Files\View('/'.$user);
		$view->unlink('avatar.jpg');
		$view->unlink('avatar.png');
	}
}
