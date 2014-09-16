<?php
namespace MOC\MarkIV\Plugin\OSMEngine\Utility\Mapper;

/**
 * Class Tile
 *
 * @package MOC\MarkIV\Plugin\OSMEngine\Utility\Mapper
 */
class Tile {

	/** @var int $X */
	private $X = 0;
	/** @var int $Y */
	private $Y = 0;

	/**
	 * @param float $Latitude
	 * @param float $Longitude
	 * @param int   $Zoom
	 */
	function __construct( $Latitude, $Longitude, $Zoom = 1 ) {

		$this->X = floor( ( ( $Longitude + 180 ) / 360 ) * pow( 2, $Zoom ) );
		$this->Y = floor( ( 1 - ( log( tan( $Latitude * pi() / 180 ) + ( 1 / cos( $Latitude * pi() / 180 ) ) ) / pi() ) ) * pow( 2, ( $Zoom - 1 ) ) );
	}

	/**
	 * @return int
	 */
	public function getX() {

		return $this->X;
	}

	/**
	 * @return int
	 */
	public function getY() {

		return $this->Y;
	}
}
