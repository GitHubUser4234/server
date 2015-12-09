<?php

namespace Test\Comments;

/**
 * Class FakeManager
 */
class FakeManager implements \OCP\Comments\ICommentsManager {

	public function get($id) {}

	public function getTree($id, $limit = 0, $offset = 0) {}

	public function getForObject(
		$objectType,
		$objectId,
		$limit = 0,
		$offset = 0,
		\DateTime $notOlderThan = null
	) {}

	public function getNumberOfCommentsForObject($objectType, $objectId) {}

	public function create($actorType, $actorId, $objectType, $objectId) {}

	public function delete($id) {}

	public function save(\OCP\Comments\IComment $comment) {}

	public function deleteReferencesOfActor($actorType, $actorId) {}

	public function deleteCommentsAtObject($objectType, $objectId) {}
}
