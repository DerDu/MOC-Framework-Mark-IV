<?php
namespace MOC\IV;

interface IApi {
	public static function getCore();
	public static function getModule();
	public static function getExtension();
	public static function getPlugin();
}

class Api implements IApi {

	private static function loadClass( $Class ) {
		// Cut Root-Namespace
		$Class = preg_replace( '!^'.__NAMESPACE__.'!', '', $Class );
		// Correct & Trim DIRECTORY_SEPARATOR
		$Class = preg_replace( '![\\\/]+!', DIRECTORY_SEPARATOR, __DIR__.DIRECTORY_SEPARATOR.$Class.'.php' );
		if( false === ( $Class = realpath( $Class ) ) ) {
			// File not found
			return false;
		} else {
			/** @noinspection PhpIncludeInspection */
			require_once( $Class );
			return true;
		}
	}

	private static function registerLoader() {
		spl_autoload_register( array(__CLASS__,'loadClass') );
	}

	public static function getCore(){
		self::registerLoader();
		return new Api\Core();
	}

	public static function getModule(){
		self::registerLoader();
		return new Api\Module();
	}

	public static function getExtension(){
		self::registerLoader();
		return new Api\Extension();
	}

	public static function getPlugin(){
		self::registerLoader();
		return new Api\Plugin();
	}
}
