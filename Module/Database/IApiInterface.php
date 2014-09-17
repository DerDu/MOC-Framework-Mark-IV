<?php
namespace MOC\MarkIV\Module\Database;

/**
 * Interface IApiInterface
 *
 * @package MOC\MarkIV\Module\Database
 */
interface IApiInterface
{

    /**
     * @param string      $Host
     * @param string      $User
     * @param string      $Password
     * @param null|string $Database
     *
     * @return IApiInterface
     */
    public function openConnection( $Host, $User, $Password, $Database = null );

    /**
     * @return IApiInterface
     */
    public function closeConnection();
}
