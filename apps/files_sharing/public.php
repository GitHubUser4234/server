<?php
// Load other apps for file previews
OC_App::loadApps();
if (isset($_GET['file'])) {
	$pos = strpos($_GET['file'], '/', 1);
	$uidOwner = substr($_GET['file'], 1, $pos - 1);
	if (OCP\User::userExists($uidOwner)) {
		OC_Util::setupFS($uidOwner);
		$file = substr($_GET['file'], $pos);
		$fileSource = OC_Filecache::getId($_GET['file'], '');
		if ($linkItem = OCP\Share::getItemSharedWithByLink('file', $fileSource, $uidOwner)) {
			if (isset($linkItem['share_with'])) {
				// Check password
				if (isset($_POST['password'])) {
					$password = $_POST['password'];
					$storedHash = $linkItem['share_with'];
					$forcePortable = (CRYPT_BLOWFISH != 1);
					$hasher = new PasswordHash(8, $forcePortable);
					if (!($hasher->CheckPassword($password.OC_Config::getValue('passwordsalt', ''), $storedHash))) {
						$tmpl = new OCP\Template('files_sharing', 'authenticate', 'guest');
						$tmpl->assign('error', true);
						$tmpl->printPage();
						exit();
					}
					// Continue on if password is valid
				} else {
					// Prompt for password
					$tmpl = new OCP\Template('files_sharing', 'authenticate', 'guest');
					$tmpl->printPage();
					exit();
				}
			}
			$path = $linkItem['path'];
			// Download the file
			if (isset($_GET['download'])) {
				$mimetype = OC_Filesystem::getMimeType($path);
				header('Content-Transfer-Encoding: binary');
				header('Content-Disposition: attachment; filename="'.basename($path).'"');
				header('Content-Type: '.$mimetype);
				header('Content-Length: '.OC_Filesystem::filesize($path));
				OCP\Response::disableCaching();
				@ob_clean();
				OC_Filesystem::readfile($path);
			} else {
				OCP\Util::addStyle('files_sharing', 'public');
				OCP\Util::addScript('files_sharing', 'public');
				OCP\Util::addScript('files', 'fileactions');
				$tmpl = new OCP\Template('files_sharing', 'public', 'guest');
				$tmpl->assign('owner', $uidOwner);
				$tmpl->assign('name', basename($path));
				// Show file list
				if (OC_Filesystem::is_dir($path)) {
					// TODO
				} else {
					// Show file preview if viewer is available
					$tmpl->assign('dir', dirname($path));
					$tmpl->assign('filename', basename($path));
					$tmpl->assign('mimetype', OC_Filesystem::getMimeType($path));
					$tmpl->assign('downloadURL', OCP\Util::linkToPublic('files').'&file='.$_GET['file'].'&download');
				}
				$tmpl->printPage();
			}
			exit();
		}
	}
}
header('HTTP/1.0 404 Not Found');
$tmpl = new OCP\Template('', '404', 'guest');
$tmpl->printPage();