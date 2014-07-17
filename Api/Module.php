<?php
namespace MOC\IV\Api;

use MOC\IV\Module\Encoding;

interface IModule {
	public function useEncoding();
}

class Module implements IModule {

	public function useEncoding() {
		return new Encoding();
	}

}
