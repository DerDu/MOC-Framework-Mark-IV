<?php
namespace MOC\IV\Module\Encoding\Text;

/**
 * Interface IMap
 *
 * @package MOC\IV\Module\Encoding\Text\Source
 */
interface IMapInterface {

	/**
	 * @return string
	 */
	public function getText();
}

/**
 * Interface IApi
 *
 * @package MOC\IV\Module\Encoding\Text
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
 * @package MOC\IV\Module\Encoding\Text
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
