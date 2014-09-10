<?php
/**
 * Created by PhpStorm.
 * User: kunze
 * Date: 12.08.14
 * Time: 16:37
 */

namespace MOC\MarkIV\Plugin\OSMEngine\Api;

use MOC\MarkIV\Plugin\OSMEngine\Source\Element\Node;
use MOC\MarkIV\Plugin\OSMEngine\Source\Element\Relation;
use MOC\MarkIV\Plugin\OSMEngine\Source\Element\Way;

class Element {
	/** @var \MOC\MarkIV\Plugin\OSMEngine\Source\Element\Node[] $NodeList */
	private $NodeList = array();
	/** @var \MOC\MarkIV\Plugin\OSMEngine\Source\Element\Relation[] $NodeList */
	private $RelationList = array();
	/** @var \MOC\MarkIV\Plugin\OSMEngine\Source\Element\Way[] $NodeList */
	private $WayList = array();

	function __construct( \MOC\MarkIV\Core\Xml\Reader\Source\Node $OSMElement ) {

		$NodeList = $OSMElement->getChildList();
		/** @var \MOC\MarkIV\Core\Xml\Reader\Source\Node $Node */
		foreach( (array)$NodeList as $Node ) {
			if( $Node->getName() == 'node' ) {
				$this->NodeList[$Node->getAttribute( 'id' )] = new Node( $Node );
			}
			if( $Node->getName() == 'relation' ) {
				$this->RelationList[$Node->getAttribute( 'id' )] = new Relation( $Node );
			}
			if( $Node->getName() == 'way' ) {
				$this->WayList[$Node->getAttribute( 'id' )] = new Way( $Node );
			}
		}

	}

	/**
	 * @return \MOC\MarkIV\Plugin\OSMEngine\Source\Element\Way[]
	 */
	public function getWayList() {

		return $this->WayList;
	}

	/**
	 * @return \MOC\MarkIV\Plugin\OSMEngine\Source\Element\Node[]
	 */
	public function getNodeList() {

		return $this->NodeList;
	}

	/**
	 * @return \MOC\MarkIV\Plugin\OSMEngine\Source\Element\Relation[]
	 */
	public function getRelationList() {

		return $this->RelationList;
	}
}
