<?php
/**
 * @author Arthur Schiwon <blizzz@owncloud.com>
 * @author Björn Schießle <schiessle@owncloud.com>
 * @author Scrutinizer Auto-Fixer <auto-fixer@scrutinizer-ci.com>
 * @author Thomas Müller <thomas.mueller@tmit.eu>
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

namespace OCA\DAV\CardDAV;

use OCA\DAV\Connector\Sabre\Principal;
use OCP\DB\QueryBuilder\IQueryBuilder;
use OCA\DAV\DAV\Sharing\Backend;
use OCA\DAV\DAV\Sharing\IShareable;
use OCP\IDBConnection;
use PDO;
use Sabre\CardDAV\Backend\BackendInterface;
use Sabre\CardDAV\Backend\SyncSupport;
use Sabre\CardDAV\Plugin;
use Sabre\DAV\Exception\BadRequest;
use Sabre\HTTP\URLUtil;
use Sabre\VObject\Component\VCard;
use Sabre\VObject\Reader;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class CardDavBackend implements BackendInterface, SyncSupport {

	/** @var Principal */
	private $principalBackend;

	/** @var string */
	private $dbCardsTable = 'cards';

	/** @var string */
	private $dbCardsPropertiesTable = 'cards_properties';

	/** @var IDBConnection */
	private $db;

	/** @var Backend */
	private $sharingBackend;

	/** @var array properties to index */
	public static $indexProperties = array(
			'BDAY', 'UID', 'N', 'FN', 'TITLE', 'ROLE', 'NOTE', 'NICKNAME',
			'ORG', 'CATEGORIES', 'EMAIL', 'TEL', 'IMPP', 'ADR', 'URL', 'GEO', 'CLOUD');

	const ACCESS_OWNER = 1;
	const ACCESS_READ_WRITE = 2;
	const ACCESS_READ = 3;

	/** @var EventDispatcherInterface */
	private $dispatcher;

	/**
	 * CardDavBackend constructor.
	 *
	 * @param IDBConnection $db
	 * @param Principal $principalBackend
	 * @param EventDispatcherInterface $dispatcher
	 */
	public function __construct(IDBConnection $db,
								Principal $principalBackend,
								$dispatcher ) {
		$this->db = $db;
		$this->principalBackend = $principalBackend;
		$this->dispatcher = $dispatcher;
		$this->sharingBackend = new Backend($this->db, $principalBackend, 'addressbook');
	}

	/**
	 * Returns the list of address books for a specific user.
	 *
	 * Every addressbook should have the following properties:
	 *   id - an arbitrary unique id
	 *   uri - the 'basename' part of the url
	 *   principaluri - Same as the passed parameter
	 *
	 * Any additional clark-notation property may be passed besides this. Some
	 * common ones are :
	 *   {DAV:}displayname
	 *   {urn:ietf:params:xml:ns:carddav}addressbook-description
	 *   {http://calendarserver.org/ns/}getctag
	 *
	 * @param string $principalUri
	 * @return array
	 */
	function getAddressBooksForUser($principalUri) {
		$principalUri = $this->convertPrincipal($principalUri, true);
		$query = $this->db->getQueryBuilder();
		$query->select(['id', 'uri', 'displayname', 'principaluri', 'description', 'synctoken'])
			->from('addressbooks')
			->where($query->expr()->eq('principaluri', $query->createNamedParameter($principalUri)));

		$addressBooks = [];

		$result = $query->execute();
		while($row = $result->fetch()) {
			$addressBooks[$row['id']] = [
				'id'  => $row['id'],
				'uri' => $row['uri'],
				'principaluri' => $this->convertPrincipal($row['principaluri'], false),
				'{DAV:}displayname' => $row['displayname'],
				'{' . Plugin::NS_CARDDAV . '}addressbook-description' => $row['description'],
				'{http://calendarserver.org/ns/}getctag' => $row['synctoken'],
				'{http://sabredav.org/ns}sync-token' => $row['synctoken']?$row['synctoken']:'0',
			];
		}
		$result->closeCursor();

		// query for shared calendars
		$principals = $this->principalBackend->getGroupMembership($principalUri);
		$principals[]= $principalUri;

		$query = $this->db->getQueryBuilder();
		$result = $query->select(['a.id', 'a.uri', 'a.displayname', 'a.principaluri', 'a.description', 'a.synctoken', 's.access'])
			->from('dav_shares', 's')
			->join('s', 'addressbooks', 'a', $query->expr()->eq('s.resourceid', 'a.id'))
			->where($query->expr()->in('s.principaluri', $query->createParameter('principaluri')))
			->andWhere($query->expr()->eq('s.type', $query->createParameter('type')))
			->setParameter('type', 'addressbook')
			->setParameter('principaluri', $principals, IQueryBuilder::PARAM_STR_ARRAY)
			->execute();

		while($row = $result->fetch()) {
			list(, $name) = URLUtil::splitPath($row['principaluri']);
			$uri = $row['uri'] . '_shared_by_' . $name;
			$displayName = $row['displayname'] . "($name)";
			if (!isset($addressBooks[$row['id']])) {
				$addressBooks[$row['id']] = [
					'id'  => $row['id'],
					'uri' => $uri,
					'principaluri' => $principalUri,
					'{DAV:}displayname' => $displayName,
					'{' . Plugin::NS_CARDDAV . '}addressbook-description' => $row['description'],
					'{http://calendarserver.org/ns/}getctag' => $row['synctoken'],
					'{http://sabredav.org/ns}sync-token' => $row['synctoken']?$row['synctoken']:'0',
					'{' . \OCA\DAV\DAV\Sharing\Plugin::NS_OWNCLOUD . '}owner-principal' => $row['principaluri'],
					'{' . \OCA\DAV\DAV\Sharing\Plugin::NS_OWNCLOUD . '}read-only' => $row['access'] === self::ACCESS_READ,
				];
			}
		}
		$result->closeCursor();

		return array_values($addressBooks);
	}

	/**
	 * @param int $addressBookId
	 */
	public function getAddressBookById($addressBookId) {
		$query = $this->db->getQueryBuilder();
		$result = $query->select(['id', 'uri', 'displayname', 'principaluri', 'description', 'synctoken'])
			->from('addressbooks')
			->where($query->expr()->eq('id', $query->createNamedParameter($addressBookId)))
			->execute();

		$row = $result->fetch();
		$result->closeCursor();
		if ($row === false) {
			return null;
		}

		return [
			'id'  => $row['id'],
			'uri' => $row['uri'],
			'principaluri' => $row['principaluri'],
			'{DAV:}displayname' => $row['displayname'],
			'{' . Plugin::NS_CARDDAV . '}addressbook-description' => $row['description'],
			'{http://calendarserver.org/ns/}getctag' => $row['synctoken'],
			'{http://sabredav.org/ns}sync-token' => $row['synctoken']?$row['synctoken']:'0',
		];
	}

	/**
	 * @param $addressBookUri
	 * @return array|null
	 */
	public function getAddressBooksByUri($principal, $addressBookUri) {
		$query = $this->db->getQueryBuilder();
		$result = $query->select(['id', 'uri', 'displayname', 'principaluri', 'description', 'synctoken'])
			->from('addressbooks')
			->where($query->expr()->eq('uri', $query->createNamedParameter($addressBookUri)))
			->andWhere($query->expr()->eq('principaluri', $query->createNamedParameter($principal)))
			->setMaxResults(1)
			->execute();

		$row = $result->fetch();
		$result->closeCursor();
		if ($row === false) {
			return null;
		}

		return [
				'id'  => $row['id'],
				'uri' => $row['uri'],
				'principaluri' => $row['principaluri'],
				'{DAV:}displayname' => $row['displayname'],
				'{' . Plugin::NS_CARDDAV . '}addressbook-description' => $row['description'],
				'{http://calendarserver.org/ns/}getctag' => $row['synctoken'],
				'{http://sabredav.org/ns}sync-token' => $row['synctoken']?$row['synctoken']:'0',
			];
	}

	/**
	 * Updates properties for an address book.
	 *
	 * The list of mutations is stored in a Sabre\DAV\PropPatch object.
	 * To do the actual updates, you must tell this object which properties
	 * you're going to process with the handle() method.
	 *
	 * Calling the handle method is like telling the PropPatch object "I
	 * promise I can handle updating this property".
	 *
	 * Read the PropPatch documentation for more info and examples.
	 *
	 * @param string $addressBookId
	 * @param \Sabre\DAV\PropPatch $propPatch
	 * @return void
	 */
	function updateAddressBook($addressBookId, \Sabre\DAV\PropPatch $propPatch) {
		$supportedProperties = [
			'{DAV:}displayname',
			'{' . Plugin::NS_CARDDAV . '}addressbook-description',
		];

		$propPatch->handle($supportedProperties, function($mutations) use ($addressBookId) {

			$updates = [];
			foreach($mutations as $property=>$newValue) {

				switch($property) {
					case '{DAV:}displayname' :
						$updates['displayname'] = $newValue;
						break;
					case '{' . Plugin::NS_CARDDAV . '}addressbook-description' :
						$updates['description'] = $newValue;
						break;
				}
			}
			$query = $this->db->getQueryBuilder();
			$query->update('addressbooks');

			foreach($updates as $key=>$value) {
				$query->set($key, $query->createNamedParameter($value));
			}
			$query->where($query->expr()->eq('id', $query->createNamedParameter($addressBookId)))
			->execute();

			$this->addChange($addressBookId, "", 2);

			return true;

		});
	}

	/**
	 * Creates a new address book
	 *
	 * @param string $principalUri
	 * @param string $url Just the 'basename' of the url.
	 * @param array $properties
	 * @return int
	 * @throws BadRequest
	 */
	function createAddressBook($principalUri, $url, array $properties) {
		$values = [
			'displayname' => null,
			'description' => null,
			'principaluri' => $principalUri,
			'uri' => $url,
			'synctoken' => 1
		];

		foreach($properties as $property=>$newValue) {

			switch($property) {
				case '{DAV:}displayname' :
					$values['displayname'] = $newValue;
					break;
				case '{' . Plugin::NS_CARDDAV . '}addressbook-description' :
					$values['description'] = $newValue;
					break;
				default :
					throw new BadRequest('Unknown property: ' . $property);
			}

		}

		// Fallback to make sure the displayname is set. Some clients may refuse
		// to work with addressbooks not having a displayname.
		if(is_null($values['displayname'])) {
			$values['displayname'] = $url;
		}

		$query = $this->db->getQueryBuilder();
		$query->insert('addressbooks')
			->values([
				'uri' => $query->createParameter('uri'),
				'displayname' => $query->createParameter('displayname'),
				'description' => $query->createParameter('description'),
				'principaluri' => $query->createParameter('principaluri'),
				'synctoken' => $query->createParameter('synctoken'),
			])
			->setParameters($values)
			->execute();

		return $query->getLastInsertId();
	}

	/**
	 * Deletes an entire addressbook and all its contents
	 *
	 * @param mixed $addressBookId
	 * @return void
	 */
	function deleteAddressBook($addressBookId) {
		$query = $this->db->getQueryBuilder();
		$query->delete('cards')
			->where($query->expr()->eq('addressbookid', $query->createParameter('addressbookid')))
			->setParameter('addressbookid', $addressBookId)
			->execute();

		$query->delete('addressbookchanges')
			->where($query->expr()->eq('addressbookid', $query->createParameter('addressbookid')))
			->setParameter('addressbookid', $addressBookId)
			->execute();

		$query->delete('addressbooks')
			->where($query->expr()->eq('id', $query->createParameter('id')))
			->setParameter('id', $addressBookId)
			->execute();

		$this->sharingBackend->deleteAllShares($addressBookId);

		$query->delete($this->dbCardsPropertiesTable)
			->where($query->expr()->eq('addressbookid', $query->createNamedParameter($addressBookId)))
			->execute();

	}

	/**
	 * Returns all cards for a specific addressbook id.
	 *
	 * This method should return the following properties for each card:
	 *   * carddata - raw vcard data
	 *   * uri - Some unique url
	 *   * lastmodified - A unix timestamp
	 *
	 * It's recommended to also return the following properties:
	 *   * etag - A unique etag. This must change every time the card changes.
	 *   * size - The size of the card in bytes.
	 *
	 * If these last two properties are provided, less time will be spent
	 * calculating them. If they are specified, you can also ommit carddata.
	 * This may speed up certain requests, especially with large cards.
	 *
	 * @param mixed $addressBookId
	 * @return array
	 */
	function getCards($addressBookId) {
		$query = $this->db->getQueryBuilder();
		$query->select(['id', 'uri', 'lastmodified', 'etag', 'size', 'carddata'])
			->from('cards')
			->where($query->expr()->eq('addressbookid', $query->createNamedParameter($addressBookId)));

		$cards = [];

		$result = $query->execute();
		while($row = $result->fetch()) {
			$row['etag'] = '"' . $row['etag'] . '"';
			$row['carddata'] = $this->readBlob($row['carddata']);
			$cards[] = $row;
		}
		$result->closeCursor();

		return $cards;
	}

	/**
	 * Returns a specfic card.
	 *
	 * The same set of properties must be returned as with getCards. The only
	 * exception is that 'carddata' is absolutely required.
	 *
	 * If the card does not exist, you must return false.
	 *
	 * @param mixed $addressBookId
	 * @param string $cardUri
	 * @return array
	 */
	function getCard($addressBookId, $cardUri) {
		$query = $this->db->getQueryBuilder();
		$query->select(['id', 'uri', 'lastmodified', 'etag', 'size', 'carddata'])
			->from('cards')
			->where($query->expr()->eq('addressbookid', $query->createNamedParameter($addressBookId)))
			->andWhere($query->expr()->eq('uri', $query->createNamedParameter($cardUri)))
			->setMaxResults(1);

		$result = $query->execute();
		$row = $result->fetch();
		if (!$row) {
			return false;
		}
		$row['etag'] = '"' . $row['etag'] . '"';
		$row['carddata'] = $this->readBlob($row['carddata']);

		return $row;
	}

	/**
	 * Returns a list of cards.
	 *
	 * This method should work identical to getCard, but instead return all the
	 * cards in the list as an array.
	 *
	 * If the backend supports this, it may allow for some speed-ups.
	 *
	 * @param mixed $addressBookId
	 * @param string[] $uris
	 * @return array
	 */
	function getMultipleCards($addressBookId, array $uris) {
		$query = $this->db->getQueryBuilder();
		$query->select(['id', 'uri', 'lastmodified', 'etag', 'size', 'carddata'])
			->from('cards')
			->where($query->expr()->eq('addressbookid', $query->createNamedParameter($addressBookId)))
			->andWhere($query->expr()->in('uri', $query->createParameter('uri')))
			->setParameter('uri', $uris, IQueryBuilder::PARAM_STR_ARRAY);

		$cards = [];

		$result = $query->execute();
		while($row = $result->fetch()) {
			$row['etag'] = '"' . $row['etag'] . '"';
			$row['carddata'] = $this->readBlob($row['carddata']);
			$cards[] = $row;
		}
		$result->closeCursor();

		return $cards;
	}

	/**
	 * Creates a new card.
	 *
	 * The addressbook id will be passed as the first argument. This is the
	 * same id as it is returned from the getAddressBooksForUser method.
	 *
	 * The cardUri is a base uri, and doesn't include the full path. The
	 * cardData argument is the vcard body, and is passed as a string.
	 *
	 * It is possible to return an ETag from this method. This ETag is for the
	 * newly created resource, and must be enclosed with double quotes (that
	 * is, the string itself must contain the double quotes).
	 *
	 * You should only return the ETag if you store the carddata as-is. If a
	 * subsequent GET request on the same card does not have the same body,
	 * byte-by-byte and you did return an ETag here, clients tend to get
	 * confused.
	 *
	 * If you don't return an ETag, you can just return null.
	 *
	 * @param mixed $addressBookId
	 * @param string $cardUri
	 * @param string $cardData
	 * @return string
	 */
	function createCard($addressBookId, $cardUri, $cardData) {
		$etag = md5($cardData);

		$query = $this->db->getQueryBuilder();
		$query->insert('cards')
			->values([
				'carddata' => $query->createNamedParameter($cardData, \PDO::PARAM_LOB),
				'uri' => $query->createNamedParameter($cardUri),
				'lastmodified' => $query->createNamedParameter(time()),
				'addressbookid' => $query->createNamedParameter($addressBookId),
				'size' => $query->createNamedParameter(strlen($cardData)),
				'etag' => $query->createNamedParameter($etag),
			])
			->execute();

		$this->addChange($addressBookId, $cardUri, 1);
		$this->updateProperties($addressBookId, $cardUri, $cardData);

		if (!is_null($this->dispatcher)) {
			$this->dispatcher->dispatch('\OCA\DAV\CardDAV\CardDavBackend::createCard',
				new GenericEvent(null, [
					'addressBookId' => $addressBookId,
					'cardUri' => $cardUri,
					'cardData' => $cardData]));
		}

		return '"' . $etag . '"';
	}

	/**
	 * Updates a card.
	 *
	 * The addressbook id will be passed as the first argument. This is the
	 * same id as it is returned from the getAddressBooksForUser method.
	 *
	 * The cardUri is a base uri, and doesn't include the full path. The
	 * cardData argument is the vcard body, and is passed as a string.
	 *
	 * It is possible to return an ETag from this method. This ETag should
	 * match that of the updated resource, and must be enclosed with double
	 * quotes (that is: the string itself must contain the actual quotes).
	 *
	 * You should only return the ETag if you store the carddata as-is. If a
	 * subsequent GET request on the same card does not have the same body,
	 * byte-by-byte and you did return an ETag here, clients tend to get
	 * confused.
	 *
	 * If you don't return an ETag, you can just return null.
	 *
	 * @param mixed $addressBookId
	 * @param string $cardUri
	 * @param string $cardData
	 * @return string
	 */
	function updateCard($addressBookId, $cardUri, $cardData) {

		$etag = md5($cardData);
		$query = $this->db->getQueryBuilder();
		$query->update('cards')
			->set('carddata', $query->createNamedParameter($cardData, \PDO::PARAM_LOB))
			->set('lastmodified', $query->createNamedParameter(time()))
			->set('size', $query->createNamedParameter(strlen($cardData)))
			->set('etag', $query->createNamedParameter($etag))
			->where($query->expr()->eq('uri', $query->createNamedParameter($cardUri)))
			->andWhere($query->expr()->eq('addressbookid', $query->createNamedParameter($addressBookId)))
			->execute();

		$this->addChange($addressBookId, $cardUri, 2);
		$this->updateProperties($addressBookId, $cardUri, $cardData);

		if (!is_null($this->dispatcher)) {
			$this->dispatcher->dispatch('\OCA\DAV\CardDAV\CardDavBackend::updateCard',
				new GenericEvent(null, [
					'addressBookId' => $addressBookId,
					'cardUri' => $cardUri,
					'cardData' => $cardData]));
		}

		return '"' . $etag . '"';
	}

	/**
	 * Deletes a card
	 *
	 * @param mixed $addressBookId
	 * @param string $cardUri
	 * @return bool
	 */
	function deleteCard($addressBookId, $cardUri) {
		try {
			$cardId = $this->getCardId($addressBookId, $cardUri);
		} catch (\InvalidArgumentException $e) {
			$cardId = null;
		}
		$query = $this->db->getQueryBuilder();
		$ret = $query->delete('cards')
			->where($query->expr()->eq('addressbookid', $query->createNamedParameter($addressBookId)))
			->andWhere($query->expr()->eq('uri', $query->createNamedParameter($cardUri)))
			->execute();

		$this->addChange($addressBookId, $cardUri, 3);

		if (!is_null($this->dispatcher)) {
			$this->dispatcher->dispatch('\OCA\DAV\CardDAV\CardDavBackend::deleteCard',
				new GenericEvent(null, [
					'addressBookId' => $addressBookId,
					'cardUri' => $cardUri]));
		}

		if ($ret === 1) {
			if ($cardId !== null) {
				$this->purgeProperties($addressBookId, $cardId);
			}
			return true;
		}

		return false;
	}

	/**
	 * The getChanges method returns all the changes that have happened, since
	 * the specified syncToken in the specified address book.
	 *
	 * This function should return an array, such as the following:
	 *
	 * [
	 *   'syncToken' => 'The current synctoken',
	 *   'added'   => [
	 *      'new.txt',
	 *   ],
	 *   'modified'   => [
	 *      'modified.txt',
	 *   ],
	 *   'deleted' => [
	 *      'foo.php.bak',
	 *      'old.txt'
	 *   ]
	 * ];
	 *
	 * The returned syncToken property should reflect the *current* syncToken
	 * of the calendar, as reported in the {http://sabredav.org/ns}sync-token
	 * property. This is needed here too, to ensure the operation is atomic.
	 *
	 * If the $syncToken argument is specified as null, this is an initial
	 * sync, and all members should be reported.
	 *
	 * The modified property is an array of nodenames that have changed since
	 * the last token.
	 *
	 * The deleted property is an array with nodenames, that have been deleted
	 * from collection.
	 *
	 * The $syncLevel argument is basically the 'depth' of the report. If it's
	 * 1, you only have to report changes that happened only directly in
	 * immediate descendants. If it's 2, it should also include changes from
	 * the nodes below the child collections. (grandchildren)
	 *
	 * The $limit argument allows a client to specify how many results should
	 * be returned at most. If the limit is not specified, it should be treated
	 * as infinite.
	 *
	 * If the limit (infinite or not) is higher than you're willing to return,
	 * you should throw a Sabre\DAV\Exception\TooMuchMatches() exception.
	 *
	 * If the syncToken is expired (due to data cleanup) or unknown, you must
	 * return null.
	 *
	 * The limit is 'suggestive'. You are free to ignore it.
	 *
	 * @param string $addressBookId
	 * @param string $syncToken
	 * @param int $syncLevel
	 * @param int $limit
	 * @return array
	 */
	function getChangesForAddressBook($addressBookId, $syncToken, $syncLevel, $limit = null) {
		// Current synctoken
		$stmt = $this->db->prepare('SELECT `synctoken` FROM `*PREFIX*addressbooks` WHERE `id` = ?');
		$stmt->execute([ $addressBookId ]);
		$currentToken = $stmt->fetchColumn(0);

		if (is_null($currentToken)) return null;

		$result = [
			'syncToken' => $currentToken,
			'added'     => [],
			'modified'  => [],
			'deleted'   => [],
		];

		if ($syncToken) {

			$query = "SELECT `uri`, `operation` FROM `*PREFIX*addressbookchanges` WHERE `synctoken` >= ? AND `synctoken` < ? AND `addressbookid` = ? ORDER BY `synctoken`";
			if ($limit>0) {
				$query .= " `LIMIT` " . (int)$limit;
			}

			// Fetching all changes
			$stmt = $this->db->prepare($query);
			$stmt->execute([$syncToken, $currentToken, $addressBookId]);

			$changes = [];

			// This loop ensures that any duplicates are overwritten, only the
			// last change on a node is relevant.
			while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {

				$changes[$row['uri']] = $row['operation'];

			}

			foreach($changes as $uri => $operation) {

				switch($operation) {
					case 1:
						$result['added'][] = $uri;
						break;
					case 2:
						$result['modified'][] = $uri;
						break;
					case 3:
						$result['deleted'][] = $uri;
						break;
				}

			}
		} else {
			// No synctoken supplied, this is the initial sync.
			$query = "SELECT `uri` FROM `*PREFIX*cards` WHERE `addressbookid` = ?";
			$stmt = $this->db->prepare($query);
			$stmt->execute([$addressBookId]);

			$result['added'] = $stmt->fetchAll(\PDO::FETCH_COLUMN);
		}
		return $result;
	}

	/**
	 * Adds a change record to the addressbookchanges table.
	 *
	 * @param mixed $addressBookId
	 * @param string $objectUri
	 * @param int $operation 1 = add, 2 = modify, 3 = delete
	 * @return void
	 */
	protected function addChange($addressBookId, $objectUri, $operation) {
		$sql = 'INSERT INTO `*PREFIX*addressbookchanges`(`uri`, `synctoken`, `addressbookid`, `operation`) SELECT ?, `synctoken`, ?, ? FROM `*PREFIX*addressbooks` WHERE `id` = ?';
		$stmt = $this->db->prepare($sql);
		$stmt->execute([
			$objectUri,
			$addressBookId,
			$operation,
			$addressBookId
		]);
		$stmt = $this->db->prepare('UPDATE `*PREFIX*addressbooks` SET `synctoken` = `synctoken` + 1 WHERE `id` = ?');
		$stmt->execute([
			$addressBookId
		]);
	}

	private function readBlob($cardData) {
		if (is_resource($cardData)) {
			return stream_get_contents($cardData);
		}

		return $cardData;
	}

	/**
	 * @param IShareable $shareable
	 * @param string[] $add
	 * @param string[] $remove
	 */
	public function updateShares(IShareable $shareable, $add, $remove) {
		$this->sharingBackend->updateShares($shareable, $add, $remove);
	}

	/**
	 * search contact
	 *
	 * @param int $addressBookId
	 * @param string $pattern which should match within the $searchProperties
	 * @param array $searchProperties defines the properties within the query pattern should match
	 * @return array an array of contacts which are arrays of key-value-pairs
	 */
	public function search($addressBookId, $pattern, $searchProperties) {
		$query = $this->db->getQueryBuilder();
		$query2 = $this->db->getQueryBuilder();
		$query2->selectDistinct('cp.cardid')->from($this->dbCardsPropertiesTable, 'cp');
		foreach ($searchProperties as $property) {
			$query2->orWhere(
				$query2->expr()->andX(
					$query2->expr()->eq('cp.name', $query->createNamedParameter($property)),
					$query2->expr()->ilike('cp.value', $query->createNamedParameter('%' . $this->db->escapeLikeParameter($pattern) . '%'))
				)
			);
		}
		$query2->andWhere($query2->expr()->eq('cp.addressbookid', $query->createNamedParameter($addressBookId)));

		$query->select('c.carddata')->from($this->dbCardsTable, 'c')
			->where($query->expr()->in('c.id', $query->createFunction($query2->getSQL())));

		$result = $query->execute();
		$cards = $result->fetchAll();

		$result->closeCursor();

		return array_map(function($array) {return $this->readBlob($array['carddata']);}, $cards);

	}

	/**
	 * @param int $bookId
	 * @param string $name
	 * @return array
	 */
	public function collectCardProperties($bookId, $name) {
		$query = $this->db->getQueryBuilder();
		$result = $query->selectDistinct('value')
			->from($this->dbCardsPropertiesTable)
			->where($query->expr()->eq('name', $query->createNamedParameter($name)))
			->andWhere($query->expr()->eq('addressbookid', $query->createNamedParameter($bookId)))
			->execute();

		$all = $result->fetchAll(PDO::FETCH_COLUMN);
		$result->closeCursor();

		return $all;
	}

	/**
	 * get URI from a given contact
	 *
	 * @param int $id
	 * @return string
	 */
	public function getCardUri($id) {
		$query = $this->db->getQueryBuilder();
		$query->select('uri')->from($this->dbCardsTable)
				->where($query->expr()->eq('id', $query->createParameter('id')))
				->setParameter('id', $id);

		$result = $query->execute();
		$uri = $result->fetch();
		$result->closeCursor();

		if (!isset($uri['uri'])) {
			throw new \InvalidArgumentException('Card does not exists: ' . $id);
		}

		return $uri['uri'];
	}

	/**
	 * return contact with the given URI
	 *
	 * @param int $addressBookId
	 * @param string $uri
	 * @returns array
	 */
	public function getContact($addressBookId, $uri) {
		$result = [];
		$query = $this->db->getQueryBuilder();
		$query->select('*')->from($this->dbCardsTable)
				->where($query->expr()->eq('uri', $query->createNamedParameter($uri)))
				->where($query->expr()->eq('addressbookid', $query->createNamedParameter($addressBookId)));
		$queryResult = $query->execute();
		$contact = $queryResult->fetch();
		$queryResult->closeCursor();

		if (is_array($contact)) {
			$result = $contact;
		}

		return $result;
	}

	/**
	 * Returns the list of people whom this address book is shared with.
	 *
	 * Every element in this array should have the following properties:
	 *   * href - Often a mailto: address
	 *   * commonName - Optional, for example a first + last name
	 *   * status - See the Sabre\CalDAV\SharingPlugin::STATUS_ constants.
	 *   * readOnly - boolean
	 *   * summary - Optional, a description for the share
	 *
	 * @return array
	 */
	public function getShares($addressBookId) {
		return $this->sharingBackend->getShares($addressBookId);
	}

	/**
	 * update properties table
	 *
	 * @param int $addressBookId
	 * @param string $cardUri
	 * @param string $vCardSerialized
	 */
	protected function updateProperties($addressBookId, $cardUri, $vCardSerialized) {
		$cardId = $this->getCardId($addressBookId, $cardUri);
		$vCard = $this->readCard($vCardSerialized);

		$this->purgeProperties($addressBookId, $cardId);

		$query = $this->db->getQueryBuilder();
		$query->insert($this->dbCardsPropertiesTable)
			->values(
				[
					'addressbookid' => $query->createNamedParameter($addressBookId),
					'cardid' => $query->createNamedParameter($cardId),
					'name' => $query->createParameter('name'),
					'value' => $query->createParameter('value'),
					'preferred' => $query->createParameter('preferred')
				]
			);

		foreach ($vCard->children as $property) {
			if(!in_array($property->name, self::$indexProperties)) {
				continue;
			}
			$preferred = 0;
			foreach($property->parameters as $parameter) {
				if ($parameter->name == 'TYPE' && strtoupper($parameter->getValue()) == 'PREF') {
					$preferred = 1;
					break;
				}
			}
			$query->setParameter('name', $property->name);
			$query->setParameter('value', substr($property->getValue(), 0, 254));
			$query->setParameter('preferred', $preferred);
			$query->execute();
		}
	}

	/**
	 * read vCard data into a vCard object
	 *
	 * @param string $cardData
	 * @return VCard
	 */
	protected function readCard($cardData) {
		return  Reader::read($cardData);
	}

	/**
	 * delete all properties from a given card
	 *
	 * @param int $addressBookId
	 * @param int $cardId
	 */
	protected function purgeProperties($addressBookId, $cardId) {
		$query = $this->db->getQueryBuilder();
		$query->delete($this->dbCardsPropertiesTable)
			->where($query->expr()->eq('cardid', $query->createNamedParameter($cardId)))
			->andWhere($query->expr()->eq('addressbookid', $query->createNamedParameter($addressBookId)));
		$query->execute();
	}

	/**
	 * get ID from a given contact
	 *
	 * @param int $addressBookId
	 * @param string $uri
	 * @return int
	 */
	protected function getCardId($addressBookId, $uri) {
		$query = $this->db->getQueryBuilder();
		$query->select('id')->from($this->dbCardsTable)
			->where($query->expr()->eq('uri', $query->createNamedParameter($uri)))
			->andWhere($query->expr()->eq('addressbookid', $query->createNamedParameter($addressBookId)));

		$result = $query->execute();
		$cardIds = $result->fetch();
		$result->closeCursor();

		if (!isset($cardIds['id'])) {
			throw new \InvalidArgumentException('Card does not exists: ' . $uri);
		}

		return (int)$cardIds['id'];
	}

	/**
	 * For shared address books the sharee is set in the ACL of the address book
	 * @param $addressBookId
	 * @param $acl
	 * @return array
	 */
	public function applyShareAcl($addressBookId, $acl) {
		return $this->sharingBackend->applyShareAcl($addressBookId, $acl);
	}

	private function convertPrincipal($principalUri, $toV2) {
		if ($this->principalBackend->getPrincipalPrefix() === 'principals') {
			list(, $name) = URLUtil::splitPath($principalUri);
			if ($toV2 === true) {
				return "principals/users/$name";
			}
			return "principals/$name";
		}
		return $principalUri;
	}
}
