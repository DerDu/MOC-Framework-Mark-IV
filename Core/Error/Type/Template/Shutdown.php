<?php
namespace MOC\IV\Core\Error\Type\Template;

class Shutdown extends Generic {

	function __construct( $Title, $Message, $Code, $File, $Line, $Trace, $Information ) {
		parent::__construct( $Title, $Message, $Code, $File, $Line, $Trace, $Information );
		$this->setTemplate(
			'<div style="color: #F00; border: 1px solid #F00; padding: 15px; margin-top: 1px; font-family: monospace; background-color: #611;">'.
			'<div style="margin: 5px; margin-left: 0;">{Title}</div>'.
			'<div style="margin: 5px; margin-left: 0; font-size: 12px; font-weight: bold;">{Message}</div>'.
			'<div style="margin: 5px;">{Trace}</div>'.
			'<div style="margin: 5px; margin-left: 0;">Code {Code} in {File} at line {Line}</div>'.
			'<div style="margin: 5px; margin-left: 0;">{Information}</div>'.
			'</div>'
		);
	}

}
