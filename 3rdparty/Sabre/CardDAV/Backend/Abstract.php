<?php

/**
 * Abstract Backend class
 *
 * This class serves as a base-class for addressbook backends
 *
 * Note that there are references to 'addressBookId' scattered throughout the 
 * class. The value of the addressBookId is completely up to you, it can be any 
 * arbitrary value you can use as an unique identifier.
 * 
 * @package Sabre
 * @subpackage CardDAV
 * @copyright Copyright (C) 2007-2011 Rooftop Solutions. All rights reserved.
 * @author Evert Pot (http://www.rooftopsolutions.nl/) 
 * @license http://code.google.com/p/sabredav/wiki/License Modified BSD License
 */
abstract class Sabre_CardDAV_Backend_Abstract {

    /**
     * Returns the list of addressbooks for a specific user.
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
    public abstract function getAddressBooksForUser($principalUri); 

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
    public abstract function updateAddressBook($addressBookId, array $mutations); 

    /**
     * Creates a new address book 
     *
     * @param string $principalUri 
     * @param string $url Just the 'basename' of the url. 
     * @param array $properties 
     * @return void
     */
    abstract public function createAddressBook($principalUri, $url, array $properties); 

    /**
     * Deletes an entire addressbook and all its contents
     *
     * @param mixed $addressBookId 
     * @return void
     */
    abstract public function deleteAddressBook($addressBookId); 

    /**
     * Returns all cards for a specific addressbook id. 
     *
     * This method should return the following properties for each card:
     *   * carddata - raw vcard data
     *   * uri - Some unique url
     *   * lastmodified - A unix timestamp

     * @param mixed $addressbookId 
     * @return array 
     */
    public abstract function getCards($addressbookId); 

    /**
     * Returns a specfic card
     * 
     * @param mixed $addressBookId 
     * @param string $cardUri 
     * @return void
     */
    public abstract function getCard($addressBookId, $cardUri); 

    /**
     * Creates a new card
     * 
     * @param mixed $addressBookId 
     * @param string $cardUri 
     * @param string $cardData 
     * @return bool 
     */
    abstract public function createCard($addressBookId, $cardUri, $cardData); 

    /**
     * Updates a card
     * 
     * @param mixed $addressBookId 
     * @param string $cardUri 
     * @param string $cardData 
     * @return bool 
     */
    abstract public function updateCard($addressBookId, $cardUri, $cardData); 

    /**
     * Deletes a card
     * 
     * @param mixed $addressBookId 
     * @param string $cardUri 
     * @return bool 
     */
    abstract public function deleteCard($addressBookId, $cardUri); 

}
