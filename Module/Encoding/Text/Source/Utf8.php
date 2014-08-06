<?php
namespace MOC\IV\Module\Encoding\Text\Source;

use MOC\IV\Module\Encoding\Text\IMapInterface;

/**
 * Class Utf8
 *
 * @package MOC\IV\Module\Encoding\Text\Source
 */
class Utf8 implements IMapInterface {

	/** @var string $Text */
	private $Text = '';

	/**
	 * @param string $Text
	 */
	function __construct( $Text ) {

		$this->Text = $Text;
	}

	/**
	 * @return string
	 */
	public function getText() {

		$Encoding = new Latin1( $this->Text );

		return utf8_encode( $Encoding->getText() );
	}

}
