<?php
namespace MOC\IV\Core;

/**
 * Interface IDrive
 *
 * @package MOC\IV\Core
 */
interface IDriveInterface {
	public function apiDirectory( $Location );
	public function apiFile( $Location );
}

/**
 * Class Drive
 *
 * @package MOC\IV\Core
 */
class Drive implements IDriveInterface {

	public function apiDirectory( $Location ) {

	}

	public function apiFile( $Location ) {

	}

	public function optimizePathSyntax( $Path ) {
		$Path = rtrim( preg_replace( '![\\\/]+!', DIRECTORY_SEPARATOR, $Path ), '\\/' );
		while( preg_match( '!(\\\|/)[^\\\/]+?(\\\|/)\.\.!', $Path, $Match ) ) {
			$Path = preg_replace( '!(\\\|/)[^\\\/]+?(\\\|/)\.\.!', '', $Path, 1 );
		}
	}
}
