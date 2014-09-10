<?php
namespace MOC\MarkIV\Plugin\OSMEngine\Source\Element;

class Way {

	const TYPE_WAY = 'WAY';
	const TYPE_AREA = 'AREA';

	const FEATURE_HIGHWAY = 'HIGHWAY';
	const FEATURE_BUILDING = 'BUILDING';

	private $Type = self::TYPE_WAY;
	private $NodeList = array();
	private $TagList = array();

	function __construct( \MOC\MarkIV\Core\Xml\Reader\Source\Node $Node ) {

		$NodeList = $Node->getChildList();
		/** @var \MOC\MarkIV\Core\Xml\Reader\Source\Node $Child */
		foreach( (array)$NodeList as $Child ) {
			if( $Child->getName() == 'nd' ) {
				array_push( $this->NodeList, $Child->getAttribute( 'ref' ) );
			}
			if( $Child->getName() == 'tag' ) {
				if( class_exists( $FeatureClass = '\MOC\MarkIV\Plugin\OSMEngine\Source\Feature\\'.( ucwords( $FeatureName = $Child->getAttribute( 'k' ) ) ) ) ) {
					$this->TagList[strtoupper( $FeatureName )] = new $FeatureClass( $Child );
				}
			}
		}

		if( current( $this->NodeList ) == end( $this->NodeList ) ) {
			$this->Type = self::TYPE_AREA;
		}
	}

	public function hasFeature( $FeatureName = null ) {

		if( null === $FeatureName ) {
			return !empty( $this->TagList );
		} else {
			return array_key_exists( strtoupper( $FeatureName ), $this->TagList );
		}
	}

	/**
	 * @param null|string $FeatureName
	 *
	 * @return \MOC\MarkIV\Plugin\OSMEngine\Source\Feature\Generic|\MOC\MarkIV\Plugin\OSMEngine\Source\Feature\Generic[]
	 */
	public function getFeature( $FeatureName = null ) {

		if( null === $FeatureName ) {
			return $this->TagList;
		} else {
			return $this->TagList[strtoupper( $FeatureName )];
		}
	}

	public function hasType( $TypeName ) {

		return $this->Type == $TypeName;
	}

	/**
	 * @return string
	 */
	public function getType() {

		return $this->Type;
	}

	/**
	 * @return array
	 */
	public function getTagList() {

		return $this->TagList;
	}

	/**
	 * @return array
	 */
	public function getNodeList() {

		return $this->NodeList;
	}
}
