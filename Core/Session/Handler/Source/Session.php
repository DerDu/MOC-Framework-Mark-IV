<?php
namespace MOC\MarkIV\Core\Session\Handler\Source;

/**
 * Interface ISessionInterface
 *
 * @package MOC\MarkIV\Core\Session\Handler\Source
 */
interface ISessionInterface {

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

	/**
	 * @return void
	 */
	public function destroySession();
}

/**
 * Class Session
 *
 * @package MOC\MarkIV\Core\Session\Handler\Source
 */
class Session implements ISessionInterface {

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

		if( !$this->isSessionAvailable() ) {
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
	 * @return void
	 */
	public function destroySession() {

		if( $this->isSessionAvailable() ) {
			session_destroy();
		}
	}

	/**
	 * @return bool
	 */
	private function isSessionAvailable() {

		if( version_compare( phpversion(), '5.4.0', '>=' ) ) {
			return session_status() === PHP_SESSION_ACTIVE ? true : false;
		} else {
			return session_id() === '' ? false : true;
		}
	}

	/**
	 * @return array
	 */
	public function &getContent() {

		$Reference = & $_SESSION[self::$Identifier];

		return $Reference;
	}
}
