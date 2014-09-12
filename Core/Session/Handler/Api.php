<?php
namespace MOC\MarkIV\Core\Session\Handler;

use MOC\MarkIV\Core\Session\Handler\Source\ISessionInterface;
use MOC\MarkIV\Core\Session\Handler\Source\Session;
use MOC\MarkIV\Core\Session\Handler\Source\IIdentifierInterface;
use MOC\MarkIV\Core\Session\Handler\Source\Identifier;
use MOC\MarkIV\Core\Session\Handler\Source\IStoreInterface;
use MOC\MarkIV\Core\Session\Handler\Source\Store;

/**
 * Interface IApiInterface
 *
 * @package MOC\MarkIV\Core\Session\Handler
 */
interface IApiInterface extends ISessionInterface, IIdentifierInterface, IStoreInterface {

}

/**
 * Class Api
 *
 * @package MOC\MarkIV\Core\Session\Handler
 */
class Api implements IApiInterface {

	/**
	 * @param string $Identifier
	 *
	 * @return Api
	 */
	public function setIdentifier( $Identifier ) {

		$Identifier = new Identifier();
		$Identifier->setIdentifier( $Identifier );

		return $this;
	}

	/**
	 * @return Api
	 */
	public function newIdentifier() {

		$Identifier = new Identifier();
		$Identifier->newIdentifier();

		return $this;
	}

	/**
	 * @return string
	 */
	public function getIdentifier() {

		$Identifier = new Identifier();

		return $Identifier->getIdentifier();
	}

	/**
	 * @param null|string $Identifier
	 *
	 * @return Api
	 */
	public function openSession( $Identifier = null ) {

		new Session( $Identifier, true );

		return $this;
	}

	/**
	 * @return array
	 */
	public function getContent() {

		$Session = new Session();

		return $Session->getContent();
	}

	/**
	 * @return Api
	 */
	public function closeSession() {

		$Session = new Session();
		$Session->closeSession();

		return $this;
	}

	/**
	 * @return Api
	 */
	public function destroySession() {

		$Session = new Session();
		$Session->destroySession();

		return $this;
	}

	/**
	 * @param null|string $Key
	 *
	 * @return mixed
	 */
	public function getValue( $Key = null ) {

		$Store = new Store( new Session() );

		return $Store->getValue( $Key );
	}

	/**
	 * @param string $Key
	 * @param mixed  $Value
	 *
	 * @return Store
	 */
	public function setValue( $Key, $Value ) {

		$Store = new Store( new Session() );
		$Store->setValue( $Key, $Value );

		return $this;
	}

}
