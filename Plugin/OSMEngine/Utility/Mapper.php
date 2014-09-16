<?php
namespace MOC\MarkIV\Plugin\OSMEngine\Utility;

/**
 * Class Mapper
 *
 * @package MOC\MarkIV\Plugin\OSMEngine\Utility
 */
class Mapper {

	/**
	 * @param int $X
	 * @param int $Y
	 * @param int $Zoom
	 *
	 * @return Mapper\Coordinates
	 */
	public static function buildCoordinates( $X, $Y, $Zoom = 1 ) {

		return new Mapper\Coordinates( $X, $Y, $Zoom );
	}

	/**
	 * @param float $Latitude
	 * @param float $Longitude
	 * @param int   $Zoom
	 * @param int   $Width
	 * @param int   $Height
	 * @param int   $Size
	 *
	 * @return Mapper\Box
	 */
	public static function buildBounding( $Latitude, $Longitude, $Zoom = 1, $Width = 425, $Height = 600, $Size = 256 ) {

		$Tile = self::buildTile( $Latitude, $Longitude, $Zoom );

		return new Mapper\Box( $Tile, $Width, $Height, $Size, $Zoom );
	}

	/**
	 * @param float $Latitude
	 * @param float $Longitude
	 * @param int   $Zoom
	 *
	 * @return Mapper\Tile
	 */
	public static function buildTile( $Latitude, $Longitude, $Zoom = 1 ) {

		return new Mapper\Tile( $Latitude, $Longitude, $Zoom );
	}
}
