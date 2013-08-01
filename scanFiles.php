<?php

require_once __DIR__ . '/lib/base.php';

if (!OC::$CLI) {
	echo "This script can be run from the command line only\n";
	return;
}
if (count($argv) !== 2) {
	echo "Usage:" . PHP_EOL;
	echo " php scanFiles.php <user_id>" . PHP_EOL;
	echo "  will rescan all files of the given user" . PHP_EOL;
	echo " php scanFiles.php --all" . PHP_EOL;
	echo "  will rescan all files of all known users" . PHP_EOL;
	return;
}

function scanFiles($user) {
	$scanner = new \OC\Files\Utils\Scanner($user);
	$scanner->listen('\OC\Files\Utils\Scanner', 'scanFile', function($path) {
		echo "Scanning $path" . PHP_EOL;
	});
	$scanner->listen('\OC\Files\Utils\Scanner', 'scanFolder', function($path) {
		echo "Scanning $path" . PHP_EOL;
	});
	$scanner->scan('');
}

if ($argv[1] === '--all') {
	$users = OC_User::getUsers();
} else {
	$users = array($argv[1]);
}

foreach ($users as $user) {
	scanFiles($user);
}
