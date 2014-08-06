<?php
namespace MOC\IV\Core;

/**
 * Interface IError
 *
 * @package MOC\IV\Core
 */
interface IErrorInterface {

	/**
	 * @return Error\Handler\Api
	 */
	public function apiHandler();
}

/**
 * Class Error
 *
 * @package MOC\IV\Core
 */
class Error implements IErrorInterface {

	/**
	 * @return Error\Handler\Api
	 */
	public function apiHandler() {

		return new Error\Handler\Api();
	}
}
