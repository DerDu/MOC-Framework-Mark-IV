<?php
namespace MOC\IV\Core\Network\Proxy\Source\Type;

use MOC\IV\Core\Network\Proxy\Source\Config\Credentials;
use MOC\IV\Core\Network\Proxy\Source\Config\Server;
use MOC\IV\Core\Network\Proxy\Source\Utility\Curl;
use MOC\IV\Core\Network\Proxy\Source\Utility\Gzip;

/**
 * Class Basic
 *
 * @package MOC\IV\Core\Network\Proxy\Source\Type
 */
class Basic extends Generic {

	function __construct( Server $Server, Credentials $Credentials ) {

		$this->Server = $Server;
		$this->Credentials = $Credentials;
	}

	public function getFile( $Url, $Status = false ) {

		if( strtoupper( parse_url( $Url, PHP_URL_SCHEME ) ) == 'HTTPS' ) {
			return Curl::getFileHttps( $Url, $this->Server, $this->Credentials, $this->getCustomHeader( true ) );
		}

		if( ( $Socket = fsockopen( $this->Server->getHost(), $this->Server->getPort(), $this->ErrorNumber, $this->ErrorString, $this->Timeout ) ) ) {
			$Content = '';
			fputs( $Socket, "GET ".$Url." HTTP/1.0\r\nHost: ".$this->Server->getHost()."\r\n" );
			fputs( $Socket, "Proxy-Authorization: Basic ".base64_encode( $this->Credentials->getUsername().':'.$this->Credentials->getPassword() )."\r\n" );
			fputs( $Socket, "Connection: close"."\r\n" );
			fputs( $Socket, "\r\n" );
			while( !feof( $Socket ) ) {
				$Content .= fread( $Socket, 4096 );
				if( $Status ) {
					$Match = array();
					preg_match( '![0-9]{3}!', $Content, $Match );

					return $Match[0];
				}
			}
			// Check Status e.g 302 -> Redirect
			$ContentToCheck = $this->getStatusCode( $Content );
			fclose( $Socket );
			if( $Content == $ContentToCheck ) {
				// Not Modified -> Care for Header
				$Header = substr( $Content, 0, strpos( $Content, "\r\n\r\n" ) + 4 );
				$Content = substr( $Content, strpos( $Content, "\r\n\r\n" ) + 4 );
				if( preg_match( '!content-encoding: gzip!is', $Header ) ) {
					$Content = Gzip::doDecode( $Content );
				}
			} else {
				// Already Modified -> Nothing to do
				$Content = $ContentToCheck;
			}
		} else {
			trigger_error( '['.$this->ErrorNumber.'] '.$this->ErrorString );
			$Content = null;
		}

		return $Content;
	}
}
