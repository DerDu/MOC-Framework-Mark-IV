<?php
namespace MOC\IV\Plugin\OSMEngine\Source\Feature;

abstract class Generic {

	private $Type = null;

	/**
	 * @param null $Type
	 */
	public function setType( $Type ) {

		$this->Type = $Type;
	}

	/**
	 * @return null
	 */
	public function getType() {

		return $this->Type;
	}

}
