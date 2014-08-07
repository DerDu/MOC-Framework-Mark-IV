<?php
namespace MOC\IV\Core\Network\Proxy\Source\Utility;

use MOC\IV\Core\Network\Proxy\Source\Config\Credentials;
use MOC\IV\Core\Network\Proxy\Source\Config\Server;

/**
 * Class Curl
 *
 * @package MOC\IV\Core\Network\Proxy\Source\Utility
 */
class Curl {

	public static function getFileHttps( $Url, Server $Server = null, Credentials $Credentials = null, $CustomHeaderList = array() ) {

		$Curl = curl_init();
		curl_setopt( $Curl, CURLOPT_URL, $Url );
		if( null !== $Server ) {
			curl_setopt( $Curl, CURLOPT_PROXY, $Server->getHost() );
			curl_setopt( $Curl, CURLOPT_PROXYPORT, $Server->getPort() );
			if( null !== $Credentials ) {
				curl_setopt( $Curl, CURLOPT_PROXYUSERPWD, $Credentials->getUsername().':'.$Credentials->getPassword() );
			}
		}

		if( null !== $CustomHeaderList && !empty( $CustomHeaderList ) ) {
			foreach( (array)$CustomHeaderList as $Index => $Header ) {
				if( preg_match( '!^user-agent:\s*(.*?)$!is', $Header, $Match ) ) {
					curl_setopt( $Curl, CURLOPT_USERAGENT, $Match[1] );
					$CustomHeaderList[$Index] = false;
				}
			}
			$CustomHeaderList = array_filter( $CustomHeaderList );
			curl_setopt( $Curl, CURLOPT_HEADER, $CustomHeaderList );
		}

		curl_setopt( $Curl, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $Curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $Curl, CURLOPT_SSL_VERIFYHOST, false );
		curl_setopt( $Curl, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $Curl, CURLOPT_VERBOSE, false );

		$Data = curl_exec( $Curl );
		curl_close( $Curl );

		return $Data;
	}
}
