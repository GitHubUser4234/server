<?php
/**
 * @copyright 2017, Roeland Jago Douma <roeland@famdouma.nl>
 *
 * @author Roeland Jago Douma <roeland@famdouma.nl>
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
namespace OC\Repair\NC13;

use OC\Log\Rotate;
use OCP\BackgroundJob\IJobList;
use OCP\Migration\IOutput;
use OCP\Migration\IRepairStep;

class AddLogRotateJob implements IRepairStep {

	/** @var IJobList */
	private $jobList;

	public function __construct(IJobList $jobList) {
		$this->jobList = $jobList;
	}

	public function getName() {
		return 'Add log rotate job';
	}

	public function run(IOutput $output) {
		$this->jobList->add(Rotate::class);
	}

}
