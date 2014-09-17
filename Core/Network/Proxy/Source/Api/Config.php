<?php
namespace MOC\MarkIV\Core\Network\Proxy\Source\Api;

use MOC\MarkIV\Core\Network\Proxy\Source\Config\Credentials;
use MOC\MarkIV\Core\Network\Proxy\Source\Config\Server;

/**
 * Interface IConfigInterface
 *
 * @package MOC\MarkIV\Core\Network\Proxy\Source\Api
 */
interface IConfigInterface
{

    /**
     * @param string $UserName
     * @param string $Password
     *
     * @return Credentials
     */
    public function buildCredentials( $UserName, $Password );

    /**
     * @param string     $Host
     * @param int|string $Port
     *
     * @return Server
     */
    public function buildServer( $Host, $Port );
}

/**
 * Class Config
 *
 * @package MOC\MarkIV\Core\Network\Proxy\Source\Api
 */
class Config implements IConfigInterface
{

    /**
     * @param string $UserName
     * @param string $Password
     *
     * @return Credentials
     */
    public function buildCredentials( $UserName, $Password )
    {

        return new Credentials( $UserName, $Password );
    }

    /**
     * @param string     $Host
     * @param int|string $Port
     *
     * @return Server
     */
    public function buildServer( $Host, $Port )
    {

        return new Server( $Host, $Port );
    }
}
