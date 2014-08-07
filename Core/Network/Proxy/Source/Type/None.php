<?php
namespace MOC\IV\Core\Network\Proxy\Source\Type;

use MOC\IV\Core\Network\Proxy\Source\Config\Server;
use MOC\IV\Core\Network\Proxy\Source\Utility\Gzip;

/**
 * Class None
 *
 * @package MOC\IV\Core\Network\Proxy\Source\Type
 */
class None extends Generic {

	function __construct() {

		$this->Server = new Server( '', '' );
	}

	public function getFile( $Url, $Status = false ) {

		$this->Server->setHost( parse_url( $Url, PHP_URL_HOST ) );

		if( parse_url( $Url, PHP_URL_PORT ) === null ) {
			switch( strtoupper( parse_url( $Url, PHP_URL_SCHEME ) ) ) {
				case 'HTTP':
				{
					$this->Server->setPort( '80' );
					break;
				}
				case 'HTTPS':
				{
					$this->Server->setPort( '443' );
					break;
				}
			}
		} else {
			$this->Server->setPort( parse_url( $Url, PHP_URL_PORT ) );
		}

		if( $this->Server->getPort() == '443' ) {
			return file_get_contents( $Url );
		}

		if( ( $Socket = fsockopen( $this->Server->getHost(), $this->Server->getPort(), $this->ErrorNumber, $this->ErrorString, $this->Timeout ) ) ) {
			$Content = '';
			fputs( $Socket, "GET ".$Url." HTTP/1.0\r\nHost: ".parse_url( $Url, PHP_URL_HOST )."\r\n" );
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
			$ContentToCheck = $this->getStatusCode( $Content, $Url );
			fclose( $Socket );
			if( $Content == $ContentToCheck ) {
				// Not Modified -> Care for Header
				$Header = substr( $Content, 0, strpos( $Content, "\r\n\r\n" ) + 4 );
				$Content = substr( $Content, strpos( $Content, "\r\n\r\n" ) + 4 );
				if( preg_match( '!content-encoding: gzip!is', $Header ) ) {
					$Content = Gzip::Decode( $Content );
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
