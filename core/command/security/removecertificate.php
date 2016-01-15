<?php
/**
 * @author Robin Appelman <icewind@owncloud.com>
 *
 * @copyright Copyright (c) 2015, ownCloud, Inc.
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

namespace OC\Core\Command\Security;

use OC\Core\Command\Base;
use OCP\ICertificateManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveCertificate extends Base {

	/** @var ICertificateManager */
	protected $certificateManager;

	public function __construct(ICertificateManager $certificateManager) {
		$this->certificateManager = $certificateManager;
		parent::__construct();
	}

	protected function configure() {
		$this
			->setName('security:certificates:remove')
			->setDescription('import trusted certificate')
			->addArgument(
				'name',
				InputArgument::REQUIRED,
				'the file name of the certificate to remove'
			);
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$name = $input->getArgument('name');

		$this->certificateManager->removeCertificate($name);
	}
}
