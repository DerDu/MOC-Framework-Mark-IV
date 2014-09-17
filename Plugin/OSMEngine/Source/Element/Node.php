<?php
namespace MOC\MarkIV\Plugin\OSMEngine\Source\Element;

/**
 * Class Node
 *
 * @package MOC\MarkIV\Plugin\OSMEngine\Source\Element
 */
class Node
{

    /** @var float|null $Latitude */
    private $Latitude = 0.0;
    /** @var float|null $Longitude */
    private $Longitude = 0.0;

    /**
     * @param \MOC\MarkIV\Core\Xml\Reader\Source\Node $Node
     */
    function __construct( \MOC\MarkIV\Core\Xml\Reader\Source\Node $Node )
    {

        $this->Latitude = $Node->getAttribute( 'lat' );
        $this->Longitude = $Node->getAttribute( 'lon' );
    }

    /**
     * @return int|null
     */
    public function getLatitude()
    {

        return $this->Latitude;
    }

    /**
     * @return int|null
     */
    public function getLongitude()
    {

        return $this->Longitude;
    }

}
