<?php
namespace MOC\MarkIV\Module\Database\Sql;

use MOC\MarkIV\Module\Database\IApiInterface;

/**
 * Class Api
 *
 * @package MOC\MarkIV\Module\Database\Sql
 */
class Api implements IApiInterface
{

    function __construct()
    {

        $Extension = \MOC\MarkIV\Api::groupExtension()->unitDatabase()->usePropel2()->currentInstance();
        if (null === $Extension) {
            \MOC\MarkIV\Api::groupExtension()->unitDatabase()->usePropel2()->buildInstance();
        }
    }

    /**
     * @param string      $Host
     * @param string      $User
     * @param string      $Password
     * @param null|string $Database
     *
     * @return IApiInterface
     */
    public function openConnection( $Host, $User, $Password, $Database = null )
    {

        /** @var \Propel $Extension */
        $Extension = \MOC\MarkIV\Api::groupExtension()->unitDatabase()->usePropel2()->currentInstance()->getObject();
        $Extension->initialize();
        var_dump( $Extension->getConnection() );

        return $this;
    }

    /**
     * @return IApiInterface
     */
    public function closeConnection()
    {
        /** @var \Propel $Extension */
        $Extension = \MOC\MarkIV\Api::groupExtension()->unitDatabase()->usePropel2()->currentInstance()->getObject();
        var_dump( $Extension->close() );
        return $this;
    }

}
