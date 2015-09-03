<?php
/**
 * @author Joas Schilling <nickvergessen@owncloud.com>
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

namespace OC\Notification;

use OCP\Notification\IAction;

class Action implements IAction {

	/** @var string */
	protected $label;

	/** @var string */
	protected $labelParsed;

	/** @var string */
	protected $link;

	/** @var string */
	protected $requestType;

	/** @var string */
	protected $icon;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->label = '';
		$this->labelParsed = '';
		$this->link = '';
		$this->requestType = '';
		$this->icon = '';
	}

	/**
	 * @param string $label
	 * @return $this
	 * @throws \InvalidArgumentException if the label is invalid
	 * @since 8.2.0
	 */
	public function setLabel($label) {
		if (!is_string($label) || $label === '' || isset($label[32])) {
			throw new \InvalidArgumentException('The given label is invalid');
		}
		$this->label = $label;
		return $this;
	}

	/**
	 * @return string
	 * @since 8.2.0
	 */
	public function getLabel() {
		return $this->label;
	}

	/**
	 * @param string $label
	 * @return $this
	 * @throws \InvalidArgumentException if the label is invalid
	 * @since 8.2.0
	 */
	public function setParsedLabel($label) {
		if (!is_string($label) || $label === '') {
			throw new \InvalidArgumentException('The given parsed label is invalid');
		}
		$this->labelParsed = $label;
		return $this;
	}

	/**
	 * @return string
	 * @since 8.2.0
	 */
	public function getParsedLabel() {
		return $this->labelParsed;
	}

	/**
	 * @param string $link
	 * @param string $requestType
	 * @return $this
	 * @throws \InvalidArgumentException if the link is invalid
	 * @since 8.2.0
	 */
	public function setLink($link, $requestType) {
		if (!is_string($link) || $link === '' || isset($link[256])) {
			throw new \InvalidArgumentException('The given link is invalid');
		}
		if (!in_array($requestType, ['GET', 'POST', 'PUT', 'DELETE'], true)) {
			throw new \InvalidArgumentException('The given request type is invalid');
		}
		$this->link = $link;
		$this->requestType = $requestType;
		return $this;
	}

	/**
	 * @return string
	 * @since 8.2.0
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * @return string
	 * @since 8.2.0
	 */
	public function getRequestType() {
		return $this->requestType;
	}

	/**
	 * @param string $icon
	 * @return $this
	 * @throws \InvalidArgumentException if the icon is invalid
	 * @since 8.2.0
	 */
	public function setIcon($icon) {
		if (!is_string($icon) || $icon === '' || isset($icon[64])) {
			throw new \InvalidArgumentException('The given icon is invalid');
		}
		$this->icon = $icon;
		return $this;
	}

	/**
	 * @return string
	 * @since 8.2.0
	 */
	public function getIcon() {
		return $this->icon;
	}

	/**
	 * @return bool
	 */
	public function isValid() {
		return $this->label !== '' && $this->link !== '';
	}

	/**
	 * @return bool
	 */
	public function isValidParsed() {
		return $this->labelParsed !== '' && $this->link !== '';
	}
}
