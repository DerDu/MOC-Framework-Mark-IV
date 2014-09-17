<?php
namespace MOC\MarkIV;

use MOC\MarkIV\Core\Update;

/**
 * Interface IApiInterface
 *
 * @package MOC\MarkIV
 */
interface IApiInterface
{

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
     * @param string $Class
     *
     * @return bool
     */
    public static function loadInterface( $File, $Class );

    /**
     * @param string $Class
     *
     * @return bool
     */
    public static function loadNamespace( $Class );

    /**
     * @param string                             $Namespace
     * @param Core\Drive\Directory\IApiInterface $Location
     */
    public static function registerNamespace( $Namespace, Core\Drive\Directory\IApiInterface $Location );

    /**
     * @return void
     */
    public static function runBootstrap();

    /**
     * @return Update
     */
    public static function runUpdate();
}

/**
 * Class Api
 *
 * @package MOC\MarkIV
 */
class Api implements IApiInterface
{

    /** @var array $NamespaceLocationList */
    private static $NamespaceLocationList = array();

    /**
     * Bootstrap
     */
    public static function runBootstrap()
    {

        spl_autoload_register( function ( $Class ) {

            Api::loadClass( $Class );
        } );

        if (function_exists( 'xdebug_disable' )) {
            xdebug_disable();
        }
        error_reporting( 0 );

        self::groupCore()->unitError()->apiHandler()->registerType( self::groupCore()->unitError()->apiHandler()->apiType()->buildError() );
        self::groupCore()->unitError()->apiHandler()->registerType( self::groupCore()->unitError()->apiHandler()->apiType()->buildException() );
        self::groupCore()->unitError()->apiHandler()->registerType( self::groupCore()->unitError()->apiHandler()->apiType()->buildShutdown() );
    }

    /**
     * @param string $Class
     *
     * @return bool
     */
    public static function loadClass( $Class )
    {

        $Class = trim( str_replace( __NAMESPACE__, '', $Class ), '\\' );
        $Location = str_replace( array( '\\', '/' ), DIRECTORY_SEPARATOR, __DIR__.DIRECTORY_SEPARATOR.$Class.'.php' );
        if (false === ( $File = realpath( $Location ) )) {
            /** Detect possible Interface-Definition in Class-File **/
            return self::loadInterface( $Location, $Class );
        } else {
            /** @noinspection PhpIncludeInspection */
            require( $File );

            return true;
        }
    }

    /**
     * @param string $File
     * @param string $Class
     *
     * @return bool
     */
    public static function loadInterface( $File, $Class )
    {

        $Pattern = '!(.*?'.preg_quote( DIRECTORY_SEPARATOR ).')I([A-Z][^'.preg_quote( DIRECTORY_SEPARATOR ).']*?)Interface(.*?)$$!s';
        if (preg_match( $Pattern, $File, $Match )) {
            if (false === ( $File = realpath( $Match[1].$Match[2].$Match[3] ) )) {
                return false;
            } else {
                /** @noinspection PhpIncludeInspection */
                require( $File );

                return true;
            }
        } else {
            return self::loadNamespace( $Class );
        }
    }

    /**
     * @param string $Class
     *
     * @return bool
     */
    public static function loadNamespace( $Class )
    {

        /** @var Core\Drive\Directory\Api $Location */
        foreach ((array)self::$NamespaceLocationList as $Namespace => $Location) {
            if (strpos( $Class, $Namespace ) !== 0) {
                continue;
            }
            $Class = str_replace( array( '\\', '/' ), DIRECTORY_SEPARATOR,
                $Location->getLocation().DIRECTORY_SEPARATOR.$Class.'.php' );
            if (false === ( $File = realpath( $Class ) )) {
                /** Detect possible Additional Class-Files **/
            } else {
                /** @noinspection PhpIncludeInspection */
                require( $File );

                return true;
            }
        }

        return false;
    }

    /**
     * @return Api\Core
     */
    public static function groupCore()
    {

        return new Api\Core();
    }

    /**
     * @param string                             $Namespace
     * @param Core\Drive\Directory\IApiInterface $Location
     */
    public static function registerNamespace( $Namespace, Core\Drive\Directory\IApiInterface $Location )
    {

        if ($Location->checkExists() && !$Location->checkIsEmpty()) {
            self::$NamespaceLocationList[$Namespace] = $Location;
        }
    }

    /**
     * @return Update
     */
    public static function runUpdate()
    {

        return new Update();

    }

    /**
     * @return Api\Module
     */
    public static function groupModule()
    {

        return new Api\Module();
    }

    /**
     * @return Api\Extension
     */
    public static function groupExtension()
    {

        return new Api\Extension();
    }

    /**
     * @return Api\Plugin
     */
    public static function groupPlugin()
    {

        return new Api\Plugin();
    }
}
