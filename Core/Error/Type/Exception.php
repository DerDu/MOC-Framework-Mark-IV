<?php
namespace MOC\IV\Core\Error\Type;

class Exception extends Generic {

	public function registerError() {

		set_exception_handler(
			create_function('$Exception',
				'\MOC\IV\Api::useCore()->getError()->getType()->useException()->handleError('
					.'"Exception", $Exception->getMessage(), $Exception->getCode(),'
					.'$Exception->getFile(), $Exception->getLine(), $Exception->getTraceAsString(), "Unexpected - Execution has been stopped!" '
					.');'
			)
		);

	}

	public function handleError( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' ) {
		parent::handleError( $Title, $Message, $Code, $File, $Line, $Trace, $Information );
		exit( $Code );
	}

	public function triggerError( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' ) {
		parent::triggerError( $Title, $Message, $Code, $File, $Line, $Trace, $Information );
		exit( $Code );
	}

}
