<?php
namespace MOC\IV\Core\Error\Type;

interface IGeneric {
	public function registerError();
	public function triggerError( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' );
	public function handleError( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' );
}

abstract class Generic implements IGeneric {

	protected $HandleTemplate;
	protected $TriggerTemplate;

	function __construct() {
		$this->HandleTemplate =
		'<div style="color: #F00; border: 1px dotted #F00; padding: 15px; margin-top: 1px; font-family: monospace; background-color: #FFEEAA;">'.
		'<div style="margin: 5px; margin-left: 0;">{Title}</div>'.
		'<div style="margin: 5px; margin-left: 0; font-weight: bold;">{Message}</div>'.
		'<div style="margin: 5px;">{Trace}</div>'.
		'<div style="margin: 5px; margin-left: 0;">Code {Code} in {File} at line {Line}</div>'.
		'<div style="margin: 5px; margin-left: 0;">{Information}</div>'.
		'</div>';

		$this->TriggerTemplate =
		'<div style="color: #F00; border: 1px dotted #F00; padding: 15px; margin-top: 1px; font-family: monospace; background-color: #FFEEAA;">'.
		'<div style="margin: 5px; margin-left: 0;">{Title}</div>'.
		'<div style="margin: 5px; margin-left: 0; font-weight: bold;">{Message}</div>'.
		'<div style="margin: 5px;">{Trace}</div>'.
		'<div style="margin: 5px; margin-left: 0;">Code {Code} in {File} at line {Line}</div>'.
		'<div style="margin: 5px; margin-left: 0;">{Information}</div>'.
		'</div>';
	}

	public function handleError( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' ) {
		print str_replace(
			array( '{Title}', '{Message}', '{Code}', '{File}', '{Line}', '{Trace}', '{Information}' ),
			array( $Title, $Message, $Code, $File, $Line, nl2br( $Trace ), $Information ),
			$this->HandleTemplate
		);
	}

	public function triggerError( $Title, $Message, $Code, $File, $Line, $Trace = '', $Information = '' ) {
		print str_replace(
			array( '{Title}', '{Message}', '{Code}', '{File}', '{Line}', '{Trace}', '{Information}' ),
			array( $Title, $Message, $Code, $File, $Line, nl2br( $Trace ), $Information ),
			$this->TriggerTemplate
		);
	}
}
