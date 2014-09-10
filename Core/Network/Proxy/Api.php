<?php
namespace MOC\MarkIV\Core\Network\Proxy;

use MOC\MarkIV\Core\Network\Proxy\Source\Api\Config;
use MOC\MarkIV\Core\Network\Proxy\Source\Api\Type;

/**
 * Interface IApiInterface
 *
 * @package MOC\MarkIV\Core\Network\Proxy
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
 * @package MOC\MarkIV\Core\Network\Proxy
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
