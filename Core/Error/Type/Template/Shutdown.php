<?php
namespace MOC\IV\Core\Error\Type\Template;

class Shutdown extends Generic {

	function __construct( $Title, $Message, $Code, $File, $Line, $Trace, $Information ) {
		parent::__construct( $Title, $Message, $Code, $File, $Line, $Trace, $Information );
		$this->setTemplate(
			'<div class="MOC-Error-Reporting-Container" style="background-color: #611;">'.
				'<div class="MOC-Error-Reporting-Element">{Title}</div>'.
				'<div class="MOC-Error-Reporting-Element" style="font-weight: bold;">{Message}</div>'.
				'<div class="MOC-Error-Reporting-Element">
					<div class="MOC-Error-Reporting-Trace">{Trace}</div>
				</div>'.
				'<div class="MOC-Error-Reporting-Element">Code {Code} in {File} at line {Line}</div>'.
				'<div class="MOC-Error-Reporting-Element">{Information}</div>'.
			'</div>'
		);
	}

}
