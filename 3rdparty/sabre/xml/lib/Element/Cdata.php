<?php

namespace Sabre\Xml\Element;

use Sabre\Xml;

/**
 * CDATA element.
 *
 * This element allows you to easily inject CDATA.
 *
 * Note that we strongly recommend avoiding CDATA nodes, unless you definitely
 * know what you're doing, or you're working with unchangable systems that
 * require CDATA.
 *
 * @copyright Copyright (C) 2009-2015 fruux GmbH (https://fruux.com/).
 * @author Evert Pot (http://evertpot.com/)
 * @license http://sabre.io/license/ Modified BSD License
 */
class Cdata implements Xml\XmlSerializable
{
    /**
     * CDATA element value.
     *
     * @var string
     */
    protected $value;

    /**
     * Constructor
     *
     * @param string $value
     */
    function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * The xmlSerialize metod is called during xml writing.
     *
     * Use the $writer argument to write its own xml serialization.
     *
     * An important note: do _not_ create a parent element. Any element
     * implementing XmlSerializble should only ever write what's considered
     * its 'inner xml'.
     *
     * The parent of the current element is responsible for writing a
     * containing element.
     *
     * This allows serializers to be re-used for different element names.
     *
     * If you are opening new elements, you must also close them again.
     *
     * @param Writer $writer
     * @return void
     */
    function xmlSerialize(Xml\Writer $writer) {

        $writer->writeCData($this->value);

    }

}
