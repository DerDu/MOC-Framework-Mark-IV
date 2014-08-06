<?php
namespace MOC\IV\Core\Session\Handler\Source;

/**
 * Interface IIdentifier
 *
 * @package MOC\IV\Core\Session\Handler\Source
 */
interface IIdentifierInterface {

	/**
	 * @param string $Identifier
	 *
	 * @return Identifier
	 */
	public function setIdentifier( $Identifier );

	/**
	 * @return Identifier
	 */
	public function newIdentifier();

	/**
	 * @return string
	 */
	public function getIdentifier();
}

/**
 * Class Identifier
 *
 * @package MOC\IV\Core\Session\Handler\Source
 */
class Identifier implements IIdentifierInterface {

	/**
	 * @param string $Identifier
	 *
	 * @return Identifier
	 */
	public function setIdentifier( $Identifier ) {

		session_id( $Identifier );

		return $this;
	}

	/**
	 * @return Identifier
	 */
	public function newIdentifier() {

		session_regenerate_id();

		return $this;
	}

	/**
	 * @return string
	 */
	public function getIdentifier() {

		return session_id();
	}

}
