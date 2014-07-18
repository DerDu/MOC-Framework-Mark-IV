<?php
namespace MOC\IV\Core\Error\Type;

class Shutdown extends Generic {

	public function registerType(){

		register_shutdown_function(
			create_function('',
				'\MOC\IV\Api::useCore()->useError()->getType()->useShutdown()->handleType( "Shutdown", "","-1","","" );'
			)
		);

	}

	public function handleType( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' ) {
		if( ( $Error = error_get_last() ) !== null ) {
			if( empty( $Trace ) || strlen( $Trace ) < 10 ) {
				$Trace = $this->generateCallTrace();
			}
			print new Template\Shutdown( 'Shutdown', $Error['message'], $Error['type'], $Error['file'], $Error['line'], $Trace, 'Fatal - Execution has been stopped!' );
		}
	}

}
