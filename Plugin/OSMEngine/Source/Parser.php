<?php
namespace MOC\MarkIV\Plugin\OSMEngine\Source;

use MOC\MarkIV\Core\Drive\File\IApiInterface as File;
use MOC\MarkIV\Plugin\OSMEngine\Api\Element;

/**
 * Class Parser
 *
 * @package MOC\MarkIV\Plugin\OSMEngine\Source
 */
class Parser
{

    /** @var null|\SimpleXMLElement $OSMData */
    private $OSMData = null;

    /**
     * @param File $OSMFile
     */
    function __construct( File $OSMFile )
    {

        $this->OSMData = simplexml_load_string( $OSMFile->getContent() );

        $Element = new Element( $this->OSMData );

        return $Element;
    }

}
