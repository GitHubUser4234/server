<?php

namespace OC;

use OC\AppFramework\Http\Request;
use OC\AppFramework\Utility\SimpleContainer;
use OC\Files\Node\Root;
use OC\Files\View;
use OCP\IServerContainer;

/**
 * Class Server
 * @package OC
 *
 * TODO: hookup all manager classes
 */
class Server extends SimpleContainer implements IServerContainer {

	function __construct() {
		$this->registerService('ContactsManager', function($c) {
			return new ContactsManager();
		});
		$this->registerService('Request', function($c) {
			$params = array();

			// we json decode the body only in case of content type json
			if (isset($_SERVER['CONTENT_TYPE']) && stripos($_SERVER['CONTENT_TYPE'],'json') === true ) {
				$params = json_decode(file_get_contents('php://input'), true);
				$params = is_array($params) ? $params: array();
			}

			return new Request(
				array(
					'get' => $_GET,
					'post' => $_POST,
					'files' => $_FILES,
					'server' => $_SERVER,
					'env' => $_ENV,
					'cookies' => $_COOKIE,
					'method' => (isset($_SERVER) && isset($_SERVER['REQUEST_METHOD']))
						? $_SERVER['REQUEST_METHOD']
						: null,
					'params' => $params,
					'urlParams' => $c['urlParams']
				)
			);
		});
		$this->registerService('PreviewManager', function($c) {
			return new PreviewManager();
		});
		$this->registerService('RootFolder', function($c) {
			// TODO: get user and user manager from container as well
			$user = \OC_User::getUser();
			$user = \OC_User::getManager()->get($user);
			$manager = \OC\Files\Filesystem::getMountManager();
			$view = new View();
			return new Root($manager, $view, $user);
		});
		$this->registerService('UserManager', function($c) {
			return new \OC\User\Manager();
		});
		$this->registerService('UserSession', function($c) {
			$manager = $c->query('UserManager');
			$userSession = new \OC\User\Session($manager, \OC::$session);
			$userSession->listen('\OC\User', 'preCreateUser', function ($uid, $password) {
				\OC_Hook::emit('OC_User', 'pre_createUser', array('run' => true, 'uid' => $uid, 'password' => $password));
			});
			$userSession->listen('\OC\User', 'postCreateUser', function ($user, $password) {
				/** @var $user \OC\User\User */
				\OC_Hook::emit('OC_User', 'post_createUser', array('uid' => $user->getUID(), 'password' => $password));
			});
			$userSession->listen('\OC\User', 'preDelete', function ($user) {
				/** @var $user \OC\User\User */
				\OC_Hook::emit('OC_User', 'pre_deleteUser', array('run' => true, 'uid' => $user->getUID()));
			});
			$userSession->listen('\OC\User', 'postDelete', function ($user) {
				/** @var $user \OC\User\User */
				\OC_Hook::emit('OC_User', 'post_deleteUser', array('uid' => $user->getUID()));
			});
			$userSession->listen('\OC\User', 'preSetPassword', function ($user, $password, $recoveryPassword) {
				/** @var $user \OC\User\User */
				\OC_Hook::emit('OC_User', 'pre_setPassword', array('run' => true, 'uid' => $user->getUID(), 'password' => $password, 'recoveryPassword' => $recoveryPassword));
			});
			$userSession->listen('\OC\User', 'postSetPassword', function ($user, $password, $recoveryPassword) {
				/** @var $user \OC\User\User */
				\OC_Hook::emit('OC_User', 'post_setPassword', array('run' => true, 'uid' => $user->getUID(), 'password' => $password, 'recoveryPassword' => $recoveryPassword));
			});
			$userSession->listen('\OC\User', 'preLogin', function ($uid, $password) {
				\OC_Hook::emit('OC_User', 'pre_login', array('run' => true, 'uid' => $uid, 'password' => $password));
			});
			$userSession->listen('\OC\User', 'postLogin', function ($user, $password) {
				/** @var $user \OC\User\User */
				\OC_Hook::emit('OC_User', 'post_login', array('run' => true, 'uid' => $user->getUID(), 'password' => $password));
			});
			$userSession->listen('\OC\User', 'logout', function () {
				\OC_Hook::emit('OC_User', 'logout', array());
			});
			return $userSession;
		});
		$this->registerService('UserCache', function($c) {
			return new UserCache();
		});
	}

	/**
	 * @return \OCP\Contacts\IManager
	 */
	function getContactsManager() {
		return $this->query('ContactsManager');
	}

	/**
	 * The current request object holding all information about the request
	 * currently being processed is returned from this method.
	 * In case the current execution was not initiated by a web request null is returned
	 *
	 * @return \OCP\IRequest|null
	 */
	function getRequest() {
		return $this->query('Request');
	}

	/**
	 * Returns the preview manager which can create preview images for a given file
	 *
	 * @return \OCP\IPreview
	 */
	function getPreviewManager() {
		return $this->query('PreviewManager');
	}

	/**
	 * Returns the root folder of ownCloud's data directory
	 *
	 * @return \OCP\Files\Folder
	 */
	function getRootFolder() {
		return $this->query('RootFolder');
	}

	/**
	 * @return \OC\User\Manager
	 */
	function getUserManager() {
		return $this->query('UserManager');
	}

	/**
	 * @return \OC\User\Session
	 */
	function getUserSession() {
		return $this->query('UserSession');
	}

	/**
	 * Returns an ICache instance
	 *
	 * @return \OCP\ICache
	 */
	function getCache() {
		return $this->query('UserCache');
	}

	/**
	 * Returns the current session
	 *
	 * @return \OCP\ISession
	 */
	function getSession() {
		return \OC::$session;
	}

	/**
	 * Returns the current session
	 *
	 * @return \OCP\IDBConnection
	 */
	function getDatabaseConnection() {
		return \OC_DB::getConnection();
	}
}
