<?php
/**
 * @author Bart Visscher <bartv@thisnet.nl>
 * @author Jakob Sack <mail@jakobsack.de>
 * @author Joas Schilling <nickvergessen@owncloud.com>
 * @author Jörn Friedrich Dreyer <jfd@butonic.de>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Thomas Müller <thomas.mueller@tmit.eu>
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

use JsonSerializable;

class OC_L10N_String implements JsonSerializable {
	/**
	 * @var OC_L10N
	 */
	protected $l10n;

	/**
	 * @var string
	 */
	protected $text;

	/**
	 * @var array
	 */
	protected $parameters;

	/**
	 * @var integer
	 */
	protected $count;

	/**
	 * @param OC_L10N $l10n
	 */
	public function __construct($l10n, $text, $parameters, $count = 1) {
		$this->l10n = $l10n;
		$this->text = $text;
		$this->parameters = $parameters;
		$this->count = $count;
	}

	public function __toString() {
		$translations = $this->l10n->getTranslations();

		$text = $this->text;
		if(array_key_exists($this->text, $translations)) {
			if(is_array($translations[$this->text])) {
				$fn = $this->l10n->getPluralFormFunction();
				$id = $fn($this->count);
				$text = $translations[$this->text][$id];
			}
			else{
				$text = $translations[$this->text];
			}
		}

		// Replace %n first (won't interfere with vsprintf)
		$text = str_replace('%n', $this->count, $text);
		return vsprintf($text, $this->parameters);
	}


	public function jsonSerialize() {
		return $this->__toString();
	}

}
