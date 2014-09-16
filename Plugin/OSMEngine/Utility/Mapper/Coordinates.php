<?php
namespace MOC\MarkIV\Plugin\OSMEngine\Utility\Mapper;

/**
 * Class Coordinates
 *
 * @package MOC\MarkIV\Plugin\OSMEngine\Utility\Mapper
 */
class Coordinates {

	/** @var float $Latitude */
	private $Latitude = 0.0;
	/** @var float $Longitude */
	private $Longitude = 0.0;

	/**
	 * @param int $X
	 * @param int $Y
	 * @param int $Zoom
	 */
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
