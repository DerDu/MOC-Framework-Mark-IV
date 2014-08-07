<?php
namespace MOC\IV\Core\Network\Proxy\Source\Type;

use MOC\IV\Core\Network\Proxy\Source\Config\Credentials;
use MOC\IV\Core\Network\Proxy\Source\Config\Server;
use MOC\IV\Core\Network\Proxy\Source\Utility\Curl;

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

		if( $this->openSocket() ) {
			fputs( $this->Socket, "GET ".$Url." HTTP/1.0\r\nHost: ".$this->Server->getHost()."\r\n" );
			fputs( $this->Socket, "Proxy-Authorization: Basic ".base64_encode( $this->Credentials->getUsername().':'.$this->Credentials->getPassword() )."\r\n" );
			fputs( $this->Socket, "Connection: close"."\r\n" );
			fputs( $this->Socket, "\r\n" );

			if( null !== ( $Status = $this->readSocket( $Status ) ) ) {
				return $Status;
			}

			// Check Status e.g 302 -> Redirect
			$ContentToCheck = $this->getStatusCode( $this->Content );

			$this->closeSocket( $ContentToCheck );
		}

		return $this->Content;
	}
}
