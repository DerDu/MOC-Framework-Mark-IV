<?php
namespace MOC\MarkIV\Core\Network\Proxy\Source\Type;

use MOC\MarkIV\Core\Network\Proxy\Source\Config\Server;

/**
 * Class Relay
 *
 * @package MOC\MarkIV\Core\Network\Proxy\Source\Type
 */
class Relay extends Generic {

	function __construct( Server $Server ) {

		$this->Server = $Server;
	}

	public function getFile( $Url, $Status = false ) {

		if( $this->openSocket() ) {
			fputs( $this->Socket, "GET ".$Url." HTTP/1.0\r\nHost: ".$this->Server->getHost()."\r\n" );
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
