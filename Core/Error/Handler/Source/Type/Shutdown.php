<?php
namespace MOC\MarkIV\Core\Error\Handler\Source\Type;

use MOC\MarkIV\Core\Error\Handler\Source\Template\Shutdown as ShutdownTemplate;

/**
 * Class Shutdown
 *
 * @package MOC\MarkIV\Core\Error\Handler\Source\Type
 */
class Shutdown extends Generic {

	/**
	 * @return void
	 */
	public function registerType() {

		register_shutdown_function(
			create_function( '',
				'\MOC\MarkIV\Api::groupCore()->unitError()->apiHandler()->apiType()->buildShutdown()->setData( "Shutdown", "","-1","","" );'
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

		if( ( $Error = error_get_last() ) !== null && $Error['type'] === E_ERROR ) {
			if( empty( $Trace ) || strlen( $Trace ) < 10 ) {
				$Trace = $this->getTrace();
			}
			print new ShutdownTemplate( 'Shutdown', $Error['message'], $Error['type'], $Error['file'], $Error['line'], $Trace, 'Fatal - Execution has been stopped!' );
		}
	}

}
