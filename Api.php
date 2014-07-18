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
		$Class = trim( str_replace( __NAMESPACE__, '', $Class ), '\\' );
		$Class = str_replace( array('\\','/'), DIRECTORY_SEPARATOR, __DIR__.DIRECTORY_SEPARATOR.$Class.'.php' );
		if( false === ( $Class = realpath( $Class ) ) ) {
			return false;
		} else {
			/** @noinspection PhpIncludeInspection */
			require_once( $Class );
			return true;
		}
	}

	public static function registerLoader() {
		spl_autoload_register( array(__CLASS__,'loadClass') );

		if( function_exists( 'xdebug_disable' ) ) { xdebug_disable(); }
		error_reporting(0);

		self::useCore()->useError()->registerType( self::useCore()->useError()->getType()->useError() );
		self::useCore()->useError()->registerType( self::useCore()->useError()->getType()->useException() );
		self::useCore()->useError()->registerType( self::useCore()->useError()->getType()->useShutdown() );
	}

	public static function useCore(){
		return new Api\Core();
	}

	public static function useModule(){
		return new Api\Module();
	}

	public static function useExtension(){
		return new Api\Extension();
	}

	public static function usePlugin(){
		return new Api\Plugin();
	}
}

Api::registerLoader();
