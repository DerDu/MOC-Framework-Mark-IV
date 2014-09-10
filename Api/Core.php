<?php
namespace MOC\MarkIV\Api;

use MOC\MarkIV\Core\Cache;
use MOC\MarkIV\Core\Drive;
use MOC\MarkIV\Core\Error;
use MOC\MarkIV\Core\Network;
use MOC\MarkIV\Core\Session;
use MOC\MarkIV\Core\Update;
use MOC\MarkIV\Core\Xml;

/**
 * Interface ICore
 *
 * @package MOC\MarkIV\Api
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

	/**
	 * @return Xml
	 */
	public function unitXml();
}

/**
 * Class Core
 *
 * @package MOC\MarkIV\Api
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
