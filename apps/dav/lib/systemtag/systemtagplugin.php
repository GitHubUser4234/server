<?php
/**
 * @author Vincent Petry <pvince81@owncloud.com>
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
namespace OCA\DAV\SystemTag;

use Sabre\DAV\PropFind;
use Sabre\DAV\PropPatch;
use Sabre\DAV\Exception\BadRequest;
use Sabre\DAV\Exception\UnsupportedMediaType;
use Sabre\DAV\Exception\Conflict;

use OCA\DAV\SystemTag\SystemTagNode;
use OCP\SystemTag\ISystemTag;
use OCP\SystemTag\ISystemTagManager;
use OCP\SystemTag\TagAlreadyExistsException;

class SystemTagPlugin extends \Sabre\DAV\ServerPlugin {

	// namespace
	const NS_OWNCLOUD = 'http://owncloud.org/ns';
	const ID_PROPERTYNAME = '{http://owncloud.org/ns}id';
	const DISPLAYNAME_PROPERTYNAME = '{http://owncloud.org/ns}display-name';
	const USERVISIBLE_PROPERTYNAME = '{http://owncloud.org/ns}user-visible';
	const USERASSIGNABLE_PROPERTYNAME = '{http://owncloud.org/ns}user-assignable';

	/**
	 * @var \Sabre\DAV\Server $server
	 */
	private $server;

	/**
	 * @var ISystemTagManager
	 */
	protected $tagManager;

	/**
	 * System tags plugin
	 *
	 * @param ISystemTagManager $tagManager tag manager
	 */
	public function __construct(ISystemTagManager $tagManager) {
		$this->tagManager = $tagManager;
	}

	/**
	 * This initializes the plugin.
	 *
	 * This function is called by \Sabre\DAV\Server, after
	 * addPlugin is called.
	 *
	 * This method should set up the required event subscriptions.
	 *
	 * @param \Sabre\DAV\Server $server
	 * @return void
	 */
	public function initialize(\Sabre\DAV\Server $server) {

		$server->xmlNamespaces[self::NS_OWNCLOUD] = 'oc';

		$server->protectedProperties[] = self::ID_PROPERTYNAME;

		$server->on('propFind', array($this, 'handleGetProperties'));
		$server->on('propPatch', array($this, 'handleUpdateProperties'));
		$server->on('method:POST', [$this, 'httpPost']);

		$this->server = $server;
	}

	/**
	 * We intercept this to handle POST requests on calendars.
	 *
	 * @param RequestInterface $request
	 * @param ResponseInterface $response
	 * @return null|false
	 */
	function httpPost(RequestInterface $request, ResponseInterface $response) {
		$path = $request->getPath();

		// Making sure the node exists
		try {
			$node = $this->server->tree->getNodeForPath($path);
		} catch (NotFound $e) {
			return;
		}

		if ($node instanceof SystemTagsByIdCollection || $node instanceof SystemTagsObjectMappingCollection) {
			$data = $request->getBodyAsString();

			$tag = $this->createTag($data, $request->getHeader('Content-Type'));

			if ($node instanceof SystemTagsObjectMappingCollection) {
				// also add to collection
				$node->createFile($tag->getId());
				$url = $request->getBaseUrl() . 'systemtags/';
			} else {
				$url = $request->getUrl();
			}

			if ($url[strlen($url) - 1] !== '/') {
				$url .= '/';
			}

			$response->setHeader('Location', $url . $tag->getId());

			// created
			$response->setStatus(201);
			return false;
		}
	}

	/**
	 * Creates a new tag
	 *
	 * @param string $data
	 * @param string $contentType content type of the data
	 *
	 * @return ISystemTag newly created system tag
	 *
	 * @throws UnsupportedMediaType if the content type is not supported
	 * @throws BadRequest if a field was missing
	 */
	private function createTag($data, $contentType = 'application/json') {
		if ($contentType === 'application/json') {
			$data = json_decode($data, true);
			// TODO: application/x-www-form-urlencoded ?
		} else {
			throw new UnsupportedMediaType();
		}

		if (!isset($data['name'])) {
			throw new BadRequest('Missing "name" attribute');
		}

		$tagName = $data['name'];
		$userVisible = true;
		$userAssignable = true;

		if (isset($data['userVisible'])) {
			$userVisible = (bool)$data['userVisible'];
		}

		if (isset($data['userAssignable'])) {
			$userVisible = (bool)$data['userAssignable'];
		}
		try {
			return $this->tagManager->createTag($tagName, $userVisible, $userAssignable);
		} catch (TagAlreadyExistsException $e) {
			throw new Conflict('Tag already exists');
		}
	}


	/**
	 * Retrieves system tag properties
	 *
	 * @param PropFind $propFind
	 * @param \Sabre\DAV\INode $node
	 */
	public function handleGetProperties(
		PropFind $propFind,
		\Sabre\DAV\INode $node
	) {
		if (!($node instanceof SystemTagNode)) {
			return;
		}

		$propFind->handle(self::ID_PROPERTYNAME, function() use ($node) {
			return $node->getSystemTag()->getId();
		});

		$propFind->handle(self::DISPLAYNAME_PROPERTYNAME, function() use ($node) {
			return $node->getSystemTag()->getName();
		});

		$propFind->handle(self::USERVISIBLE_PROPERTYNAME, function() use ($node) {
			return (int)$node->getSystemTag()->isUserVisible();
		});

		$propFind->handle(self::USERASSIGNABLE_PROPERTYNAME, function() use ($node) {
			return (int)$node->getSystemTag()->isUserAssignable();
		});
	}

	/**
	 * Updates tag attributes
	 *
	 * @param string $path
	 * @param PropPatch $propPatch
	 *
	 * @return void
	 */
	public function handleUpdateProperties($path, PropPatch $propPatch) {
		$propPatch->handle([
			self::DISPLAYNAME_PROPERTYNAME,
			self::USERVISIBLE_PROPERTYNAME,
			self::USERASSIGNABLE_PROPERTYNAME,
		], function($props) use ($path) {
			$node = $this->tree->getNodeForPath($path);
			if (!($node instanceof SystemTagNode)) {
				return;
			}

			$tag = $node->getTag();
			$name = $tag->getName();
			$userVisible = $tag->getUserVisible();
			$userAssignable = $tag->getUserAssignable();

			if (isset($props[self::DISPLAYNAME_PROPERTYNAME])) {
				$name = $props[self::DISPLAYNAME_PROPERTYNAME];
			}

			if (isset($props[self::USERVISIBLE_PROPERTYNAME])) {
				$userVisible = (bool)$props[self::USERVISIBLE_PROPERTYNAME];
			}

			if (isset($props[self::USERASSIGNABLE_PROPERTYNAME])) {
				$userAssignable = (bool)$props[self::USERASSIGNABLE_PROPERTYNAME];
			}

			$node->update($name, $userVisible, $userAssignable);
			return true;
		});
	}
}
