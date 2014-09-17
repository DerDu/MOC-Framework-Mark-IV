<?php
namespace MOC\MarkIV\Core;

/**
 * Interface IErrorInterface
 *
 * @package MOC\MarkIV\Core
 */
interface IErrorInterface
{

    /**
     * @return Error\Handler\Api
     */
    public function apiHandler();
}

/**
 * Class Error
 *
 * @package MOC\MarkIV\Core
 */
class Error implements IErrorInterface
{

    /**
     * @return Error\Handler\Api
     */
    public function apiHandler()
    {

        return new Error\Handler\Api();
    }
}
