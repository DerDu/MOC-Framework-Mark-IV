<?php
namespace MOC\IV;

interface IApi {
	public static function useCore();
	public static function useModule();
	public static function useExtension();
	public static function usePlugin();
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

		self::useCore()->useError()->doRegister( self::useCore()->useError()->getType()->useError() );
		self::useCore()->useError()->doRegister( self::useCore()->useError()->getType()->useException() );
		self::useCore()->useError()->doRegister( self::useCore()->useError()->getType()->useShutdown() );
	}

	public static function useCore(){
		self::registerLoader();
		return new Api\Core();
	}

	public static function useModule(){
		self::registerLoader();
		return new Api\Module();
	}

	public static function useExtension(){
		self::registerLoader();
		return new Api\Extension();
	}

	public static function usePlugin(){
		self::registerLoader();
		return new Api\Plugin();
	}
}
