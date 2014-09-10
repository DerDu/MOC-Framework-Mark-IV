<?php
namespace MOC\MarkIV\Core\Error\Handler\Api;

use MOC\MarkIV\Core\Error\Handler\Source\Type\Error;
use MOC\MarkIV\Core\Error\Handler\Source\Type\Exception;
use MOC\MarkIV\Core\Error\Handler\Source\Type\Shutdown;

/**
 * Interface IType
 *
 * @package MOC\MarkIV\Core\Error\Handler\Api
 */
interface ITypeInterface {

	/**
	 * @return Error
	 */
	public function buildError();

	/**
	 * @return Exception
	 */
	public function buildException();

	/**
	 * @return Shutdown
	 */
	public function buildShutdown();
}

/**
 * Class Type
 *
 * @package MOC\MarkIV\Core\Error\Handler\Api
 */
class Type implements ITypeInterface {

	/**
	 * @return Error
	 */
	public function buildError() {

		return new Error();
	}

	/**
	 * @return Exception
	 */
	public function buildException() {

		return new Exception();
	}

	/**
	 * @return Shutdown
	 */
	public function buildShutdown() {

		return new Shutdown();
	}

}
