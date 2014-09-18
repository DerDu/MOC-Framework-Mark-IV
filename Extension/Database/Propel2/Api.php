<?php
namespace MOC\MarkIV\Extension\Database\Propel2;

use MOC\MarkIV\Core\Generic\Extension\Source\Instance;
use MOC\MarkIV\Extension\Database\IApiInterface;
use Propel\Runtime\Propel;

/**
 * Class Api
 *
 * @package MOC\MarkIV\Extension\Database\Propel2
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
            'Propel\Runtime\Propel', \MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/3rdParty/src' )
        );

    }

    /**
     * @param null|string $Identifier
     *
     * @return Api
     */
    public function buildInstance( $Identifier = null )
    {

        $this->createInstance( new Propel(), $Identifier );

        return $this;
    }
}
