<?php
namespace MOC\MarkIV\Plugin\OSMEngine\Utility;

class Mapper {

	public static function buildCoordinates( $X, $Y, $Zoom = 1 ) {

		return new MapperCoordinates( $X, $Y, $Zoom );
	}

	public static function buildBounding( $Latitude, $Longitude, $Zoom = 1, $Width = 425, $Height = 600, $Size = 256 ) {

		$Tile = self::buildTile( $Latitude, $Longitude, $Zoom );

		return new MapperBox( $Tile, $Width, $Height, $Size, $Zoom );
	}

	public static function buildTile( $Latitude, $Longitude, $Zoom = 1 ) {

		return new MapperTile( $Latitude, $Longitude, $Zoom );
	}
}

class MapperTile {

	/** @var int $X */
	private $X = 0;
	/** @var int $Y */
	private $Y = 0;

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

class MapperCoordinates {

	/** @var float $Latitude */
	private $Latitude = 0.0;
	/** @var float $Longitude */
	private $Longitude = 0.0;

	function __construct( $X, $Y, $Zoom = 1 ) {

		$this->Longitude = ( ( $X / pow( 2, $Zoom ) ) * 360.0 ) - 180.0;
		$this->Latitude = atan( sinh( pi() - ( ( $Y / pow( 2, $Zoom ) ) * ( 2 * pi() ) ) ) ) * ( 180 / pi() );
	}

	/**
	 * @return float
	 */
	public function getLatitude() {

		return $this->Latitude;
	}

	/**
	 * @return float
	 */
	public function getLongitude() {

		return $this->Longitude;
	}
}

class MapperBox {

	/** @var float $West */
	private $West = 0.0;
	/** @var float $South */
	private $South = 0.0;
	/** @var float $East */
	private $East = 0.0;
	/** @var float $North */
	private $North = 0.0;

	/**
	 * @param MapperTile $Tile
	 * @param int        $Width
	 * @param int        $Height
	 * @param int        $Size
	 * @param float      $Zoom
	 */
	function __construct( MapperTile $Tile, $Width, $Height, $Size, $Zoom ) {

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
	public function getWest() {

		return $this->West;
	}

	/**
	 * @return float
	 */
	public function getSouth() {

		return $this->South;
	}

	/**
	 * @return float
	 */
	public function getEast() {

		return $this->East;
	}

	/**
	 * @return float
	 */
	public function getNorth() {

		return $this->North;
	}

}
