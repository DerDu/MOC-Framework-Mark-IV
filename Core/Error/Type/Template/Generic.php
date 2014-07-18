<?php
namespace MOC\IV\Core\Error\Type\Template;

abstract class Generic {

	private $HtmlTemplate;

	private $Title = 'Error';
	private $Message = '-NA-';
	private $Code = '-1';
	private $File;
	private $Line;
	private $Trace;
	private $Information;

	function __construct( $Title, $Message, $Code, $File, $Line, $Trace, $Information ) {

		$this->Title = $Title;
		$this->Message = $Message;
		$this->Code = $Code;
		$this->File = $File;
		$this->Line = $Line;
		$this->Trace = $Trace;
		$this->Information = $Information;

		$this->HtmlTemplate =
		'<div style="color: #F00; border: 1px dotted #F00; padding: 15px; margin-top: 1px; font-family: monospace; background-color: #FFEEAA;">'.
		'<div style="margin: 5px; margin-left: 0;">{Title}</div>'.
		'<div style="margin: 5px; margin-left: 0; font-size: 12px; font-weight: bold;">{Message}</div>'.
		'<div style="margin: 5px;">{Trace}</div>'.
		'<div style="margin: 5px; margin-left: 0;">Code {Code} in {File} at line {Line}</div>'.
		'<div style="margin: 5px; margin-left: 0;">{Information}</div>'.
		'</div>';
	}

	protected function setTemplate( $Html ) {
		$this->HtmlTemplate = $Html;
		return $this;
	}

	private function getOutput() {
		return str_replace(
			array( '{Title}', '{Message}', '{Code}', '{File}', '{Line}', '{Trace}', '{Information}' ),
			array( $this->Title, nl2br( $this->Message ), $this->Code, $this->File, $this->Line, nl2br( $this->Trace ), $this->Information ),
			$this->HtmlTemplate
		);
	}

	function __toString() {
		return $this->getOutput();
	}

}
