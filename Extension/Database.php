<?php
namespace MOC\MarkIV\Extension;

/**
 * Interface IDatabaseInterface
 *
 * @package MOC\MarkIV\Extension
 */
interface IDatabaseInterface
{

    /**
     * @return Database\Propel\Api
     */
    public function usePropel();

    /**
     * @return Database\Propel2\Api
     */
    public function usePropel2();

    /**
     * @return Database\Doctrine2\Api
     */
    public function useDoctrine2();
}

/**
 * Class Database
 *
 * @package MOC\MarkIV\Extension
 */
class Database implements IDatabaseInterface
{

    /**
     * @return Database\Propel\Api
     */
    public function usePropel()
    {

        return new Database\Propel\Api();
    }

    /**
     * @return Database\Propel2\Api
     */
    public function usePropel2()
    {

        return new Database\Propel2\Api();
    }

    /**
     * @return Database\Doctrine2\Api
     */
    public function useDoctrine2()
    {

        return new Database\Doctrine2\Api();
    }
}
