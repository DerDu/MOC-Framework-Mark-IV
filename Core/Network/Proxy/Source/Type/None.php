<?php
namespace MOC\MarkIV\Core\Network\Proxy\Source\Type;

use MOC\MarkIV\Api;
use MOC\MarkIV\Core\Network\Proxy\Source\Config\Server;
use MOC\MarkIV\Core\Network\Proxy\Source\Utility\Curl;
use MOC\MarkIV\Core\Network\Proxy\Source\Utility\Detect;

/**
 * Class None
 *
 * @package MOC\MarkIV\Core\Network\Proxy\Source\Type
 */
class None extends Generic
{

    function __construct()
    {

        $this->Server = new Server( '', '' );
    }

    public function getFile( $Url, $Status = false )
    {

        if (Detect::needProxy()) {
            Api::groupCore()->unitError()->apiHandler()->apiType()->buildError()->setData( 'Network Error',
                '305 Use Proxy', 2,
                __FILE__, __LINE__ );
            return '';
        }

        $this->Server->setHost( parse_url( $Url, PHP_URL_HOST ) );

        if (parse_url( $Url, PHP_URL_PORT ) === null) {
            switch (strtoupper( parse_url( $Url, PHP_URL_SCHEME ) )) {
                case 'HTTP': {
                    $this->Server->setPort( '80' );
                    break;
                }
                case 'HTTPS': {
                    $this->Server->setPort( '443' );
                    break;
                }
            }
        } else {
            $this->Server->setPort( parse_url( $Url, PHP_URL_PORT ) );
        }

        if ($this->Server->getPort() == '443') {
            if (in_array( 'https', stream_get_wrappers() )) {
                return file_get_contents( $Url );
            } else {
                return Curl::getFileHttps( $Url, null, null, $this->getCustomHeader( true ) );
            }
        }

        if ($this->openSocket()) {
            fputs( $this->Socket, "GET ".$Url." HTTP/1.0\r\nHost: ".parse_url( $Url, PHP_URL_HOST )."\r\n" );
            fputs( $this->Socket, "Connection: close"."\r\n" );
            fputs( $this->Socket, "\r\n" );

            if (null !== ( $Status = $this->readSocket( $Status ) )) {
                return $Status;
            }

            // Check Status e.g 302 -> Redirect
            $ContentToCheck = $this->getStatusCode( $this->Content, $Url );

            $this->closeSocket( $ContentToCheck );
        }

        return $this->Content;
    }
}
