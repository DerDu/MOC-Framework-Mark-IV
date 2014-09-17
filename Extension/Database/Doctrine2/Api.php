<?php
namespace MOC\MarkIV\Extension\Database\Doctrine2;

use MOC\MarkIV\Core\Generic\Extension\Source\Instance;
use MOC\MarkIV\Extension\Database\IApiInterface;

/**
 * Class Api
 *
 * @package MOC\MarkIV\Extension\Database\Doctrine2
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

    }

    /**
     * @param null|string $Identifier
     *
     * @return Api
     */
    public function buildInstance( $Identifier = null )
    {

        $this->createInstance( new \Doctrine2(), $Identifier );

        return $this;
    }
}
