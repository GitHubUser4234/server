<?php
/**
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 *
 * @author Thomas Müller <thomas.mueller@tmit.eu>
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
namespace OCA\DAV\Command;

use OCA\DAV\CalDAV\CalDavBackend;
use OCA\DAV\Connector\Sabre\Principal;
use OCP\IDBConnection;
use OCP\IGroupManager;
use OCP\IUserManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCalendar extends Command {

	/** @var IUserManager */
	protected $userManager;

	/** @var IGroupManager $groupManager */
	private $groupManager;

	/** @var \OCP\IDBConnection */
	protected $dbConnection;

	/**
	 * @param IUserManager $userManager
	 * @param IDBConnection $dbConnection
	 */
	function __construct(IUserManager $userManager, IGroupManager $groupManager, IDBConnection $dbConnection) {
		parent::__construct();
		$this->userManager = $userManager;
		$this->groupManager = $groupManager;
		$this->dbConnection = $dbConnection;
	}

	protected function configure() {
		$this
			->setName('dav:create-calendar')
			->setDescription('Create a dav calendar')
			->addArgument('user',
				InputArgument::REQUIRED,
				'User for whom the calendar will be created')
			->addArgument('name',
				InputArgument::REQUIRED,
				'Name of the calendar');
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$user = $input->getArgument('user');
		if (!$this->userManager->userExists($user)) {
			throw new \InvalidArgumentException("User <$user> in unknown.");
		}
		$principalBackend = new Principal(
			$this->userManager,
			$this->groupManager
		);

		$name = $input->getArgument('name');
		$caldav = new CalDavBackend($this->dbConnection, $principalBackend);
		$caldav->createCalendar("principals/users/$user", $name, []);
	}
}
