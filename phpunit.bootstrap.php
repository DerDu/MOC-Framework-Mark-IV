<?php
require_once( 'Api.php' );

function ob_console() {

	ob_start( function ( $Document ) {

		$Rules = array(
			'@<script[^>]*?>.*?</script>@si',
			'@<style[^>]*?>.*?</style>@si',
			'@<[^>]*?>@si',
			'@</[^>]*?>@si',
			'@\t@si'
		);
		$Replace = array( '', '', "\n\r", "\n\r", '' );
		$Document = preg_replace( $Rules, $Replace, $Document );
		$Document = explode( "\n\r", $Document );
		array_walk( $Document, 'trim' );
		$Document = array_filter( $Document );
		$Document = trim( implode( "\n\r", $Document ) )."\n\r\n\r";

		return $Document;
	} );
}

function ob_close() {

	ob_end_clean();
}

function ob_print() {

	ob_end_flush();
}
