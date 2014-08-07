<?php
namespace MOC\IV\Core;

/**
 * Interface INetworkInterface
 *
 * @package MOC\IV\Core
 */
interface INetworkInterface {

	/**
	 * @return Network\Proxy\Api
	 */
	public function apiProxy();
}

/**
 * Class Network
 *
 * @package MOC\IV\Core
 */
class Network implements INetworkInterface {

	/**
	 * @return Network\Proxy\Api
	 */
	public function apiProxy() {

		return new Network\Proxy\Api();
	}
}
