<?php
namespace MOC\MarkIV\Core\Drive\Directory\Utility;

use MOC\MarkIV\Api;

/**
 * Interface ICheckInterface
 *
 * @package MOC\MarkIV\Core\Drive\Directory\Utility
 */
interface ICheckInterface {

	/**
	 * @return \MOC\MarkIV\Core\Drive\Directory\Api
	 */
	public static function getCurrentDirectory();

	/**
	 * @return \MOC\MarkIV\Core\Drive\Directory\Api
	 */
	public static function getRootDirectory();

	/**
	 * @param string $Path
	 *
	 * @return string
	 */
	public static function convertCleanPathSyntax( $Path );
}

/**
 * Class Check
 *
 * @package MOC\MarkIV\Core\Drive\Directory\Utility
 */
class Check implements ICheckInterface {

	/**
	 * @return \MOC\MarkIV\Core\Drive\Directory\Api
	 */
	public static function getCurrentDirectory() {

		return Api::groupCore()->unitDrive()->apiDirectory( self::getRootDirectory()->getLocation().dirname( $_SERVER['SCRIPT_NAME'] ) );
	}

	/**
	 * @return \MOC\MarkIV\Core\Drive\Directory\Api
	 */
	public static function getRootDirectory() {

		self::correctDocumentRoot();

		return Api::groupCore()->unitDrive()->apiDirectory( $_SERVER['DOCUMENT_ROOT'] );
	}

	/**
	 * Problem to fix: The $_SERVER["DOCUMENT_ROOT"] is empty in IIS.
	 *
	 * Based on: http://fyneworks.blogspot.com/2007/08/php-documentroot-in-iis-windows-servers.html
	 * Added by Diego, 13-AUG-2007.
	 *
	 * @static
	 * @return void
	 */
	private static function correctDocumentRoot() {

		if( !isset( $_SERVER['DOCUMENT_ROOT'] ) || empty( $_SERVER['DOCUMENT_ROOT'] ) ) {
			if( isset( $_SERVER['SCRIPT_FILENAME'] ) ) {
				$_SERVER['DOCUMENT_ROOT'] = self::convertCleanPathSyntax( substr( $_SERVER['SCRIPT_FILENAME'], 0, 0 - strlen( $_SERVER['PHP_SELF'] ) ) );
			};
		};
		if( !isset( $_SERVER['DOCUMENT_ROOT'] ) || empty( $_SERVER['DOCUMENT_ROOT'] ) ) {
			if( isset( $_SERVER['PATH_TRANSLATED'] ) ) {
				$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr( self::convertCleanPathSyntax( $_SERVER['PATH_TRANSLATED'] ), 0, 0 - strlen( $_SERVER['PHP_SELF'] ) ) );
			};
		};
		/**
		 * $_SERVER['DOCUMENT_ROOT'] is now set - you can use it as usual...
		 */
	}

	/**
	 * @param string $Path
	 *
	 * @return string
	 */
	public static function convertCleanPathSyntax( $Path ) {

		$Path = rtrim( preg_replace( '![\\\/]+!', DIRECTORY_SEPARATOR, $Path ), '\\/' );
		while( preg_match( '!(\\\|/)[^\\\/]+?(\\\|/)\.\.!', $Path, $Match ) ) {
			$Path = preg_replace( '!(\\\|/)[^\\\/]+?(\\\|/)\.\.!', '', $Path, 1 );
		}

		return $Path;
	}
}
