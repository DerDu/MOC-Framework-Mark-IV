<?php
namespace MOC\MarkIV\Core;

/**
 * Interface ISessionInterface
 *
 * @package MOC\MarkIV\Core
 */
interface ISessionInterface
{

    /**
     * @return Session\Handler\Api
     */
    public function apiHandler();
}

/**
 * Class Session
 *
 * @package MOC\MarkIV\Core
 */
class Session implements ISessionInterface
{

    /**
     * @return Session\Handler\Api
     */
    public function apiHandler()
    {

        return new Session\Handler\Api();
    }
}
