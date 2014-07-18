<?php
namespace MOC\IV;

interface IApi {
	public static function useCore();
	public static function useModule();
	public static function useExtension();
	public static function usePlugin();

	public static function loadClass( $Class );
	public static function registerAutoClassLoader();
}

class Api implements IApi {

	final public static function loadClass( $Class ) {
		$Class = trim( str_replace( __NAMESPACE__, '', $Class ), '\\' );
		$Class = str_replace( array('\\','/'), DIRECTORY_SEPARATOR, __DIR__.DIRECTORY_SEPARATOR.$Class.'.php' );
		if( false === ( $Class = realpath( $Class ) ) ) {
			return false;
		} else {
			/** @noinspection PhpIncludeInspection */
			require( $Class );
			return true;
		}
	}

	final public static function registerAutoClassLoader() {
		spl_autoload_register( function($Class){ Api::loadClass($Class); } );

		if( function_exists( 'xdebug_disable' ) ) { xdebug_disable(); }
		error_reporting(0);

		self::useCore()->useError()->registerType( self::useCore()->useError()->getType()->useError() );
		self::useCore()->useError()->registerType( self::useCore()->useError()->getType()->useException() );
		self::useCore()->useError()->registerType( self::useCore()->useError()->getType()->useShutdown() );
	}

	final public static function useCore(){
		return new Api\Core();
	}

	final public static function useModule(){
		return new Api\Module();
	}

	final public static function useExtension(){
		return new Api\Extension();
	}

	final public static function usePlugin(){
		return new Api\Plugin();
	}
}

Api::registerAutoClassLoader();
