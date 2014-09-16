<?php
namespace MOC\MarkIV\Plugin\OSMEngine\Source\Feature;

/**
 * Class Building
 *
 * @package MOC\MarkIV\Plugin\OSMEngine\Source\Feature
 */
class Building extends Generic {

	const TYPE_APARTMENTS = 'APARTMENTS';
	const TYPE_OFFICE = 'OFFICE';
	const TYPE_RETAIL = 'RETAIL';
	const TYPE_COMMERCIAL = 'COMMERCIAL';
	const TYPE_CHURCH = 'CHURCH';
	const TYPE_SCHOOL = 'SCHOOL';
	const TYPE_HOUSE = 'HOUSE';
	const TYPE_SUPERMARKET = 'SUPERMARKET';
	const TYPE_KINDERGARDEN = 'KINDERGARDEN';
	const TYPE_RESIDENTIAL = 'RESIDENTIAL';
	const TYPE_COLLAPSED = 'COLLAPSED';
	const TYPE_GARAGES = 'GARAGES';
	const TYPE_GARAGE = 'GARAGE';
	const TYPE_PUBLIC = 'PUBLIC';
	const TYPE_MANUFACTURE = 'MANUFACTURE';
	const TYPE_INDUSTRIAL = 'INDUSTRIAL';
	const TYPE_TRAIN_STATION = 'TRAIN_STATION';

	const TYPE_YES = 'YES';

	/**
	 * @param \MOC\MarkIV\Core\Xml\Reader\Source\Node $Node
	 */
	function __construct( \MOC\MarkIV\Core\Xml\Reader\Source\Node $Node ) {

		$Type = strtoupper( $Node->getAttribute( 'v' ) );
		if( defined( 'self::TYPE_'.$Type ) ) {
			$this->setType( constant( 'self::TYPE_'.$Type ) );
		} else {
			$this->setType( false );
			trigger_error( 'Building missing '.$Type );
		}
	}
}
