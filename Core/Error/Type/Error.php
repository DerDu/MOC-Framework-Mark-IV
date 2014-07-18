<?php
namespace MOC\IV\Core\Error\Type;

class Error extends Generic {

	public function registerType() {

		set_error_handler(
			create_function('$Code, $Message, $File, $Line',
				'\MOC\IV\Api::useCore()->useError()->getType()->useError()'.
				'->handleType( "Runtime Error", $Message, $Code, $File, $Line, "", "Execution has been continued..." );'
			)
		);

	}

}
