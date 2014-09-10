<?php
namespace MOC\MarkIV\Api;

use MOC\MarkIV\Extension\Documentation;

/**
 * Interface IExtension
 *
 * @package MOC\MarkIV\Api
 */
interface IExtensionInterface {

	/**
	 * @return Documentation
	 */
	public function unitDocumentation();
}

/**
 * Class Extension
 *
 * @package MOC\MarkIV\Api
 */
class Extension implements IExtensionInterface {

	/**
	 * @return Documentation
	 */
	public function unitDocumentation() {

		return new Documentation();
	}
}
