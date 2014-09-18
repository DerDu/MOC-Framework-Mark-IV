<?php
namespace MOC\MarkIV\Extension\Database;

/**
 * Interface IApiInterface
 *
 * @package MOC\MarkIV\Extension\Database
 */
interface IApiInterface
{

    const DRIVER_MYSQL = 0;
    const DRIVER_MSSQL = 1;

    /**
     * @param int         $Driver
     * @param string      $Host
     * @param string      $User
     * @param string      $Password
     * @param null|string $Database
     *
     * @return IApiInterface
     */
    public function openConnection( $Driver = self::DRIVER_MYSQL, $Host, $User, $Password, $Database = null );

    /**
     * @param callable $Callback
     *
     * @return void
     */
    public function executeTransaction( \Closure $Callback );

    /**
     * @return IApiInterface
     */
    public function closeConnection();
}
