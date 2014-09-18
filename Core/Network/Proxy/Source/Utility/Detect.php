<?php
namespace MOC\MarkIV\Core\Network\Proxy\Source\Utility;

use MOC\MarkIV\Api;

/**
 * Class Detect
 *
 * @package MOC\MarkIV\Core\Network\Proxy\Source\Utility
 */
class Detect
{

    /**
     * Proxy Hunt
     *
     * @link http://web.tutscity.com/web-development/how-to-detect-proxies-using-php/#sthash.ZSHxhp9z.dpuf
     * @return bool
     */
    public static function needProxy()
    {

        $Proxy = false;

        $ProxyHeaders = array
        (
            'HTTP_VIA',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED',
            'HTTP_CLIENT_IP',
            'HTTP_FORWARDED_FOR_IP',
            'HTTP_X_SURFCACHE_FOR',
            'VIA',
            'X_FORWARDED_FOR',
            'FORWARDED_FOR',
            'X_FORWARDED',
            'FORWARDED',
            'CLIENT_IP',
            'FORWARDED_FOR_IP',
            'HTTP_PROXY_CONNECTION'
        );

        foreach ($ProxyHeaders as $Header) {
            if (array_key_exists( $Header, $_SERVER )) {
                $Proxy = true;
                break;
            }
        }

        if (!$Proxy) {

            $Server = Api::groupCore()->genericGlobals()->useServer();

            $ProxyPorts = array( 80, 3128, 8080, 6588, 8000, 553, 554 );

            foreach ($ProxyPorts as $Port) {
                $sock = @fsockopen( $Server->getRemoteAddress(), $Port, $errno, $errstr, 1 );

                if ($sock) {
                    $Proxy = true;
                    break;
                }
            }
        }

        return $Proxy;

    }

}
