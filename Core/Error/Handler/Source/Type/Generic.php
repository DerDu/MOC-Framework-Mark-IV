<?php
namespace MOC\IV\Core\Error\Handler\Source\Type;

use MOC\IV\Core\Error\Handler\Source\Template\Error as ErrorTemplate;

/**
 * Interface IGeneric
 *
 * @package MOC\IV\Core\Error\Handler\Source\Type
 */
interface IGeneric {

	public function Register();

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
	public function Trigger( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' );
}

/**
 * Class Generic
 *
 * @package MOC\IV\Core\Error\Handler\Source\Type
 */
abstract class Generic implements IGeneric {

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

		if( empty( $Trace ) ) {
			$Trace = $this->getTrace();
		}
		print new ErrorTemplate( $Title, $Message, $Code, $File, $Line, $Trace, $Information );
	}

	/**
	 * @return string
	 */
	protected function getTrace() {

		$Exception = new \Exception();
		$Trace = explode( "\n", $Exception->getTraceAsString() );
		$Length = count( $Trace );
		$Result = array();
		for( $Run = 0; $Run < $Length; $Run++ ) {
			$Result[] = substr( $Trace[$Run], strpos( $Trace[$Run], ' ' ) );
		}

		return '<ul style="padding: 0; margin: 0;"><li style="padding: 5px;">'.implode( '</li><li style="padding: 5px; border-top: 1px dotted #F00;">', $Result ).'</li><ul>';
	}
}
