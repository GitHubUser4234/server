<?php
/**
 * @copyright Copyright (c) 2016, Joas Schilling <coding@schilljs.com>
 *
 * @author Joas Schilling <coding@schilljs.com>
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

namespace OCA\NextcloudAnnouncements\AppInfo;

use OCA\NextcloudAnnouncements\Notification\Notifier;
use OCP\AppFramework\App;

class Application extends App {

	const APP_ID = 'nextcloud_announcements';

	public function __construct() {
		parent::__construct(self::APP_ID);
	}

	public function register() {
		$this->registerNotificationNotifier();
	}

	protected function registerNotificationNotifier() {
		$this->getContainer()->getServer()->getNotificationManager()->registerNotifier(function() {
			return $this->getContainer()->query(Notifier::class);
		}, function() {
			$l = $this->getContainer()->getServer()->getL10NFactory()->get(self::APP_ID);
			return [
				'id' => self::APP_ID,
				'name' => $l->t('Nextcloud announcements'),
			];
		});
	}
}
