<?php
namespace MOC\IV\Core;

/**
 * Interface IUpdateInterface
 *
 * @package MOC\IV\Core
 */
interface IUpdateInterface {
	/**
	 * @return Update\Gui\Api
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
 * @package MOC\IV\Core
 */
class Update implements IUpdateInterface {

	/**
	 * @return Update\Gui\Api
	 */
	public function apiGui() {
		return new Update\Gui\Api();
	}

	/**
	 * @return Update\GitHub\Api
	 */
	public function apiGitHub() {
		return new Update\GitHub\Api();
	}
}
