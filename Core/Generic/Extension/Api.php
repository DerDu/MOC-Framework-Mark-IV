<?php
namespace MOC\MarkIV\Core\Generic\Extension;

use MOC\MarkIV\Core\Generic\Extension\Source\Instance;

/**
 * Interface IApiInterface
 *
 * @package MOC\MarkIV\Core\Generic\Extension
 */
interface IApiInterface {

	/**
	 * @param \stdClass   $Instance
	 * @param null|string $Identifier
	 *
	 * @return Instance
	 */
	public function buildInstance( $Instance, $Identifier = null );
}

/**
 * Class Api
 *
 * @package MOC\MarkIV\Core\Generic\Extension
 */
class Api implements IApiInterface {

	/**
	 * @param \stdClass   $Instance
	 * @param null|string $Identifier
	 *
	 * @return Instance
	 */
	public function buildInstance( $Instance, $Identifier = null ) {

		return new Instance( $Instance, $Identifier );
	}
}
