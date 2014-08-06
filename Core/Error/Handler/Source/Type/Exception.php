<?php
namespace MOC\IV\Core\Error\Handler\Source\Type;

use MOC\IV\Core\Error\Handler\Source\Template\Exception as ExceptionTemplate;

/**
 * Class Exception
 *
 * @package MOC\IV\Core\Error\Handler\Source\Type
 */
class Exception extends Generic {

	/**
	 * @return void
	 */
	public function Register() {

		set_exception_handler(
			create_function( '$Exception',
				'\MOC\IV\Api::Core()->Error()->Handler()->Type()->Exception()->Trigger('
				.'"Exception", $Exception->getMessage(), $Exception->getCode(),'
				.'$Exception->getFile(), $Exception->getLine(), $Exception->getTraceAsString(), "Execution has been stopped!" '
				.');'
			)
		);
	}

	/**
	 * @param string $Title
	 * @param string $Message
	 * @param string $Code
	 * @param string $File
	 * @param string $Line
	 * @param string $Trace
	 * @param string $Information
	 *
	 * @return void
	 */
	public function Trigger( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' ) {

		if( empty( $Trace ) || strlen( $Trace ) < 10 ) {
			$Trace = $this->getTrace();
		}
		print new ExceptionTemplate( $Title, $Message, $Code, $File, $Line, $Trace, $Information );
	}
}
