<?php

/**
 * PDO CardDAV backend
 *
 * This CardDAV backend uses PDO to store addressbooks
 * 
 * @package Sabre
 * @subpackage CardDAV
 * @copyright Copyright (C) 2007-2011 Rooftop Solutions. All rights reserved.
 * @author Evert Pot (http://www.rooftopsolutions.nl/) 
 * @license http://code.google.com/p/sabredav/wiki/License Modified BSD License
 */
class Sabre_CardDAV_Backend_PDO extends Sabre_CardDAV_Backend_Abstract {

    /**
     * PDO connection 
     * 
     * @var PDO 
     */
    protected $pdo;

    /**
     * The PDO table name used to store addressbooks
     */
    protected $addressBooksTableName;

    /**
     * The PDO table name used to store cards
     */
    protected $cardsTableName;

    /**
     * Sets up the object 
     * 
     * @param PDO $pdo 
     */
    public function __construct(PDO $pdo, $addressBooksTableName = 'addressbooks', $cardsTableName = 'cards') {

        $this->pdo = $pdo;
        $this->addressBooksTableName = $addressBooksTableName;
        $this->cardsTableName = $cardsTableName; 

    }

    /**
     * Returns the list of addressbooks for a specific user. 
     * 
     * @param string $principalUri 
     * @return array 
     */
    public function getAddressBooksForUser($principalUri) {

        $stmt = $this->pdo->prepare('SELECT id, uri, displayname, principaluri, description, ctag FROM `'.$this->addressBooksTableName.'` WHERE principaluri = ?');
        $result = $stmt->execute(array($principalUri));

        $addressBooks = array();

        foreach($stmt->fetchAll() as $row) {

            $addressBooks[] = array(
                'id'  => $row['id'],
                'uri' => $row['uri'],
                'principaluri' => $row['principaluri'],
                '{DAV:}displayname' => $row['displayname'],
                '{' . Sabre_CardDAV_Plugin::NS_CARDDAV . '}addressbook-description' => $row['description'],
                '{http://calendarserver.org/ns/}getctag' => $row['ctag'],
                '{' . Sabre_CardDAV_Plugin::NS_CARDDAV . '}supported-address-data' => 
                    new Sabre_CardDAV_Property_SupportedAddressData(),
            );

        }

        return $addressBooks;

    }


    /**
     * Updates an addressbook's properties
     *
     * See Sabre_DAV_IProperties for a description of the mutations array, as 
     * well as the return value. 
     *
     * @param mixed $addressBookId
     * @param array $mutations
     * @see Sabre_DAV_IProperties::updateProperties
     * @return bool|array
     */
    public function updateAddressBook($addressBookId, array $mutations) {
        
        $updates = array();

        foreach($mutations as $property=>$newValue) {

            switch($property) {
                case '{DAV:}displayname' :
                    $updates['displayname'] = $newValue;
                    break;
                case '{' . Sabre_CardDAV_Plugin::NS_CARDDAV . '}addressbook-description' :
                    $updates['description'] = $newValue;
                    break;
                default :
                    // If any unsupported values were being updated, we must 
                    // let the entire request fail.
                    return false;
            }

        }

        // No values are being updated?
        if (!$updates) {
            return false;
        }

        $query = 'UPDATE `' . $this->addressBooksTableName . '` SET ctag = ctag + 1 ';
        foreach($updates as $key=>$value) {
            $query.=', `' . $key . '` = :' . $key . ' ';
        }
        $query.=' WHERE id = :addressbookid';

        $stmt = $this->pdo->prepare($query);
        $updates['addressbookid'] = $addressBookId;

        $stmt->execute($updates);

        return true;

    }

