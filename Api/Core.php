<?php
namespace MOC\IV\Api;

use MOC\IV\Core\Cache;
use MOC\IV\Core\Drive;
use MOC\IV\Core\Error;
use MOC\IV\Core\Network;
use MOC\IV\Core\Session;
use MOC\IV\Core\Update;
use MOC\IV\Core\Xml;

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

	/**
	 * @return Network
	 */
	public function unitNetwork();

	/**
	 * @return Cache
	 */
	public function unitCache();

	/**
	 * @return Update
	 */
	public function unitUpdate();
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

	/**
	 * @return Network
	 */
	public function unitNetwork() {

		return new Network();
	}

	/**
	 * @return Cache
	 */
	public function unitCache() {

		return new Cache();
	}

	/**
	 * @return Update
	 */
	public function unitUpdate() {

		return new Update();
	}

	/**
	 * @return Xml
	 */
	public function unitXml() {

		return new Xml();
	}

}
