<?php
namespace MOC\IV\Plugin\OSMEngine\Source\Feature;

class Highway extends Generic {

	const TYPE_ROAD = 'ROAD';

	const TYPE_MOTORWAY = 'MOTORWAY';
	const TYPE_TRUNK = 'TRUNK';
	const TYPE_PRIMARY = 'PRIMARY';
	const TYPE_SECONDARY = 'SECONDARY';
	const TYPE_TERTIARY = 'TERTIARY';
	const TYPE_RESIDENTIAL = 'RESIDENTIAL';
	const TYPE_SERVICE = 'SERVICE';

	function __construct( \MOC\IV\Core\Xml\Reader\Source\Node $Node ) {

		switch( strtoupper( $Node->getAttribute( 'v' ) ) ) {
			case self::TYPE_MOTORWAY:
				$this->setType( self::TYPE_MOTORWAY );
				break;
			case self::TYPE_PRIMARY:
				$this->setType( self::TYPE_PRIMARY );
				break;
			case self::TYPE_RESIDENTIAL:
				$this->setType( self::TYPE_RESIDENTIAL );
				break;
			case self::TYPE_SECONDARY:
				$this->setType( self::TYPE_SECONDARY );
				break;
			case self::TYPE_SERVICE:
				$this->setType( self::TYPE_SERVICE );
				break;
			case self::TYPE_TERTIARY:
				$this->setType( self::TYPE_TERTIARY );
				break;
			case self::TYPE_TRUNK:
				$this->setType( self::TYPE_TRUNK );
				break;
			default:
				$this->setType( self::TYPE_ROAD );
				break;
		}
	}

	public function hasType( $TypeName ) {

		return $this->getType() == $TypeName;
	}
}
