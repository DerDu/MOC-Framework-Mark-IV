<?php
namespace MOC\IV\Core\Error\Type;

class Exception extends Generic {

	public function registerType() {

		set_exception_handler(
			create_function('$Exception',
				'\MOC\IV\Api::useCore()->useError()->getType()->useException()->handleType('
					.'"Exception", $Exception->getMessage(), $Exception->getCode(),'
					.'$Exception->getFile(), $Exception->getLine(), $Exception->getTraceAsString(), "Execution has been stopped!" '
					.');'
			)
		);

	}

	public function handleType( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' ) {
		if( empty( $Trace ) || strlen( $Trace ) < 10 ) {
			$Trace = $this->generateCallTrace();
		}
		print new Template\Exception( $Title, $Message, $Code, $File, $Line, $Trace, $Information );
	}
}
