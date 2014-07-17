<?php
namespace MOC\IV\Module\Encoding;

interface IText {
	public function convertToLatin1( $Value );
	public function convertToUtf8( $Value );
}

class Text implements IText {

	public function convertToLatin1( $Value ) {
		$this->buildDictionary();
		foreach( (array)self::$DictionaryUtf8ToLatin1 as $Char => $Code ) {
			$Value = str_replace( $Char, $Code, $Value );
		}
		return $Value;
	}

	public function convertToUtf8( $Value ) {
		$this->buildDictionary();
		return utf8_encode( $this->convertToLatin1( $Value ) );
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