    /**
     * Creates a new address book 
     *
     * @param string $principalUri 
     * @param string $url Just the 'basename' of the url. 
     * @param array $properties 
     * @return void
     */
    public function createAddressBook($principalUri, $url, array $properties) {

        $values = array(
            'displayname' => null,
            'description' => null,
            'principaluri' => $principalUri,
            'uri' => $url,
        );

        foreach($properties as $property=>$newValue) {

            switch($property) {
                case '{DAV:}displayname' :
                    $values['displayname'] = $newValue;
                    break;
                case '{' . Sabre_CardDAV_Plugin::NS_CARDDAV . '}addressbook-description' :
                    $values['description'] = $newValue;
                    break;
                default :
                    throw new Sabre_DAV_Exception_BadRequest('Unknown property: ' . $property);
            }

        }

        $query = 'INSERT INTO `' . $this->addressBooksTableName . '` (uri, displayname, description, principaluri, ctag) VALUES (:uri, :displayname, :description, :principaluri, 1)';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($values);

    }

    /**
     * Deletes an entire addressbook and all its contents
     *
     * @param int $addressBookId 
     * @return void
     */
    public function deleteAddressBook($addressBookId) {

        $stmt = $this->pdo->prepare('DELETE FROM `' . $this->cardsTableName . '` WHERE addressbookid = ?');
        $stmt->execute(array($addressBookId));

        $stmt = $this->pdo->prepare('DELETE FROM `' . $this->addressBooksTableName . '` WHERE id = ?');
        $stmt->execute(array($addressBookId));

    }

    /**
     * Returns all cards for a specific addressbook id. 
     * 
     * @param mixed $addressbookId 
     * @return array 
     */
    public function getCards($addressbookId) {

        $stmt = $this->pdo->prepare('SELECT id, carddata, uri, lastmodified FROM `' . $this->cardsTableName . '` WHERE addressbookid = ?');
        $stmt->execute(array($addressbookId));

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    }
    /**
     * Returns a specfic card
     * 
     * @param mixed $addressBookId 
     * @param string $cardUri 
     * @return array 
     */
    public function getCard($addressBookId, $cardUri) {

        $stmt = $this->pdo->prepare('SELECT id, carddata, uri, lastmodified FROM `' . $this->cardsTableName . '` WHERE addressbookid = ? AND uri = ? LIMIT 1');
        $stmt->execute(array($addressBookId, $cardUri));

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return (count($result)>0?$result[0]:false);

    }

    /**
     * Creates a new card
     * 
     * @param mixed $addressBookId 
     * @param string $cardUri 
     * @param string $cardData 
     * @return bool 
     */
    public function createCard($addressBookId, $cardUri, $cardData) {

        $stmt = $this->pdo->prepare('INSERT INTO `' . $this->cardsTableName . '` (carddata, uri, lastmodified, addressbookid) VALUES (?, ?, ?, ?)');

        $result = $stmt->execute(array($cardData, $cardUri, time(), $addressBookId));

        $stmt2 = $this->pdo->prepare('UPDATE `' . $this->addressBooksTableName . '` SET ctag = ctag + 1 WHERE id = ?');
        $stmt2->execute(array($addressBookId));

        return $result;

    }

    /**
     * Updates a card
     * 
     * @param mixed $addressBookId 
     * @param string $cardUri 
     * @param string $cardData 
     * @return bool 
     */
    public function updateCard($addressBookId, $cardUri, $cardData) {

        $stmt = $this->pdo->prepare('UPDATE `' . $this->cardsTableName . '` SET carddata = ?, lastmodified = ? WHERE uri = ? AND addressbookid =?');
        $result = $stmt->execute(array($cardData, time(), $cardUri, $addressBookId));

        $stmt2 = $this->pdo->prepare('UPDATE `' . $this->addressBooksTableName . '` SET ctag = ctag + 1 WHERE id = ?');
        $stmt2->execute(array($addressBookId));

        return $stmt->rowCount()===1;

    }

    /**
     * Deletes a card
     * 
     * @param mixed $addressBookId 
     * @param string $cardUri 
     * @return bool 
     */
    public function deleteCard($addressBookId, $cardUri) {

        $stmt = $this->pdo->prepare('DELETE FROM `' . $this->cardsTableName . '` WHERE addressbookid = ? AND uri = ?');
        $stmt->execute(array($addressBookId, $cardUri));

        $stmt2 = $this->pdo->prepare('UPDATE `' . $this->addressBooksTableName . '` SET ctag = ctag + 1 WHERE id = ?');
        $stmt2->execute(array($addressBookId));

        return $stmt->rowCount()===1;

    }
}
