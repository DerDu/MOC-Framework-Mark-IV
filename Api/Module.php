<?php
namespace MOC\MarkIV\Api;

use MOC\MarkIV\Module\Encoding;

/**
 * Interface IModule
 *
 * @package MOC\MarkIV\Api
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
 * @package MOC\MarkIV\Api
 */
class Module implements IModuleInterface {

	/**
	 * @return Encoding
	 */
	public function unitEncoding() {

		return new Encoding();
	}

}
