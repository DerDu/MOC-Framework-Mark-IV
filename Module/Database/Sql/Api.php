<?php
namespace MOC\MarkIV\Module\Database\Sql;

use MOC\MarkIV\Module\Database\IApiInterface;

/**
 * Class Api
 *
 * @package MOC\MarkIV\Module\Database\Sql
 */
class Api implements IApiInterface
{

    function __construct()
    {
    }

    /**
     * @param int         $Driver
     * @param string      $Host
     * @param string      $User
     * @param string      $Password
     * @param null|string $Database
     *
     * @return IApiInterface
     */
    public function openConnection( $Driver = self::DRIVER_MYSQL, $Host, $User, $Password, $Database = null )
    {

        $Extension = \MOC\MarkIV\Api::groupExtension()->unitDatabase()->useDoctrine2();
        $Extension->openConnection( $Driver, $Host, $User, $Password, $Database );

        return $this;
    }

    /**
     * @param callable $Callback
     *
     * @return IApiInterface
     * @throws \Exception
     */
    public function executeTransaction( \Closure $Callback )
    {

        $Extension = \MOC\MarkIV\Api::groupExtension()->unitDatabase()->useDoctrine2();
        $Extension->executeTransaction( $Callback );

        return $this;
    }

    /**
     * @return IApiInterface
     */
    public function closeConnection()
    {

        $Extension = \MOC\MarkIV\Api::groupExtension()->unitDatabase()->useDoctrine2();
        $Extension->closeConnection();

        return $this;
    }

}
