<?php
namespace MOC\MarkIV\Core\Network\Proxy\Source\Type;

use MOC\MarkIV\Core\Network\Proxy\Source\Config\Server;
use MOC\MarkIV\Core\Network\Proxy\Source\Utility\Detect;

/**
 * Class Relay
 *
 * @package MOC\MarkIV\Core\Network\Proxy\Source\Type
 */
class Relay extends Generic
{

    function __construct( Server $Server )
    {

        $this->Server = $Server;
    }

    /**
     * @param string $Url
     * @param bool   $Status
     *
     * @return bool|null|string
     */
    public function getFile( $Url, $Status = false )
    {

        /**
         * Redirect: No Proxy required
         */
        if (!Detect::needProxy()) {
            $this->Server->setHost( '' );
        }

        /**
         * Fallback: Missing Proxy-Server Host
         */
        $Host = $this->Server->getHost();
        if (empty( $Host )) {
            $None = new None();
            return $None->getFile( $Url, $Status );
        }

        if ($this->openSocket()) {
            fputs( $this->Socket, "GET ".$Url." HTTP/1.0\r\nHost: ".$this->Server->getHost()."\r\n" );
            fputs( $this->Socket, "Connection: close"."\r\n" );
            fputs( $this->Socket, "\r\n" );

            if (null !== ( $Status = $this->readSocket( $Status ) )) {
                return $Status;
            }

            // Check Status e.g 302 -> Redirect
            $ContentToCheck = $this->getStatusCode( $this->Content );

            $this->closeSocket( $ContentToCheck );
        }

        return $this->Content;
    }
}
