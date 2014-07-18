<?php
namespace MOC\IV\Core;

interface IDrive {
	public function useDirectory( $Location );
	public function useFile( $Location );
}

class Drive implements IDrive {

	public function useDirectory( $Location ) {
		return new Drive\Directory( $Location );
	}

	public function useFile( $Location ) {
		return new Drive\File( $Location );
	}

	public function optimizePathSyntax( $Path ) {
		$Path = rtrim( preg_replace( '![\\\/]+!', DIRECTORY_SEPARATOR, $Path ), '\\/' );
		while( preg_match( '!(\\\|/)[^\\\/]+?(\\\|/)\.\.!', $Path, $Match ) ) {
			$Path = preg_replace( '!(\\\|/)[^\\\/]+?(\\\|/)\.\.!', '', $Path, 1 );
		}
	}
}
