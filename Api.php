<?php
namespace MOC\IV;

use MOC\IV\Core\Update;

/**
 * Interface IApi
 *
 * @package MOC\IV
 */
interface IApiInterface {

	/**
	 * @return Api\Core
	 */
	public static function groupCore();

	/**
	 * @return Api\Module
	 */
	public static function groupModule();

	/**
	 * @return Api\Extension
	 */
	public static function groupExtension();

	/**
	 * @return Api\Plugin
	 */
	public static function groupPlugin();

	/**
	 * @param string $Class
	 *
	 * @return bool
	 */
	public static function loadClass( $Class );

	/**
	 * @param string $File
	 *
	 * @return bool
	 */
	public static function loadInterface( $File );

	/**
	 * @return void
	 */
	public static function runBootstrap();
}

/**
 * Class Api
 *
 * @package MOC\IV
 */
class Api implements IApiInterface {

	/**
	 * @param string $Class
	 *
	 * @return bool
	 */
	final public static function loadClass( $Class ) {

		$Class = trim( str_replace( __NAMESPACE__, '', $Class ), '\\' );
		$Class = str_replace( array( '\\', '/' ), DIRECTORY_SEPARATOR, __DIR__.DIRECTORY_SEPARATOR.$Class.'.php' );
		if( false === ( $File = realpath( $Class ) ) ) {
			/** Detect possible Interface-Definition in Class-File **/
			return self::loadInterface( $Class );
		} else {
			/** @noinspection PhpIncludeInspection */
			require( $File );

			return true;
		}
	}

	/**
	 * @param string $File
	 *
	 * @return bool
	 */
	final public static function loadInterface( $File ) {

		$Pattern = '!(.*?'.preg_quote( DIRECTORY_SEPARATOR ).')I([A-Z][^'.preg_quote( DIRECTORY_SEPARATOR ).']*?)Interface(.*?)$$!s';
		if( preg_match( $Pattern, $File, $Match ) ) {
			if( false === ( $File = realpath( $Match[1].$Match[2].$Match[3] ) ) ) {
				return false;
			} else {
				/** @noinspection PhpIncludeInspection */
				require( $File );

				return true;
			}
		}

		return false;
	}

	/**
	 *
	 */
	final public static function runBootstrap() {

		spl_autoload_register( function ( $Class ) {

			Api::loadClass( $Class );
		} );

		if( function_exists( 'xdebug_disable' ) ) {
			xdebug_disable();
		}
		error_reporting( 0 );

		self::groupCore()->unitError()->apiHandler()->registerType( self::groupCore()->unitError()->apiHandler()->apiType()->createError() );
		self::groupCore()->unitError()->apiHandler()->registerType( self::groupCore()->unitError()->apiHandler()->apiType()->createException() );
		self::groupCore()->unitError()->apiHandler()->registerType( self::groupCore()->unitError()->apiHandler()->apiType()->createShutdown() );
	}

	/**
	 * @return Update
	 */
	final public static function runUpdate() {

		return new Update();

	}

	/**
	 * @return Api\Core
	 */
	final public static function groupCore() {

		return new Api\Core();
	}

	/**
	 * @return Api\Module
	 */
	final public static function groupModule() {

		return new Api\Module();
	}

	/**
	 * @return Api\Extension
	 */
	final public static function groupExtension() {

		return new Api\Extension();
	}

	/**
	 * @return Api\Plugin
	 */
	final public static function groupPlugin() {

		return new Api\Plugin();
	}
}

/**
 * Bootstrap
 */
Api::runBootstrap();
