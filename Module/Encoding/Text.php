<?php
namespace MOC\IV\Module\Encoding;

interface IText {
	public function getTextConvertedToLatin1();
	public function getTextConvertedToUtf8();
}

class Text implements IText {

	private $Text = '';

	function __construct( $Text ) {
		$this->Text = $Text;
	}

	public function getTextConvertedToLatin1() {
		$this->buildDictionary();
		foreach( (array)self::$DictionaryUtf8ToLatin1 as $Char => $Value ) {
			$this->Text = str_replace( $Char, $Value, $this->Text );
		}
		return $this->Text;
	}

	public function getTextConvertedToUtf8() {
		$this->buildDictionary();
		return utf8_encode( $this->getTextConvertedToLatin1() );
	}

	private static $DictionaryLatin1ToUtf8 = null;
	private static $DictionaryUtf8ToLatin1 = null;

	private function buildDictionary() {
		if( self::$DictionaryUtf8ToLatin1 === null || self::$DictionaryLatin1ToUtf8 === null ) {
			for ($Run = 32; $Run <= 255; $Run++) {
				self::$DictionaryLatin1ToUtf8[chr($Run)] = utf8_encode(chr($Run));
				self::$DictionaryUtf8ToLatin1[utf8_encode(chr($Run))] = chr($Run);
			}
		}
	}

}
