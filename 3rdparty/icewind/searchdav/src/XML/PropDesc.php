<?php
/**
 * @copyright Copyright (c) 2017 Robin Appelman <robin@icewind.nl>
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

namespace SearchDAV\XML;


use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class PropDesc implements XmlSerializable {
	/**
	 * @var string[]
	 */
	public $properties = [];
	public $dataType;
	public $searchable;
	public $selectable;
	public $sortable;

	function xmlSerialize(Writer $writer) {
		$data = [
			'{DAV:}dataType' => [$this->dataType => null]
		];
		if ($this->searchable) {
			$data['{DAV:}searchable'] = null;
		}
		if ($this->sortable) {
			$data['{DAV:}sortable'] = null;
		}
		if ($this->selectable) {
			$data['{DAV:}selectable'] = null;
		}
		$writer->write(array_map(function ($propName) {
			return [
				'name' => '{DAV:}prop',
				'value' => $propName
			];
		}, $this->properties));
		$writer->write($data);
	}
}
