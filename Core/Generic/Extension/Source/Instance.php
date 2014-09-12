<?php
namespace MOC\MarkIV\Core\Generic\Extension\Source;

/**
 * Interface IInstanceInterface
 *
 * @package MOC\MarkIV\Core\Generic\Extension\Source
 */
interface IInstanceInterface {

	/**
	 * @return string
	 */
	public function getIdentifier();

	/**
	 * @return object
	 */
	public function getObject();
}

/**
 * Class Instance
 *
 * @package MOC\MarkIV\Core\Generic\Extension\Source
 */
class Instance {

	/** @var null|\stdClass $Object */
	private $Object = null;
	/** @var null|string $Identifier */
	private $Identifier = null;

	/**
	 * @param object      $Object
	 * @param null|string $Identifier
	 */
	function __construct( $Object, $Identifier = null ) {

		$this->Object = $Object;
		if( null === $Identifier ) {
			$Identifier = sha1( uniqid( microtime(), true ) );
		}
		$this->Identifier = $Identifier;
	}


	/**
	 * @return string
	 */
	public function getIdentifier() {

		return $this->Identifier;
	}

	/**
	 * @return object
	 */
	public function getObject() {

		return $this->Object;
	}

}
