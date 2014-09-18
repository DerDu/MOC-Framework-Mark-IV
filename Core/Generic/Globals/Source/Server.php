<?php
namespace MOC\MarkIV\Core\Generic\Globals\Source;

/**
 * Interface IServerInterface
 *
 * @package MOC\MarkIV\Core\Generic\Globals\Source
 */
interface IServerInterface
{

    public static function doRefresh();

    /**
     * @param null|int $Default
     *
     * @return null|int
     */
    public function getServerPort( $Default = null );

    /**
     * @param int $Value
     *
     * @return IServerInterface
     */
    public function setServerPort( $Value );

    /**
     * @param null|string $Default
     *
     * @return null|string
     */
    public function getServerName( $Default = null );

    /**
     * @param string $Value
     *
     * @return IServerInterface
     */
    public function setServerName( $Value );

    /**
     * @param null|string $Default
     *
     * @return null|string
     */
    public function getDocumentRoot( $Default = null );

    /**
     * @param string $Value
     *
     * @return IServerInterface
     */
    public function setDocumentRoot( $Value );

    /**
     * @param null|string $Default
     *
     * @return null|string
     */
    public function getRemoteAddress( $Default = null );

    /**
     * @param string $Value
     *
     * @return IServerInterface
     */
    public function setRemoteAddress( $Value );
}

/**
 * Class Server
 *
 * @package MOC\MarkIV\Core\Generic\Globals\Source
 */
class Server implements IServerInterface
{

    /** @var array $Content */
    public static $Content = array();

    function __construct()
    {

        if (empty( self::$Content )) {
            self::$Content = $_SERVER;
        }
    }

    public static function doRefresh()
    {

        self::$Content = $_SERVER;
    }

    /**
     * @param null|int $Default
     *
     * @return null|int
     */
    public function getServerPort( $Default = null )
    {

        return $this->useDefault( $this->getValue( 'SERVER_PORT' ), $Default );
    }

    /**
     * @param mixed $Value
     * @param mixed $Default
     *
     * @return mixed
     */
    private function useDefault( $Value, $Default )
    {

        if (null === $Value) {
            return $Default;
        } else {
            return $Value;
        }
    }

    /**
     * @param string $Index
     *
     * @return null|mixed
     */
    private function getValue( $Index )
    {

        if (isset( self::$Content[$Index] )) {
            return self::$Content[$Index];
        } else {
            return null;
        }
    }

    /**
     * @param int $Value
     *
     * @return IServerInterface
     */
    public function setServerPort( $Value )
    {

        $this->setValue( 'SERVER_PORT', $Value );

        return $this;
    }

    /**
     * @param string $Index
     * @param mixed  $Value
     *
     * @return mixed
     */
    private function setValue( $Index, $Value )
    {

        return self::$Content[$Index] = $Value;
    }

    /**
     * @param null|string $Default
     *
     * @return null|string
     */
    public function getServerName( $Default = null )
    {

        return $this->useDefault( $this->getValue( 'SERVER_NAME' ), $Default );
    }

    /**
     * @param string $Value
     *
     * @return IServerInterface
     */
    public function setServerName( $Value )
    {

        $this->setValue( 'SERVER_NAME', $Value );

        return $this;
    }

    /**
     * @param null|string $Default
     *
     * @return null|string
     */
    public function getDocumentRoot( $Default = null )
    {

        return $this->useDefault( $this->getValue( 'DOCUMENT_ROOT' ), $Default );
    }

    /**
     * @param string $Value
     *
     * @return IServerInterface
     */
    public function setDocumentRoot( $Value )
    {

        $this->setValue( 'DOCUMENT_ROOT', $Value );

        return $this;
    }

    /**
     * @param null|string $Default
     *
     * @return null|string
     */
    public function getRemoteAddress( $Default = null )
    {

        return $this->useDefault( $this->getValue( 'REMOTE_ADDR' ), $Default );
    }

    /**
     * @param string $Value
     *
     * @return IServerInterface
     */
    public function setRemoteAddress( $Value )
    {

        $this->setValue( 'REMOTE_ADDR', $Value );

        return $this;
    }
}
