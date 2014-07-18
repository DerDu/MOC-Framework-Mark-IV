<?php
namespace MOC\IV\Core\Error\Type;

interface IGeneric {
	public function registerType();
	public function handleType( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' );
}

abstract class Generic implements IGeneric {

	public function handleType( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' ) {
		if( empty( $Trace ) ) {
			$Trace = $this->generateCallTrace();
		}
		print new Template\Error( $Title, $Message, $Code, $File, $Line, $Trace, $Information );
	}

	protected function generateCallTrace() {

		$Exception = new \Exception();
		$Trace = explode("\n", $Exception->getTraceAsString());

		$Length = count( $Trace );
		$Result = array();

		for( $Run = 0; $Run < $Length; $Run++ ) {
			$Result[] = substr( $Trace[$Run], strpos($Trace[$Run], ' ') );
		}
		return '<ul style="padding: 0; margin: 0;"><li style="padding: 5px;">'.implode( '</li><li style="padding: 5px; border-top: 1px dotted #F00;">', $Result) .'</li><ul>';
	}
}
