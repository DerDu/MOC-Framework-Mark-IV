<?php
namespace MOC\IV\Core;

/**
 * Interface IError
 *
 * @package MOC\IV\Core
 */
interface IError {

	/**
	 * @return Error\Handler\Api
	 */
	public function Handler();
}

/**
 * Class Error
 *
 * @package MOC\IV\Core
 */
class Error implements IError {

	/**
	 * @return Error\Handler\Api
	 */
	public function Handler() {

		return new Error\Handler\Api();
	}
}
