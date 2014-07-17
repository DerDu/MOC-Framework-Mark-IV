<?php
namespace MOC\IV\Api;

use MOC\IV\Core\Error;
use MOC\IV\Core\Session;

interface ICore {
	public function useError();
	public function getSession();
}

class Core implements ICore {

	public function useError() {
		return new Error();
	}

	public function getSession(){
		return new Session();
	}

}
