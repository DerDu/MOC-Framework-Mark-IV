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
interface ICore {

	/**
	 * @return Error
	 */
	public function Error();

	/**
	 * @return Session
	 */
	public function Session();

	/**
	 * @return Drive
	 */
	public function Drive();
}

/**
 * Class Core
 *
 * @package MOC\IV\Api
 */
class Core implements ICore {

	/**
	 * @return Drive
	 */
	public function Drive() {

		return new Drive();
	}

	/**
	 * @return Error
	 */
	public function Error() {

		return new Error();
	}

	/**
	 * @return Session
	 */
	public function Session() {

		return new Session();
	}

}
