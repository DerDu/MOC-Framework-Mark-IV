<?php
namespace MOC\IV\Core\Error;

use MOC\IV\Core\Error\Type\Error;
use MOC\IV\Core\Error\Type\Exception;
use MOC\IV\Core\Error\Type\Shutdown;

interface IType {
	public function useError();
	public function useException();
	public function useShutdown();
}

class Type implements IType {

	public function useError() {
		return new Error();
	}

	public function useException() {
		return new Exception();
	}

	public function useShutdown() {
		return new Shutdown();
	}

}
