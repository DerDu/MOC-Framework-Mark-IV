<?php
namespace MOC\MarkIV\Extension\Database\Propel;

use MOC\MarkIV\Core\Generic\Extension\Source\Instance;
use MOC\MarkIV\Extension\Database\IApiInterface;

/**
 * Class Api
 *
 * @package MOC\MarkIV\Extension\Database\Propel
 */
class Api extends \MOC\MarkIV\Core\Generic\Extension\Source\Api implements IApiInterface
{

    /** @var null|Instance $Instance */
    protected static $Instance = null;
    /** @var Instance[] $InstanceQueue */
    protected static $InstanceQueue = array();

    /**
     * Bootstrap
     */
    function __construct()
    {

        \MOC\MarkIV\Api::registerNamespace(
            'Propel', \MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/3rdParty/runtime/lib' )
        );

    }

    /**
     * @param null|string $Identifier
     *
     * @return Api
     */
    public function buildInstance( $Identifier = null )
    {

        $this->createInstance( new \Propel(), $Identifier );

        return $this;
    }
}
