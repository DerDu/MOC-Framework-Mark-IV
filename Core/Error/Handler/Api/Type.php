<?php
namespace MOC\IV\Core\Error\Handler\Api;

use MOC\IV\Core\Error\Handler\Source\Type\Error;
use MOC\IV\Core\Error\Handler\Source\Type\Exception;
use MOC\IV\Core\Error\Handler\Source\Type\Shutdown;

/**
 * Interface IType
 *
 * @package MOC\IV\Core\Error\Handler\Api
 */
interface IType {

	/**
	 * @return Error
	 */
	public function Error();

	/**
	 * @return Exception
	 */
	public function Exception();

	/**
	 * @return Shutdown
	 */
	public function Shutdown();
}

/**
 * Class Type
 *
 * @package MOC\IV\Core\Error\Handler\Api
 */
class Type implements IType {

	/**
	 * @return Error
	 */
	public function Error() {

		return new Error();
	}

	/**
	 * @return Exception
	 */
	public function Exception() {

		return new Exception();
	}

	/**
	 * @return Shutdown
	 */
	public function Shutdown() {

		return new Shutdown();
	}

}
