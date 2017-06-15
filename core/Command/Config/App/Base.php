<?php
/**
 * @copyright Copyright (c) 2016 Joas Schilling <coding@schilljs.com>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OC\Core\Command\Config\App;

use OCP\IConfig;
use Stecman\Component\Symfony\Console\BashCompletion\CompletionContext;

abstract class Base extends \OC\Core\Command\Base {

	/** * @var IConfig */
	protected $config;

	/**
	 * @param string $argumentName
	 * @param CompletionContext $context
	 * @return string[]
	 */
	public function completeArgumentValues($argumentName, CompletionContext $context) {
		if ($argumentName === 'app') {
			return \OC_App::getAllApps();
		}

		if ($argumentName === 'name') {
			$appName = $context->getWordAtIndex($context->getWordIndex() - 1);
			return $this->config->getAppKeys($appName);
		}
		return [];
	}
}
