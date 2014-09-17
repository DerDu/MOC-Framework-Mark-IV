<?php
namespace MOC\MarkIV\Api;

use MOC\MarkIV\Plugin\OSMEngine;

/**
 * Interface IPluginInterface
 *
 * @package MOC\MarkIV\Api
 */
interface IPluginInterface
{

    /**
     * @return OSMEngine
     */
    public function unitOSMEngine();
}

/**
 * Class Plugin
 *
 * @package MOC\MarkIV\Api
 */
class Plugin implements IPluginInterface
{

    /**
     * @return OSMEngine
     */
    public function unitOSMEngine()
    {

        return new OSMEngine();
    }

}
