<?php
namespace MOC\IV\Plugin\OSMEngine\Source\Element;

class Way {

	const TYPE_WAY = 'WAY';
	const TYPE_AREA = 'AREA';

	const FEATURE_HIGHWAY = 'HIGHWAY';

	private $Type = self::TYPE_WAY;
	private $NodeList = array();
	private $TagList = array();

	function __construct( \MOC\IV\Core\Xml\Reader\Source\Node $Node ) {

		$NodeList = $Node->getChildList();
		/** @var \MOC\IV\Core\Xml\Reader\Source\Node $Child */
		foreach( (array)$NodeList as $Child ) {
			if( $Child->getName() == 'nd' ) {
				array_push( $this->NodeList, $Child->getAttribute( 'ref' ) );
			}
			if( $Child->getName() == 'tag' ) {
				if( class_exists( $FeatureClass = '\MOC\IV\Plugin\OSMEngine\Source\Feature\\'.( $FeatureName = strtoupper( $Child->getAttribute( 'k' ) ) ) ) ) {
					$this->TagList[$FeatureName] = new $FeatureClass( $Child );
				}
			}
		}

		if( current( $this->NodeList ) == end( $this->NodeList ) ) {
			$this->Type = self::TYPE_AREA;
		}
	}

	public function hasFeature( $FeatureName = null ) {

		if( null === $FeatureName ) {
			if( empty( $this->TagList ) ) {
				return false;
			}

			return true;
		} else {
			return array_key_exists( strtoupper( $FeatureName ), $this->TagList );
		}
	}

	public function hasType( $TypeName ) {

		return $this->Type = $TypeName;
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
