<?php
namespace MOC\IV\Module;

/**
 * Interface IEncoding
 *
 * @package MOC\IV\Module
 */
interface IEncoding {

	/**
	 * @param string $Text
	 *
	 * @return Encoding\Text\Api
	 */
	public function Text( $Text );
}

/**
 * Class Encoding
 *
 * @package MOC\IV\Module
 */
class Encoding implements IEncoding {

	/**
	 * @param string $Text
	 *
	 * @return Encoding\Text\Api
	 */
	public function Text( $Text ) {

		return new Encoding\Text\Api( $Text );
	}

}
