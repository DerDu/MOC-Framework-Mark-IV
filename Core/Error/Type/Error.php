<?php
namespace MOC\IV\Core\Error\Type;

class Error extends Generic {

	public function registerError() {

		set_error_handler(
			create_function('$Code, $Message, $File, $Line',
				'\MOC\IV\Api::useCore()->getError()->getType()->useError()->handleError( "Runtime", $Message, $Code, $File, $Line, "", "Unexpected - Execution has been continued!" );'
			)
		);

	}

}
