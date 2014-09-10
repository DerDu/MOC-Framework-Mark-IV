<?php
namespace MOC\MarkIV\Plugin\OSMEngine\Source\Element;

class Node {

	private $Latitude = 0, $Longitude = 0;

	function __construct( \MOC\MarkIV\Core\Xml\Reader\Source\Node $Node ) {

		$this->Latitude = $Node->getAttribute( 'lat' );
		$this->Longitude = $Node->getAttribute( 'lon' );
	}

	/**
	 * @return int|null
	 */
	public function getLatitude() {

		return $this->Latitude;
	}

	/**
	 * @return int|null
	 */
	public function getLongitude() {

		return $this->Longitude;
	}

}
