<?php
namespace MOC\IV\Core;

/**
 * Interface ISession
 *
 * @package MOC\IV\Core
 */
interface ISession {

	/**
	 * @return Session\Handler\Api
	 */
	public function Handler();
}

/**
 * Class Session
 *
 * @package MOC\IV\Core
 */
class Session implements ISession {

	/**
	 * @return Session\Handler\Api
	 */
	public function Handler() {

		return new Session\Handler\Api();
	}
}
