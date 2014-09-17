<?php
namespace MOC\MarkIV\Core\Network\Proxy\Source\Api;

use MOC\MarkIV\Core\Network\Proxy\Source\Config\Credentials;
use MOC\MarkIV\Core\Network\Proxy\Source\Config\Server;
use MOC\MarkIV\Core\Network\Proxy\Source\Type\Basic;
use MOC\MarkIV\Core\Network\Proxy\Source\Type\None;
use MOC\MarkIV\Core\Network\Proxy\Source\Type\Relay;

/**
 * Interface ITypeInterface
 *
 * @package MOC\MarkIV\Core\Network\Proxy\Source\Api
 */
interface ITypeInterface
{

    /**
     * @return None
     */
    public function buildNone();

    /**
     * @param Server $Server
     *
     * @return Relay
     */
    public function buildRelay( Server $Server );

    /**
     * @param Server      $Server
     * @param Credentials $Credentials
     *
     * @return Basic
     */
    public function buildBasic( Server $Server, Credentials $Credentials );
}

/**
 * Class Type
 *
 * @package MOC\MarkIV\Core\Network\Proxy\Source\Api
 */
class Type implements ITypeInterface
{

    /**
     * @return None
     */
    public function buildNone()
    {

        return new None();
    }

    /**
     * @param Server $Server
     *
     * @return Relay
     */
    public function buildRelay( Server $Server )
    {

        return new Relay( $Server );
    }

    /**
     * @param Server      $Server
     * @param Credentials $Credentials
     *
     * @return Basic
     */
    public function buildBasic( Server $Server, Credentials $Credentials )
    {

        return new Basic( $Server, $Credentials );
    }
}
