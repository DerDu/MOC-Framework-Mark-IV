<?php
namespace MOC\MarkIV\Core;

/**
 * Interface IUpdateInterface
 *
 * @package MOC\MarkIV\Core
 */
interface IUpdateInterface
{

    /**
     * @return Update\GitHub\Gui\Api
     */
    public function apiGui();

    /**
     * @return Update\GitHub\Api
     */
    public function apiGitHub();
}

/**
 * Class Update
 *
 * @package MOC\MarkIV\Core
 */
class Update implements IUpdateInterface
{

    /**
     * @return Update\GitHub\Gui\Api
     */
    public function apiGui()
    {

        return new Update\GitHub\Gui\Api();
    }

    /**
     * @return Update\GitHub\Api
     */
    public function apiGitHub()
    {

        return new Update\GitHub\Api();
    }
}
