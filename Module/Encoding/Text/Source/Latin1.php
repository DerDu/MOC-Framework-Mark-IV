<?php
namespace MOC\IV\Module\Encoding\Text\Source;

/**
 * Class Latin1
 *
 * @package MOC\IV\Module\Encoding\Text\Source
 */
class Latin1 implements IMapInterface {

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

		$Dictionary = new Dictionary();
		foreach( (array)$Dictionary->getMapUtf8ToLatin1() as $Char => $Value ) {
			$this->Text = str_replace( $Char, $Value, $this->Text );
		}

		return $this->Text;
	}

}
