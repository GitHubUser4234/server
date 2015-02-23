<?php
/**
 * @author Joas Schilling <nickvergessen@gmx.de>
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
// use OCP namespace for all classes that are considered public.
// This means that they should be used by apps instead of the internal ownCloud classes
namespace OCP;

/**
 * Interface for share backends that share content that is dependent on files.
 * Extends the Share_Backend interface.
 */
interface Share_Backend_File_Dependent extends Share_Backend {
	/**
	 * Get the file path of the item
	 * @param string $itemSource
	 * @param string $uidOwner User that is the owner of shared item
	 * @return string|false
	 */
	public function getFilePath($itemSource, $uidOwner);

}
