<?php
namespace MOC\IV\Api;

use MOC\IV\Core\Session;

interface ICore {
	public function getSession();
}

class Core implements ICore {

	public function getSession(){
		return new Session();
	}

}
