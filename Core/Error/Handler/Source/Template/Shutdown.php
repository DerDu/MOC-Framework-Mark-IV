<?php
namespace MOC\IV\Core\Error\Handler\Source\Template;

/**
 * Class Shutdown
 *
 * @package MOC\IV\Core\Error\Handler\Source\Template
 */
class Shutdown extends Generic {

	/**
	 * @param $Title
	 * @param $Message
	 * @param $Code
	 * @param $File
	 * @param $Line
	 * @param $Trace
	 * @param $Information
	 */
	function __construct( $Title, $Message, $Code, $File, $Line, $Trace, $Information ) {

		parent::__construct( $Title, $Message, $Code, $File, $Line, $Trace, $Information );
		$this->setTemplate(
			'<div class="MOC-Error-Reporting-Container MOC-Error-Reporting-Type-Shutdown">'.
			'<div class="MOC-Error-Reporting-Element">{Title}</div>'.
			'<div class="MOC-Error-Reporting-Element MOC-Error-Reporting-Message">{Message}</div>'.
			'<div class="MOC-Error-Reporting-Element">Code {Code} in {File} at line {Line}</div>'.
			'<div class="MOC-Error-Reporting-Element">
				<div class="MOC-Error-Reporting-Trace">{Trace}</div>
			</div>'.
			'<div class="MOC-Error-Reporting-Element">{Information}</div>'.
			'</div>'
		);
	}

}
