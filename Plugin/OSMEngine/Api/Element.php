<?php
/**
 * Created by PhpStorm.
 * User: kunze
 * Date: 12.08.14
 * Time: 16:37
 */

namespace MOC\IV\Plugin\OSMEngine\Api;

use MOC\IV\Plugin\OSMEngine\Source\Element\Node;
use MOC\IV\Plugin\OSMEngine\Source\Element\Relation;
use MOC\IV\Plugin\OSMEngine\Source\Element\Way;

class Element {

	private $Node = array();
	private $Relation = array();
	private $Way = array();

	function __construct( \SimpleXMLElement $OSMElement ) {

		$NodeCount = count( $OSMElement->node );

		for( $Run = 0; $Run < $NodeCount; $Run++ ) {
			$AttributeList = $OSMElement->node[$Run]->attributes();
			$this->Node[$AttributeList['id']] = new Node( $OSMElement->node[$Run] );
		}
	}
}
