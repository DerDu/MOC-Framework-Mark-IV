<?php
namespace MOC\MarkIV\Module;

/**
 * Interface IDatabaseInterface
 *
 * @package MOC\MarkIV\Module
 */
interface IDatabaseInterface
{

    /**
     * @return Database\Sql\Api
     */
    public function apiSql();
}

/**
 * Class Database
 *
 * @package MOC\MarkIV\Module
 */
class Database implements IDatabaseInterface
{

    /**
     * @return Database\Sql\Api
     */
    public function apiSql()
    {

        return new Database\Sql\Api();
    }

}
