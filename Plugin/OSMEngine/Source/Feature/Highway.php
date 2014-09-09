<?php
namespace MOC\IV\Plugin\OSMEngine\Source\Feature;

class Highway extends Generic {

	const TYPE_MOTORWAY = 'MOTORWAY';
	const TYPE_TRUNK = 'TRUNK';
	const TYPE_PRIMARY = 'PRIMARY';
	const TYPE_SECONDARY = 'SECONDARY';
	const TYPE_TERTIARY = 'TERTIARY';
	const TYPE_RESIDENTIAL = 'RESIDENTIAL';
	const TYPE_SERVICE = 'SERVICE';
	const TYPE_UNCLASSIFIED = 'UNCLASSIFIED';
	const TYPE_CYCLEWAY = 'CYCLEWAY';
	const TYPE_FOOTWAY = 'FOOTWAY';
	const TYPE_PEDESTRIAN = 'PEDESTRIAN';
	const TYPE_STEPS = 'STEPS';
	const TYPE_ROAD = 'ROAD';
	const TYPE_DISUSED = 'DISUSED';
	const TYPE_PATH = 'PATH';
	const TYPE_PLATFORM = 'PLATFORM';
	const TYPE_TRAFFIC_ISLAND = 'TRAFFIC_ISLAND';
	const TYPE_LIVING_STREET = 'LIVING_STREET';
	const TYPE_TRACK = 'TRACK';

	function __construct( \MOC\IV\Core\Xml\Reader\Source\Node $Node ) {

		$Type = strtoupper( $Node->getAttribute( 'v' ) );
		if( defined( 'self::TYPE_'.$Type ) ) {
			$this->setType( constant( 'self::TYPE_'.$Type ) );
		} else {
			$this->setType( false );
			trigger_error( 'Highway missing '.$Type );
		}
	}
}
