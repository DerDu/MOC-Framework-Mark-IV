<?php
namespace MOC\IV\Api;

use MOC\IV\Plugin\OSMEngine;

/**
 * Interface IPlugin
 *
 * @package MOC\IV\Api
 */
interface IPluginInterface {

}

/**
 * Class Plugin
 *
 * @package MOC\IV\Api
 */
class Plugin implements IPluginInterface {

	public function unitOSMEngine() {
		return new OSMEngine();
	}

}
