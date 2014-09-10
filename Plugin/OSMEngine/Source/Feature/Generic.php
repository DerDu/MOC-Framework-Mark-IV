<?php
namespace MOC\MarkIV\Plugin\OSMEngine\Source\Feature;

/**
 * Class Generic
 *
 * @package MOC\MarkIV\Plugin\OSMEngine\Source\Feature
 */
abstract class Generic {

	private $Type = null;

	/**
	 * @param string $TypeName
	 *
	 * @return bool
	 */
	public function hasType( $TypeName ) {

		return $this->getType() == $TypeName;
	}

	/**
	 * @return null|string
	 */
	public function getType() {

		return $this->Type;
	}

	/**
	 * @param null|string $Type
	 */
	public function setType( $Type ) {

		$this->Type = $Type;
	}
}
