<?php
namespace MOC\IV\Core\Error\Type;

class Shutdown extends Generic {

	public function registerError(){

		register_shutdown_function(
			create_function('',
				'\MOC\IV\Api::useCore()->getError()->getType()->useError()->handleError();'
			)
		);

	}

	public function handleError( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' ) {
		if( ( $Error = error_get_last() ) !== null ) {
			parent::handleError( 'Shutdown', $Error['message'], $Error['type'], $Error['file'], $Error['line'], '', 'Fatal - Execution has been stopped!' );
			exit( $Error['type'] );
		}
	}

	public function triggerError( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' ) {
		if( ( $Error = error_get_last() ) !== null ) {
			parent::triggerError( 'Shutdown', $Error['message'], $Error['type'], $Error['file'], $Error['line'], '', '' );
			exit( $Error['type'] );
		}
	}
}
