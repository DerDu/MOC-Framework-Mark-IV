<?php
namespace MOC\IV\Core;

/**
 * Interface ISession
 *
 * @package MOC\IV\Core
 */
interface ISessionInterface {

	/**
	 * @return Session\Handler\Api
	 */
	public function apiHandler();
}

/**
 * Class Session
 *
 * @package MOC\IV\Core
 */
class Session implements ISessionInterface {

	/**
	 * @return Session\Handler\Api
	 */
	public function apiHandler() {

		return new Session\Handler\Api();
	}
}
