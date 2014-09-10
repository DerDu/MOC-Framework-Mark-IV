<?php
namespace MOC\MarkIV\Core;

/**
 * Interface INetworkInterface
 *
 * @package MOC\MarkIV\Core
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
 * @package MOC\MarkIV\Core
 */
class Network implements INetworkInterface {

	/**
	 * @return Network\Proxy\Api
	 */
	public function apiProxy() {

		return new Network\Proxy\Api();
	}
}
