<?php
namespace MOC\MarkIV\Core\Session\Handler\Source;

/**
 * Interface IStoreInterface
 *
 * @package MOC\MarkIV\Core\Session\Handler\Source
 */
interface IStoreInterface {

	/**
	 * @param null|string $Key
	 *
	 * @return mixed
	 */
	public function getValue( $Key = null );

	/**
	 * @param string $Key
	 * @param mixed  $Value
	 *
	 * @return Store
	 */
	public function setValue( $Key, $Value );
}

/**
 * Class Store
 *
 * @package MOC\MarkIV\Core\Session\Handler\Source
 */
class Store implements IStoreInterface {

	/** @var null|Session $Session */
	private $Session = null;

	/**
	 * @param Session $Session
	 */
	function __construct( Session $Session ) {

		$this->Session = $Session;
	}

	/**
	 * @param null|string $Key
	 *
	 * @return mixed
	 */
	public function getValue( $Key = null ) {

		$Content = & $this->Session->getContent();
		if( $Key !== null ) {
			if( isset( $Content[$Key] ) ) {
				return $Content[$Key];
			} else {
				return null;
			}
		}

		return $Content;
	}

	/**
	 * @param string $Key
	 * @param mixed  $Value
	 *
	 * @return Store
	 */
	public function setValue( $Key, $Value ) {

		$Content = & $this->Session->getContent();
		$Content[$Key] = $Value;

		return $this;
	}

}
