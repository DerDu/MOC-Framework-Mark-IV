<?php
namespace MOC\IV\Core\Error;

interface IType {
	public function useError();
	public function useException();
	public function useShutdown();
}

class Type implements IType {

	public function useError() {
		return new Type\Error();
	}

	public function useException() {
		return new Type\Exception();
	}

	public function useShutdown() {
		return new Type\Shutdown();
	}

}
