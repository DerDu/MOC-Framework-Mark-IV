<?php
namespace MOC\MarkIV\Plugin\OSMEngine\Utility\Mapper;

use MOC\MarkIV\Plugin\OSMEngine\Utility\Mapper;

/**
 * Class Box
 *
 * @package MOC\MarkIV\Plugin\OSMEngine\Utility\Mapper
 */
class Box
{

    /** @var float $West */
    private $West = 0.0;
    /** @var float $South */
    private $South = 0.0;
    /** @var float $East */
    private $East = 0.0;
    /** @var float $North */
    private $North = 0.0;

    /**
     * @param \MOC\MarkIV\Plugin\OSMEngine\Utility\Mapper\Tile $Tile
     * @param int                                              $Width
     * @param int                                              $Height
     * @param int                                              $Size
     * @param float                                            $Zoom
     */
    function __construct( Mapper\Tile $Tile, $Width, $Height, $Size, $Zoom )
    {

        $XTileS = ( ( $Tile->getX() * $Size ) - ( $Width / 2 ) ) / $Size;
        $YTileS = ( ( $Tile->getY() * $Size ) - ( $Height / 2 ) ) / $Size;
        $XTileE = ( ( $Tile->getX() * $Size ) + ( $Width / 2 ) ) / $Size;
        $YTileE = ( ( $Tile->getY() * $Size ) + ( $Height / 2 ) ) / $Size;

        $this->West = Mapper::buildCoordinates( $XTileS, $YTileS, $Zoom )->getLongitude();
        $this->South = Mapper::buildCoordinates( $XTileS, $YTileS, $Zoom )->getLatitude();

        $this->East = Mapper::buildCoordinates( $XTileE, $YTileE, $Zoom )->getLongitude();
        $this->North = Mapper::buildCoordinates( $XTileE, $YTileE, $Zoom )->getLatitude();
    }

    /**
     * @return float
     */
    public function getWest()
    {

        return $this->West;
    }

    /**
     * @return float
     */
    public function getSouth()
    {

        return $this->South;
    }

    /**
     * @return float
     */
    public function getEast()
    {

        return $this->East;
    }

    /**
     * @return float
     */
    public function getNorth()
    {

        return $this->North;
    }

}
