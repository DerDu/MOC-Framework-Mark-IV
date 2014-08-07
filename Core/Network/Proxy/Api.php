<?php
namespace MOC\IV\Core\Network\Proxy;

use MOC\IV\Core\Network\Proxy\Source\Api\Config;
use MOC\IV\Core\Network\Proxy\Source\Api\Type;

/**
 * Interface IApiInterface
 *
 * @package MOC\IV\Core\Network\Proxy
 */
interface IApiInterface {

	/**
	 * @return Config
	 */
	public function apiConfig();

	/**
	 * @return Type
	 */
	public function apiType();
}

/**
 * Class Api
 *
 * @package MOC\IV\Core\Network\Proxy
 */
class Api implements IApiInterface {

	/**
	 * @return Config
	 */
	public function apiConfig() {

		return new Config();
	}

	/**
	 * @return Type
	 */
	public function apiType() {

		return new Type();
	}

}
