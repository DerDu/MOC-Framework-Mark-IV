<?php
namespace MOC\IV\Api;

use MOC\IV\Core\Drive;
use MOC\IV\Core\Error;
use MOC\IV\Core\Session;

interface ICore {
	public function useError();
	public function useSession();
	public function useDrive();
}

class Core implements ICore {

	public function useDrive() {
		return new Drive();
	}

	public function useError() {
		return new Error();
	}

	public function useSession(){
		return new Session();
	}

}
