<?php
/**
 * @author Bart Visscher <bartv@thisnet.nl>
 * @author Joas Schilling <nickvergessen@owncloud.com>
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

/**
 * Public interface of ownCloud for apps to use.
 * URL generator interface
 *
 */

// use OCP namespace for all classes that are considered public.
// This means that they should be used by apps instead of the internal ownCloud classes
namespace OCP;

/**
 * Class to generate URLs
 */
interface IURLGenerator {
	/**
	 * Returns the URL for a route
	 * @param string $routeName the name of the route
	 * @param array $arguments an array with arguments which will be filled into the url
	 * @return string the url
	 */
	public function linkToRoute($routeName, $arguments = array());

	/**
	 * Returns the absolute URL for a route
	 * @param string $routeName the name of the route
	 * @param array $arguments an array with arguments which will be filled into the url
	 * @return string the absolute url
	 */
	public function linkToRouteAbsolute($routeName, $arguments = array());

	/**
	 * Returns an URL for an image or file
	 * @param string $appName the name of the app
	 * @param string $file the name of the file
	 * @return string the url
	 */
	public function linkTo($appName, $file);

	/**
	 * Returns the link to an image, like linkTo but only with prepending img/
	 * @param string $appName the name of the app
	 * @param string $file the name of the file
	 * @return string the url
	 */
	public function imagePath($appName, $file);


	/**
	 * Makes an URL absolute
	 * @param string $url the url in the ownCloud host
	 * @return string the absolute version of the url
	 */
	public function getAbsoluteURL($url);

	/**
	 * @param string $key
	 * @return string url to the online documentation
	 */
	public function linkToDocs($key);
}
