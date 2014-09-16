<?php
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

		$Document = "\n\r-------------------------------------------------------\n\r".$Document;

		$Rules = array(
			'!<script[^>]*?>.*?</script>!si',
			'!<style[^>]*?>.*?</style>!si',
			'!<[^>]*?>!si',
			'!</[^>]*?>!si',
			'!\t!si'
		);
		$Replace = array( '', '', "\n\r", "\n\r", '' );
		$Document = preg_replace( $Rules, $Replace, $Document );
		$Document = explode( "\n\r", $Document );
		$Document = array_map( 'trim', $Document );
		$Document = array_filter( $Document );
		$Document = trim( implode( "\n\r", $Document ) )."\n\r\n\r";

		return $Document;
	} );
	print $Class."\n\r";
}

function ob_print() {

	ob_end_flush();
}
