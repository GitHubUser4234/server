<?php
/**
 * Copyright (c) 2015 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OCA\DAV\Tests\Unit\Connector\Sabre\RequestTest;

use Sabre\DAV\Auth\Backend\BackendInterface;
use Sabre\HTTP\RequestInterface;
use Sabre\HTTP\ResponseInterface;

class Auth implements BackendInterface {
	/**
	 * @var string
	 */
	private $user;

	/**
	 * @var string
	 */
	private $password;

	/**
	 * Auth constructor.
	 *
	 * @param string $user
	 * @param string $password
	 */
	public function __construct($user, $password) {
		$this->user = $user;
		$this->password = $password;
	}

	/**
	 * When this method is called, the backend must check if authentication was
	 * successful.
	 *
	 * The returned value must be one of the following
	 *
	 * [true, "principals/username"]
	 * [false, "reason for failure"]
	 *
	 * If authentication was successful, it's expected that the authentication
	 * backend returns a so-called principal url.
	 *
	 * Examples of a principal url:
	 *
	 * principals/admin
	 * principals/user1
	 * principals/users/joe
	 * principals/uid/123457
	 *
	 * If you don't use WebDAV ACL (RFC3744) we recommend that you simply
	 * return a string such as:
	 *
	 * principals/users/[username]
	 *
	 * @param RequestInterface $request
	 * @param ResponseInterface $response
	 * @return array
	 */
	function check(RequestInterface $request, ResponseInterface $response) {
		$userSession = \OC::$server->getUserSession();
		$result = $userSession->login($this->user, $this->password);
		if ($result) {
			//we need to pass the user name, which may differ from login name
			$user = $userSession->getUser()->getUID();
			\OC_Util::setupFS($user);
			//trigger creation of user home and /files folder
			\OC::$server->getUserFolder($user);
			return [true, "principals/$user"];
		}
		return [false, "login failed"];
	}

	/**
	 * This method is called when a user could not be authenticated, and
	 * authentication was required for the current request.
	 *
	 * This gives you the opportunity to set authentication headers. The 401
	 * status code will already be set.
	 *
	 * In this case of Basic Auth, this would for example mean that the
	 * following header needs to be set:
	 *
	 * $response->addHeader('WWW-Authenticate', 'Basic realm=SabreDAV');
	 *
	 * Keep in mind that in the case of multiple authentication backends, other
	 * WWW-Authenticate headers may already have been set, and you'll want to
	 * append your own WWW-Authenticate header instead of overwriting the
	 * existing one.
	 *
	 * @param RequestInterface $request
	 * @param ResponseInterface $response
	 * @return void
	 */
	function challenge(RequestInterface $request, ResponseInterface $response) {
		// TODO: Implement challenge() method.
	}
}
