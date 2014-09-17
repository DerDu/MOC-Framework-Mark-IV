<?php
namespace MOC\MarkIV\Core\Generic\Extension\Source;

/**
 * Class Api
 *
 * @package MOC\MarkIV\Core\Generic\Extension\Source
 */
abstract class Api
{

    /** @var null|Instance $Instance */
    protected static $Instance = null;
    /** @var Instance[] $InstanceQueue */
    protected static $InstanceQueue = array();

    /**
     * Bootstrap
     */
    abstract function __construct();

    abstract function buildInstance( $Identifier = null );

    /**
     * @param $Identifier
     *
     * @return Api
     */
    final public function selectInstance( $Identifier )
    {

        if (null !== static::$Instance) {
            static::$InstanceQueue[static::$Instance->getIdentifier()] = static::$Instance;
        }
        static::$Instance = static::$InstanceQueue[$Identifier];

        return $this;
    }

    /**
     * @return Api
     */
    final public function destroyInstance()
    {

        unset( static::$InstanceQueue[static::$Instance->getIdentifier()] );
        static::$Instance = null;

        return $this;
    }

    /**
     * @return null|Instance
     */
    final public function currentInstance()
    {

        return static::$Instance;
    }

    /**
     * @param object      $Extension
     * @param null|string $Identifier
     *
     * @return Api
     */
    final protected function createInstance( $Extension, $Identifier = null )
    {

        $Instance = new Instance( $Extension, $Identifier );
        if (null !== static::$Instance) {
            static::$InstanceQueue[static::$Instance->getIdentifier()] = static::$Instance;
        }
        static::$Instance = $Instance;

        return $this;
    }

}
