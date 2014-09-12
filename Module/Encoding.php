<?php
namespace MOC\MarkIV\Module;

/**
 * Interface IEncodingInterface
 *
 * @package MOC\MarkIV\Module
 */
interface IEncodingInterface {

	/**
	 * @param string $Text
	 *
	 * @return Encoding\Text\Api
	 */
	public function apiText( $Text );
}

/**
 * Class Encoding
 *
 * @package MOC\MarkIV\Module
 */
class Encoding implements IEncodingInterface {

	/**
	 * @param string $Text
	 *
	 * @return Encoding\Text\Api
	 */
	public function apiText( $Text ) {

		return new Encoding\Text\Api( $Text );
	}

}
