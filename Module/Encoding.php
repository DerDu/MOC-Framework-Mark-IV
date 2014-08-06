<?php
namespace MOC\IV\Module;

/**
 * Interface IEncoding
 *
 * @package MOC\IV\Module
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
 * @package MOC\IV\Module
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
