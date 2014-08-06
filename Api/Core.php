<?php
namespace MOC\IV\Api;

use MOC\IV\Core\Drive;
use MOC\IV\Core\Error;
use MOC\IV\Core\Session;

/**
 * Interface ICore
 *
 * @package MOC\IV\Api
 */
interface ICoreInterface {

	/**
	 * @return Error
	 */
	public function unitError();

	/**
	 * @return Session
	 */
	public function unitSession();

	/**
	 * @return Drive
	 */
	public function unitDrive();
}

/**
 * Class Core
 *
 * @package MOC\IV\Api
 */
class Core implements ICoreInterface {

	/**
	 * @return Drive
	 */
	public function unitDrive() {

		return new Drive();
	}

	/**
	 * @return Error
	 */
	public function unitError() {

		return new Error();
	}

	/**
	 * @return Session
	 */
	public function unitSession() {

		return new Session();
	}

}
