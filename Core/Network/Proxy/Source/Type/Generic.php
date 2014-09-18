<?php
namespace MOC\MarkIV\Core\Network\Proxy\Source\Type;

use MOC\MarkIV\Core\Network\Proxy\Source\Config\Credentials;
use MOC\MarkIV\Core\Network\Proxy\Source\Config\Server;
use MOC\MarkIV\Core\Network\Proxy\Source\Utility\Gzip;

/**
 * Class Generic
 *
 * @package MOC\MarkIV\Core\Network\Proxy\Source\Type
 */
abstract class Generic
{

    /** @var null|Server $Server */
    protected $Server = null;
    /** @var null|Credentials $Credentials */
    protected $Credentials = null;
    /** @var int $Timeout */
    protected $Timeout = 5;

    protected $ErrorNumber = null;
    protected $ErrorString = null;

    protected $CustomHeader = array();

    protected $Socket = null;
    protected $Content = '';

    /**
     * @param bool $asList
     *
     * @return array|string
     */
    public function getCustomHeader( $asList = false )
    {

        if (empty( $this->CustomHeader )) {
            return null;
        }

        if ($asList) {
            $Header = array();
            foreach ($this->CustomHeader as $Name => $Value) {
                array_push( $Header, $Name.': '.$Value );
            }

            return $Header;
        } else {
            $Header = "";
            foreach ($this->CustomHeader as $Name => $Value) {
                $Header .= $Name.': '.$Value."\n\r";
            }

            return $Header;
        }
    }

    /**
     * @param string $Name
     * @param string $Value
     */
    public function setCustomHeader( $Name, $Value )
    {

        $this->CustomHeader[$Name] = $Value;
    }

    protected function openSocket()
    {

        $this->Socket = fsockopen( $this->Server->getHost(), $this->Server->getPort(), $this->ErrorNumber,
            $this->ErrorString, $this->Timeout );
        if (false === $this->Socket) {
            trigger_error( '['.$this->ErrorNumber.'] '.$this->ErrorString );
            $this->Content = null;
            return false;
        }
        return true;
    }

    protected function readSocket( $Status = false )
    {

        while (!feof( $this->Socket )) {
            $this->Content .= fread( $this->Socket, 4096 );
            if ($Status) {
                $Match = array();
                preg_match( '![0-9]{3}!', $this->Content, $Match );
                if (!empty( $Match )) {
                    return $Match[0];
                } else {
                    return '444';
                }
            }
        }
        return null;
    }

    protected function closeSocket( $ContentToCheck )
    {

        fclose( $this->Socket );
        if ($this->Content == $ContentToCheck) {
            // Not Modified -> Care for Header
            $Header = substr( $this->Content, 0, strpos( $this->Content, "\r\n\r\n" ) + 4 );
            $this->Content = substr( $this->Content, strpos( $this->Content, "\r\n\r\n" ) + 4 );
            if (preg_match( '!content-encoding: gzip!is', $Header )) {
                $this->Content = Gzip::doDecode( $this->Content );
            }
        } else {
            // Already Modified -> Nothing to do
            $this->Content = $ContentToCheck;
        }
    }

    /**
     * @param string      $Content
     * @param null|string $Url
     *
     * @return null|string
     */
    protected function getStatusCode( $Content, $Url = null )
    {

        preg_match( '![0-9]{3}!', $Content, $Match );
        switch ($Match[0]) {
            case '302': {
                preg_match( '!(?<=Location: )([^\s\n]+)!', $Content, $Match );
                if (parse_url( $Match[0] )) {
                    // If Location is not correct
                    if (null !== $Url) {
                        $Match[0] = str_replace( $Url, '', $Match[0] ).'?'.parse_url( $Url, PHP_URL_QUERY );
                    }
                    $Content = $this->GetFile( $Match[0] );
                }

                return $Content;
                break;
            }
            case '301': {
                preg_match( '!(?<=Location: )([^\s\n]+)!', $Content, $Match );
                if (parse_url( $Match[0] )) {
                    $Content = $this->GetFile( $Match[0] );
                }

                return $Content;
                break;
            }
            case '200': {
                return $Content;
            }
            default: {
            trigger_error( __CLASS__.': Status-Code '.$Match[0].'<br/><hr/><div>'.$Content.'</div>' );

            return $Content;
            }
        }
    }

    /**
     * @param string $Url
     * @param bool   $Status
     *
     * @return null|string
     */
    abstract public function getFile( $Url, $Status = false );
}
