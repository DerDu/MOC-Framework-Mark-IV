<?php
/**
 * Fix: (Empty) Document-Root = Test-Environment / Project-Root
 */
$_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__));
/**
 * Load Framework
 */
require_once( __DIR__.'/Api.php' );
/**
 * Bootstrap Framework
 */
MOC\MarkIV\Api::runBootstrap();
/**
 * Buffer Handler
 *
 * @param $Class
 */
function ob_console( $Class ) {

	ob_start( function ( $Document ) {

		$Document = str_repeat( '=', 10 ).'> '.$Document;

		$Rules = array(
			'!<script[^>]*?>.*?</script>!si',
			'!<style[^>]*?>.*?</style>!si',
			'!<[^>]*?>!si',
			'!</[^>]*?>!si',
			'!\t!si',
			'!\s+$!si'
		);
		$Replace = array( '', '', "\n\r", "\n\r", "\t", '' );
		$Document = preg_replace( $Rules, $Replace, $Document );
		$Document = explode( "\n\r", $Document );
		$Document = array_map( 'trim', $Document );
		foreach( (array)$Document as $Index => $Value ) {
			if( empty( $Value ) ) {
				unset( $Document[$Index] );
			}
		}
		$Document = trim( implode( "\n\r", $Document ) );

		return trim( $Document );
	} );
	print $Class;
}

function ob_print() {

	ob_end_flush();
}
