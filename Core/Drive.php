<?php
namespace MOC\MarkIV\Core;

use MOC\MarkIV\Core\Drive\Directory\Utility\Check;

/**
 * Interface IDriveInterface
 *
 * @package MOC\MarkIV\Core
 */
interface IDriveInterface
{

    /**
     * @param string $Location
     *
     * @return Drive\Directory\Api
     */
    public function apiDirectory( $Location );

    /**
     * @param string $Location
     *
     * @return Drive\File\Api
     */
    public function apiFile( $Location );

    /**
     * @return Drive\Directory\Api
     */
    public function getRootDirectory();

    /**
     * @return Drive\Directory\Api
     */
    public function getCurrentDirectory();

    /**
     * @return Drive\Directory\Api
     */
    public function getDataDirectory();
}

/**
 * Class Drive
 *
 * @package MOC\MarkIV\Core
 */
class Drive implements IDriveInterface
{

    /**
     * @param string $Location
     *
     * @return Drive\File\Api
     */
    public function apiFile( $Location )
    {

        return new Drive\File\Api( $Location );
    }

    /**
     * @return Drive\Directory\Api
     */
    public function getRootDirectory()
    {

        return Check::getRootDirectory();
    }

    /**
     * @return Drive\Directory\Api
     */
    public function getCurrentDirectory()
    {

        return Check::getCurrentDirectory();
    }

    /**
     * @return Drive\Directory\Api
     */
    public function getDataDirectory()
    {

        return $this->apiDirectory( __DIR__.'/../Data' );
    }

    /**
     * @param string $Location
     *
     * @return Drive\Directory\Api
     */
    public function apiDirectory( $Location )
    {

        return new Drive\Directory\Api( $Location );
    }
}
