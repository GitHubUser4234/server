<?php
/**
* ownCloud
*
* @author Michael Gapczynski
* @copyright 2012 Michael Gapczynski mtgap@owncloud.com
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
* You should have received a copy of the GNU Affero General Public
* License along with this library.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace OC\Files\Cache;

/**
 * check the storage backends for updates and change the cache accordingly
 */
class Shared_Watcher extends Watcher {

	/**
	 * @brief get file owner and path
	 * @param string $filename
	 * @return array with the oweners uid and the owners path
	 */
	private static function getUidAndFilename($filename) {
		// FIXME: duplicate of Updater::getUidAndFilename()
		$uid = \OC\Files\Filesystem::getOwner($filename);
		\OC\Files\Filesystem::initMountPoints($uid);

		if ($uid != \OCP\User::getUser()) {
			$info = \OC\Files\Filesystem::getFileInfo($filename);
			$ownerView = new \OC\Files\View('/' . $uid . '/files');
			$filename = $ownerView->getPath($info['fileid']);
		}
		return array($uid, '/files/' . $filename);
	}

	/**
	 * check $path for updates
	 *
	 * @param string $path
	 */
	public function checkUpdate($path) {
		if ($path != '' && parent::checkUpdate($path)) {
			// since checkUpdate() has already updated the size of the subdirs,
			// only apply the update to the owner's parent dirs

			// find last parent before reaching the shared storage root,
			// which is the actual shared dir from the owner
			$baseDir = substr($path, 0, strpos($path, '/'));

			// find the path relative to the data dir
			$file = $this->storage->getFile($baseDir);
			$view = new \OC\Files\View('/' . $file['fileOwner']);

			// find the owner's storage and path
			list($storage, $internalPath) = $view->resolvePath($file['path']);

			// update the parent dirs' sizes in the owner's cache
			$storage->getCache()->correctFolderSize(dirname($internalPath));
		}
	}

	/**
	 * remove deleted files in $path from the cache
	 *
	 * @param string $path
	 */
	public function cleanFolder($path) {
		if ($path != '') {
			parent::cleanFolder($path);
		}
	}

}
