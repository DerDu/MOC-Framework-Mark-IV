<?php
namespace MOC\IV\Core\Drive\Directory\Utility;

use MOC\IV\Api;

/**
 * Class Check
 *
 * @package MOC\IV\Core\Drive\Directory\Utility
 */
class Check {

	/**
	 * @return \MOC\IV\Core\Drive\Directory\Api
	 */
	public static function getCurrentDirectory() {

		return Api::groupCore()->unitDrive()->apiDirectory( self::getRootDirectory()->getLocation().dirname( $_SERVER['SCRIPT_NAME'] ) );
	}

	/**
	 * @return \MOC\IV\Core\Drive\Directory\Api
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
	private function correctDocumentRoot() {

		if( !isset( $_SERVER['DOCUMENT_ROOT'] ) ) {
			if( isset( $_SERVER['SCRIPT_FILENAME'] ) ) {
				$_SERVER['DOCUMENT_ROOT'] = $this->convertCleanPathSyntax( substr( $_SERVER['SCRIPT_FILENAME'], 0, 0 - strlen( $_SERVER['PHP_SELF'] ) ) );
			};
		};
		if( !isset( $_SERVER['DOCUMENT_ROOT'] ) ) {
			if( isset( $_SERVER['PATH_TRANSLATED'] ) ) {
				$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr( $this->convertCleanPathSyntax( $_SERVER['PATH_TRANSLATED'] ), 0, 0 - strlen( $_SERVER['PHP_SELF'] ) ) );
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
