<?php
namespace MOC\IV\Api;

use MOC\IV\Module\Encoding;

/**
 * Interface IModule
 *
 * @package MOC\IV\Api
 */
interface IModule {

	/**
	 * @return Encoding
	 */
	public function Encoding();
}

/**
 * Class Module
 *
 * @package MOC\IV\Api
 */
class Module implements IModule {

	/**
	 * @return Encoding
	 */
	public function Encoding() {

		return new Encoding();
	}

}
