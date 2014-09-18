<?php
namespace MOC\MarkIV\Extension\Database\Doctrine2;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
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

        \MOC\MarkIV\Api::registerNamespace( 'Doctrine\ORM',
            \MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/3rdParty/lib' )
        );
        \MOC\MarkIV\Api::registerNamespace( 'Doctrine\DBAL',
            \MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/3rdParty/vendor/doctrine/dbal/lib' )
        );
        \MOC\MarkIV\Api::registerNamespace( 'Doctrine\Common',
            \MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/3rdParty/vendor/doctrine/common/lib' )
        );
    }

    /**
     * @param null|string $Identifier
     *
     * @throws \Exception
     * @return Api
     */
    public function buildInstance( $Identifier = null )
    {

        throw new \Exception( 'Wrong usage of Database Extension Interface' );
    }

    /**
     * @param int         $Driver
     * @param string      $Host
     * @param string      $User
     * @param string      $Password
     * @param null|string $Database
     *
     * @return IApiInterface
     * @throws \Doctrine\DBAL\DBALException
     */
    public function openConnection( $Driver = self::DRIVER_MYSQL, $Host, $User, $Password, $Database = null )
    {

        $Configuration = new Configuration();

        $Parameter = array(
            'host'     => $Host,
            'user'     => $User,
            'password' => $Password,
            'dbname'   => $Database
        );

        switch ($Driver) {
            case self::DRIVER_MYSQL: {
                $Parameter['driver'] = 'pdo_mysql';
                break;
            }
            case self::DRIVER_MSSQL: {
                $Parameter['driver'] = 'pdo_mssql';
                break;
            }
        }

        $Connection = DriverManager::getConnection( $Parameter, $Configuration );

        $this->createInstance( $Connection, $Host.$User.$Database );

        return $this;
    }

    /**
     * @return IApiInterface
     */
    public function closeConnection()
    {

        /** @var \Doctrine\DBAL\Connection $Connection */
        $Connection = $this->currentInstance()->getObject();
        $Connection->close();
        $this->destroyInstance();
        return $this;

    }

    /**
     * @param callable $Callback
     *
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws \Exception
     * @return void
     */
    public function executeTransaction( \Closure $Callback )
    {

        /** @var \Doctrine\DBAL\Connection $Connection */
        $Connection = $this->currentInstance()->getObject();
        $Connection->beginTransaction();
        try {
            $Callback( $Connection );
            $Connection->commit();
        } catch( \Exception $e ) {
            $Connection->rollback();
            throw $e;
        }
    }
}
