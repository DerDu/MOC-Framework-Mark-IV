<?php
namespace MOC\IV\Api;

use MOC\IV\Module\Encoding;

/**
 * Interface IModule
 *
 * @package MOC\IV\Api
 */
interface IModuleInterface {

	/**
	 * @return Encoding
	 */
	public function unitEncoding();
}

/**
 * Class Module
 *
 * @package MOC\IV\Api
 */
class Module implements IModuleInterface {

	/**
	 * @return Encoding
	 */
	public function unitEncoding() {

		return new Encoding();
	}

}
