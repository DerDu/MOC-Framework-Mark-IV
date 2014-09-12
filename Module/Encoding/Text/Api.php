<?php
namespace MOC\MarkIV\Module\Encoding\Text;

/**
 * Interface IMapInterface
 *
 * @package MOC\MarkIV\Module\Encoding\Text\Source
 */
interface IMapInterface {

	/**
	 * @return string
	 */
	public function getText();
}

/**
 * Interface IApiInterface
 *
 * @package MOC\MarkIV\Module\Encoding\Text
 */
interface IApiInterface {

	/**
	 * @return string
	 */
	public function getLatin1();

	/**
	 * @return string
	 */
	public function getUtf8();
}

/**
 * Class Api
 *
 * @package MOC\MarkIV\Module\Encoding\Text
 */
class Api implements IApiInterface {

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
	public function getLatin1() {

		$Encoding = new Source\Latin1( $this->Text );

		return $Encoding->getText();
	}

	/**
	 * @return string
	 */
	public function getUtf8() {

		$Encoding = new Source\Utf8( $this->Text );

		return $Encoding->getText();
	}

}
