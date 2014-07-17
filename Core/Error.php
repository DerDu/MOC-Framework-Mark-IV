<?php
namespace MOC\IV\Core;

use MOC\IV\Core\Error\Type\Generic;

interface IError {
	public function doRegister( Generic $Type );
}

class Error implements IError {

	public function getType() {
		return new Error\Type();
	}

	public function doRegister( Generic $Type ) {
		$Type->registerError();
	}

}
