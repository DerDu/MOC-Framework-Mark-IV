<?php
namespace MOC\IV\Core\Network\Proxy\Source\Api;

use MOC\IV\Core\Network\Proxy\Source\Config\Credentials;
use MOC\IV\Core\Network\Proxy\Source\Config\Server;
use MOC\IV\Core\Network\Proxy\Source\Type\Basic;
use MOC\IV\Core\Network\Proxy\Source\Type\None;
use MOC\IV\Core\Network\Proxy\Source\Type\Relay;

/**
 * Interface ITypeInterface
 *
 * @package MOC\IV\Core\Network\Proxy\Source\Api
 */
interface ITypeInterface {

	/**
	 * @return None
	 */
	public function createNone();

	/**
	 * @param Server $Server
	 *
	 * @return Relay
	 */
	public function createRelay( Server $Server );

	/**
	 * @param Server      $Server
	 * @param Credentials $Credentials
	 *
	 * @return Basic
	 */
	public function createBasic( Server $Server, Credentials $Credentials );
}

/**
 * Class Type
 *
 * @package MOC\IV\Core\Network\Proxy\Source\Api
 */
class Type implements ITypeInterface {

	/**
	 * @return None
	 */
	public function createNone() {

		return new None();
	}

	/**
	 * @param Server $Server
	 *
	 * @return Relay
	 */
	public function createRelay( Server $Server ) {

		return new Relay( $Server );
	}

	/**
	 * @param Server      $Server
	 * @param Credentials $Credentials
	 *
	 * @return Basic
	 */
	public function createBasic( Server $Server, Credentials $Credentials ) {

		return new Basic( $Server, $Credentials );
	}
}
