<?php
namespace MOC\IV\Core\Error\Type;

interface IGeneric {
	public function registerType();
	public function triggerType( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' );
	public function handleType( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' );
}

abstract class Generic implements IGeneric {

	public function handleType( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' ) {
		if( empty( $Trace ) ) {
			$Trace = $this->generateCallTrace();
		}
		print new Template\Error( $Title, $Message, $Code, $File, $Line, $Trace, $Information );
	}

	public function triggerType( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' ) {
		$this->handleType(  $Title, $Message, $Code, $File, $Line, $Trace, $Information );
	}

	private function generateCallTrace() {

		$Exception = new \Exception();
		$Trace = explode("\n", $Exception->getTraceAsString());

		array_shift( $Trace ); // remove call to this method
		$Length = count( $Trace );
		$Result = array();

		for( $Run = 0; $Run < $Length; $Run++ ) {
			$Result[] = '#'.$Run.' '.substr( $Trace[$Run], strpos($Trace[$Run], ' ') );
		}
		return "\t" . implode("\n\t", $Result);
	}
}
