<?php
/**
 * Copyright (c) 2013 Owen Winkler <ringmaster@midnightcircus.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OC\Core\Command;

use OC\Updater;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Upgrade extends Command {

	const ERROR_SUCCESS = 0;
	const ERROR_NOT_INSTALLED = 1;
	const ERROR_MAINTENANCE_MODE = 2;
	const ERROR_UP_TO_DATE = 3;

	protected function configure() {
		$this
			->setName('upgrade')
			->setDescription('run upgrade routines')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		global $RUNTIME_NOAPPS;

		$RUNTIME_NOAPPS = true; //no apps, yet

		require_once \OC::$SERVERROOT . '/lib/base.php';

		// Don't do anything if ownCloud has not been installed
		if(!\OC_Config::getValue('installed', false)) {
			$output->writeln('ownCloud has not yet been installed');
			return self::ERROR_NOT_INSTALLED;
		}

		if(\OC::checkUpgrade(false)) {
			$updater = new Updater();

			$updater->listen('\OC\Updater', 'maintenanceStart', function () use($output) {
				$output->writeln('Turned on maintenance mode');
			});
			$updater->listen('\OC\Updater', 'maintenanceEnd', function () use($output) {
				$output->writeln('Turned off maintenance mode');
				$output->writeln('Update successful');
			});
			$updater->listen('\OC\Updater', 'dbUpgrade', function () use($output) {
				$output->writeln('Updated database');
			});
			$updater->listen('\OC\Updater', 'filecacheStart', function () use($output) {
				$output->writeln('Updating filecache, this may take really long...');
			});
			$updater->listen('\OC\Updater', 'filecacheDone', function () use($output) {
				$output->writeln('Updated filecache');
			});
			$updater->listen('\OC\Updater', 'filecacheProgress', function ($out) use($output) {
				$output->writeln('... ' . $out . '% done ...');
			});

			$updater->listen('\OC\Updater', 'failure', function ($message) use($output) {
				$output->writeln($message);
				\OC_Config::setValue('maintenance', false);
			});

			$updater->upgrade();
			return self::ERROR_SUCCESS;
		} else if(\OC_Config::getValue('maintenance', false)) {
			//Possible scenario: ownCloud core is updated but an app failed
			$output->writeln('ownCloud is in maintenance mode');
			$output->write('Maybe an upgrade is already in process. Please check the '
				. 'logfile (data/owncloud.log). If you want to re-run the '
				. 'upgrade procedure, remove the "maintenance mode" from '
				. 'config.php and call this script again.'
				, true);
			return self::ERROR_MAINTENANCE_MODE;
		} else {
			$output->writeln('ownCloud is already latest version');
			return self::ERROR_UP_TO_DATE;
		}
	}
}
