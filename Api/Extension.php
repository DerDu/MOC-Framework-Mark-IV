<?php
namespace MOC\IV\Api;

use MOC\IV\Extension\Documentation;

/**
 * Interface IExtension
 *
 * @package MOC\IV\Api
 */
interface IExtensionInterface {

}

/**
 * Class Extension
 *
 * @package MOC\IV\Api
 */
class Extension implements IExtensionInterface {

	/**
	 * @return Documentation
	 */
	public function unitDocumentation() {

		return new Documentation();
	}
}
