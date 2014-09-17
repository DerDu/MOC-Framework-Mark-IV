<?php
namespace MOC\MarkIV\Core\Generic\Globals;

use MOC\MarkIV\Core\Generic\Globals\Source\Server;

/**
 * Interface IApiInterface
 *
 * @package MOC\MarkIV\Core\Generic\Globals
 */
interface IApiInterface
{

    /**
     * @return Server
     */
    public function useServer();
}

/**
 * Class Api
 *
 * @package MOC\MarkIV\Core\Generic\Globals
 */
class Api implements IApiInterface
{

    /**
     * @return Server
     */
    public function useServer()
    {

        return new Server();
    }
}
