<?php
namespace MOC\IV\Module\Encoding\Text\Source;

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
 * Interface IDictionary
 *
 * @package MOC\IV\Module\Encoding\Text\Source
 */
interface IDictionaryInterface {

	/**
	 * @return array
	 */
	public function getMapUtf8ToLatin1();

	/**
	 * @return array
	 */
	public function getMapLatin1ToUtf8();
}

/**
 * Class Dictionary
 *
 * @package MOC\IV\Module\Encoding\Text\Source
 */
class Dictionary implements IDictionaryInterface {

	/** @var null|array $DictionaryLatin1ToUtf8 */
	private static $DictionaryLatin1ToUtf8 = null;
	/** @var null|array $DictionaryUtf8ToLatin1 */
	private static $DictionaryUtf8ToLatin1 = null;

	function __construct() {

		if( self::$DictionaryUtf8ToLatin1 === null || self::$DictionaryLatin1ToUtf8 === null ) {
			for( $Run = 32; $Run <= 255; $Run++ ) {
				self::$DictionaryLatin1ToUtf8[chr( $Run )] = utf8_encode( chr( $Run ) );
				self::$DictionaryUtf8ToLatin1[utf8_encode( chr( $Run ) )] = chr( $Run );
			}
		}
	}

	/**
	 * @return array
	 */
	public function getMapLatin1ToUtf8() {

		return self::$DictionaryLatin1ToUtf8;
	}

	/**
	 * @return array
	 */
	public function getMapUtf8ToLatin1() {

		return self::$DictionaryUtf8ToLatin1;
	}
}
