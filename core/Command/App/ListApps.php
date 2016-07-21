<?php
/**
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 *
 * @author Joas Schilling <coding@schilljs.com>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Robin Appelman <icewind@owncloud.com>
 * @author Victor Dubiniuk <dubiniuk@owncloud.com>
 *
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace OC\Core\Command\App;

use OC\Core\Command\Base;
use OCP\App\IAppManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ListApps extends Base {

	/** @var IAppManager */
	protected $manager;

	/**
	 * @param IAppManager $manager
	 */
	public function __construct(IAppManager $manager) {
		parent::__construct();
		$this->manager = $manager;
	}

	protected function configure() {
		parent::configure();

		$this
			->setName('app:list')
			->setDescription('List all available apps')
			->addOption(
				'shipped',
				null,
				InputOption::VALUE_REQUIRED,
				'true - limit to shipped apps only, false - limit to non-shipped apps only'
			)
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		if ($input->getOption('shipped') === 'true' || $input->getOption('shipped') === 'false'){
			$shippedFilter = $input->getOption('shipped') === 'true';
		} else {
			$shippedFilter = null;
		}
		
		$apps = \OC_App::getAllApps();
		$enabledApps = $disabledApps = [];
		$versions = \OC_App::getAppVersions();

		//sort enabled apps above disabled apps
		foreach ($apps as $app) {
			if ($shippedFilter !== null && \OC_App::isShipped($app) !== $shippedFilter){
				continue;
			}
			if ($this->manager->isInstalled($app)) {
				$enabledApps[] = $app;
			} else {
				$disabledApps[] = $app;
			}
		}

		$apps = ['enabled' => [], 'disabled' => []];

		sort($enabledApps);
		foreach ($enabledApps as $app) {
			$apps['enabled'][$app] = (isset($versions[$app])) ? $versions[$app] : true;
		}

		sort($disabledApps);
		foreach ($disabledApps as $app) {
			$apps['disabled'][$app] = null;
		}

		$this->writeAppList($input, $output, $apps);
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @param array $items
	 */
	protected function writeAppList(InputInterface $input, OutputInterface $output, $items) {
		switch ($input->getOption('output')) {
			case self::OUTPUT_FORMAT_PLAIN:
				$output->writeln('Enabled:');
				parent::writeArrayInOutputFormat($input, $output, $items['enabled']);

				$output->writeln('Disabled:');
				parent::writeArrayInOutputFormat($input, $output, $items['disabled']);
			break;

			default:
				parent::writeArrayInOutputFormat($input, $output, $items);
			break;
		}
	}
}
