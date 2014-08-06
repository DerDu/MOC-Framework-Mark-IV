<?php
namespace MOC\IV\Core;

/**
 * Interface IDrive
 *
 * @package MOC\IV\Core
 */
interface IDrive {
	public function Directory( $Location );
	public function File( $Location );
}

/**
 * Class Drive
 *
 * @package MOC\IV\Core
 */
class Drive implements IDrive {

	public function Directory( $Location ) {

	}

	public function File( $Location ) {

	}

	public function optimizePathSyntax( $Path ) {
		$Path = rtrim( preg_replace( '![\\\/]+!', DIRECTORY_SEPARATOR, $Path ), '\\/' );
		while( preg_match( '!(\\\|/)[^\\\/]+?(\\\|/)\.\.!', $Path, $Match ) ) {
			$Path = preg_replace( '!(\\\|/)[^\\\/]+?(\\\|/)\.\.!', '', $Path, 1 );
		}
	}
}
