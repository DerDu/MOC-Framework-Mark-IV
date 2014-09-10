<?php
namespace MOC\MarkIV\Core\Error\Handler\Source\Type;

use MOC\MarkIV\Core\Error\Handler\Source\Template\Exception as ExceptionTemplate;

/**
 * Class Exception
 *
 * @package MOC\MarkIV\Core\Error\Handler\Source\Type
 */
class Exception extends Generic {

	/**
	 * @return void
	 */
	public function registerType() {

		set_exception_handler(
			create_function( '$Exception',
				'\MOC\MarkIV\Api::groupCore()->unitError()->apiHandler()->apiType()->buildException()->setData('
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
	public function setData( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' ) {

		if( empty( $Trace ) || strlen( $Trace ) < 10 ) {
			$Trace = $this->getTrace();
		}
		print new ExceptionTemplate( $Title, $Message, $Code, $File, $Line, $Trace, $Information );
	}
}
