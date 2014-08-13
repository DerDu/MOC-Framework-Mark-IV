<?php
namespace MOC\IV\Core\Xml\Reader\Source;

abstract class NodeType {
	const TYPE_STRUCTURE = 1;
	const TYPE_CONTENT = 2;
	const TYPE_CDATA = 3;
	const TYPE_COMMENT = 4;

	private $Type = self::TYPE_CONTENT;

	/**
	 * @param $Value
	 *
	 * @return Node
	 */
	public function SetType( $Value ) {
		$this->Type = $Value;
		return $this;
	}

	/**
	 * @return int
	 */
	public function GetType() {
		return $this->Type;
	}
}
