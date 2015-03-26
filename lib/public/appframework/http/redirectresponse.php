<?php
/**
 * @author Bernhard Posselt <dev@bernhard-posselt.com>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Scrutinizer Auto-Fixer <auto-fixer@scrutinizer-ci.com>
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


namespace OCP\AppFramework\Http;

use OCP\AppFramework\Http\Response;
use OCP\AppFramework\Http;


/**
 * Redirects to a different URL
 */
class RedirectResponse extends Response {

	private $redirectURL;

	/**
	 * Creates a response that redirects to a url
	 * @param string $redirectURL the url to redirect to
	 */
	public function __construct($redirectURL) {
		$this->redirectURL = $redirectURL;
		$this->setStatus(Http::STATUS_TEMPORARY_REDIRECT);
		$this->addHeader('Location', $redirectURL);
	}


	/**
	 * @return string the url to redirect
	 */
	public function getRedirectURL() {
		return $this->redirectURL;
	}


}
