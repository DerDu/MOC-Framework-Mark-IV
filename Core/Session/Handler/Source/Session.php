<?php
namespace MOC\IV\Core\Session\Handler\Source;

/**
 * Interface ISession
 *
 * @package MOC\IV\Core\Session\Handler\Source
 */
interface ISession {

	/**
	 * @return void
	 */
	public function openSession();

	/**
	 * @return array
	 */
	public function getContent();

	/**
	 * @return void
	 */
	public function closeSession();

}

/**
 * Class Session
 *
 * @package MOC\IV\Core\Session\Handler\Source
 */
class Session implements ISession {

	/** @var string $Identifier */
	private static $Identifier = __CLASS__;

	/**
	 * @param null|string $Identifier
	 * @param bool        $AutoOpen
	 */
	function __construct( $Identifier = null, $AutoOpen = true ) {

		if( null === $Identifier ) {
			self::$Identifier = __CLASS__;
		} else {
			self::$Identifier = $Identifier;
		}

		if( true === $AutoOpen ) {
			$this->openSession();
		}
	}

	/**
	 * @return void
	 */
	public function openSession() {

		if( !strlen( session_id() ) > 0 ) {
			session_start();
		}
		if( !isset( $_SESSION[self::$Identifier] ) ) {
			$_SESSION[self::$Identifier] = array();
		}
	}

	/**
	 * @return void
	 */
	public function closeSession() {

		session_write_close();
	}

	/**
	 * @return array
	 */
	public function &getContent() {
		$Reference = &$_SESSION[self::$Identifier];
		return $Reference;
	}
}
