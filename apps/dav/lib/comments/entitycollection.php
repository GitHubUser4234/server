<?php
/**
 * @author Arthur Schiwon <blizzz@owncloud.com>
 *
 * @copyright Copyright (c) 2016, ownCloud, Inc.
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

namespace OCA\DAV\Comments;

use OCP\Comments\ICommentsManager;
use OCP\Files\Folder;
use OCP\ILogger;
use OCP\IUserManager;
use OCP\IUserSession;
use Sabre\DAV\Exception\NotFound;
use Sabre\DAV\PropPatch;

/**
 * Class EntityCollection
 *
 * this represents a specific holder of comments, identified by an entity type
 * (class member $name) and an entity id (class member $id).
 *
 * @package OCA\DAV\Comments
 */
class EntityCollection extends RootCollection implements \Sabre\DAV\IProperties {
	const PROPERTY_NAME_READ_MARKER  = '{http://owncloud.org/ns}readMarker';

	/** @var  Folder */
	protected $fileRoot;

	/** @var  string */
	protected $id;

	/** @var  ILogger */
	protected $logger;

	/**
	 * @param string $id
	 * @param string $name
	 * @param ICommentsManager $commentsManager
	 * @param Folder $fileRoot
	 * @param IUserManager $userManager
	 * @param IUserSession $userSession
	 * @param ILogger $logger
	 */
	public function __construct(
		$id,
		$name,
		ICommentsManager $commentsManager,
		Folder $fileRoot,
		IUserManager $userManager,
		IUserSession $userSession,
		ILogger $logger
	) {
		foreach(['id', 'name'] as $property) {
			$$property = trim($$property);
			if(empty($$property) || !is_string($$property)) {
				throw new \InvalidArgumentException('"' . $property . '" parameter must be non-empty string');
			}
		}
		$this->id = $id;
		$this->name = $name;
		$this->commentsManager = $commentsManager;
		$this->fileRoot = $fileRoot;
		$this->logger = $logger;
		$this->userManager = $userManager;
		$this->userSession = $userSession;
	}

	/**
	 * returns the ID of this entity
	 *
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Returns a specific child node, referenced by its name
	 *
	 * This method must throw Sabre\DAV\Exception\NotFound if the node does not
	 * exist.
	 *
	 * @param string $name
	 * @return \Sabre\DAV\INode
	 * @throws NotFound
	 */
	function getChild($name) {
		try {
			$comment = $this->commentsManager->get($name);
			return new CommentNode(
				$this->commentsManager,
				$comment,
				$this->userManager,
				$this->userSession,
				$this->logger
			);
		} catch (\OCP\Comments\NotFoundException $e) {
			throw new NotFound();
		}
	}

	/**
	 * Returns an array with all the child nodes
	 *
	 * @return \Sabre\DAV\INode[]
	 */
	function getChildren() {
		return $this->findChildren();
	}

	/**
	 * Returns an array of comment nodes. Result can be influenced by offset,
	 * limit and date time parameters.
	 *
	 * @param int $limit
	 * @param int $offset
	 * @param \DateTime|null $datetime
	 * @return CommentNode[]
	 */
	function findChildren($limit = 0, $offset = 0, \DateTime $datetime = null) {
		$comments = $this->commentsManager->getForObject($this->name, $this->id, $limit, $offset, $datetime);
		$result = [];
		foreach($comments as $comment) {
			$result[] = new CommentNode(
				$this->commentsManager,
				$comment,
				$this->userManager,
				$this->userSession,
				$this->logger
			);
		}
		return $result;
	}

	/**
	 * Checks if a child-node with the specified name exists
	 *
	 * @param string $name
	 * @return bool
	 */
	function childExists($name) {
		try {
			$this->commentsManager->get($name);
			return true;
		} catch (\OCP\Comments\NotFoundException $e) {
			return false;
		}
	}

	/**
	 * Sets the read marker to the specified date for the logged in user
	 *
	 * @param \DateTime $value
	 * @return bool
	 */
	public function setReadMarker($value) {
		$dateTime = new \DateTime($value);
		$user = $this->userSession->getUser();
		$this->commentsManager->setReadMark($this->name, $this->id, $dateTime, $user);
		return true;
	}

	/**
	 * @inheritdoc
	 */
	function propPatch(PropPatch $propPatch) {
		$propPatch->handle(self::PROPERTY_NAME_READ_MARKER, [$this, 'setReadMarker']);
	}

	/**
	 * @inheritdoc
	 */
	function getProperties($properties) {
		$marker = null;
		$user = $this->userSession->getUser();
		if(!is_null($user)) {
			$marker = $this->commentsManager->getReadMark($this->name, $this->id, $user);
		}
		return [self::PROPERTY_NAME_READ_MARKER => $marker];
	}
}

