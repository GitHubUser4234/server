<?php

require_once('apps/files_versions/versions.php');

OCP\App::registerAdmin('files_versions', 'settings');
OCP\App::registerPersonal('files_versions','settings-personal');

OCP\Util::addscript('files_versions', 'versions');

// Listen to write signals
OCP\Util::connectHook('OC_Filesystem', 'post_write', "OCA_Versions\Storage", "write_hook");