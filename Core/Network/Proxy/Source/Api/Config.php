<?php
namespace MOC\IV\Core\Network\Proxy\Source\Api;

use MOC\IV\Core\Network\Proxy\Source\Config\Credentials;
use MOC\IV\Core\Network\Proxy\Source\Config\Server;

/**
 * Interface IConfigInterface
 *
 * @package MOC\IV\Core\Network\Proxy\Source\Api
 */
interface IConfigInterface {

	/**
	 * @param string $UserName
	 * @param string $Password
	 *
	 * @return Credentials
	 */
	public function createCredentials( $UserName, $Password );

	/**
	 * @param string     $Host
	 * @param int|string $Port
	 *
	 * @return Server
	 */
	public function createServer( $Host, $Port );
}

/**
 * Class Config
 *
 * @package MOC\IV\Core\Network\Proxy\Source\Api
 */
class Config implements IConfigInterface {

	/**
	 * @param string $UserName
	 * @param string $Password
	 *
	 * @return Credentials
	 */
	public function createCredentials( $UserName, $Password ) {

		return new Credentials( $UserName, $Password );
	}

	/**
	 * @param string     $Host
	 * @param int|string $Port
	 *
	 * @return Server
	 */
	public function createServer( $Host, $Port ) {

		return new Server( $Host, $Port );
	}
}
