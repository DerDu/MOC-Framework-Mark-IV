<?php
namespace MOC\IV\Core\Error\Handler\Source\Template;

/**
 * Class Generic
 *
 * @package MOC\IV\Core\Error\Handler\Source\Template
 */
abstract class Generic {

	/** @var string $HtmlTemplate */
	private $HtmlTemplate;
	/** @var string $HtmlStyle */
	private $HtmlStyle;

	/** @var string $Title */
	private $Title = 'Error';
	/** @var string $Message */
	private $Message = '-NA-';
	/** @var string $Code */
	private $Code = '-1';
	/** @var string $File */
	private $File;
	/** @var string $Line */
	private $Line;
	/** @var string $Trace */
	private $Trace;
	/** @var string $Information */
	private $Information;

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

		$this->Title = $Title;
		$this->Message = $Message;
		$this->Code = $Code;
		$this->File = $File;
		$this->Line = $Line;
		$this->Trace = $Trace;
		$this->Information = $Information;

		$this->HtmlTemplate =
			'<div class="MOC-Error-Reporting-Container" style="background-color: #FEA;">'.
			'<div class="MOC-Error-Reporting-Element">{Title}</div>'.
			'<div class="MOC-Error-Reporting-Element" style="font-weight: bold;">{Message}</div>'.
			'<div class="MOC-Error-Reporting-Element">
				<div class="MOC-Error-Reporting-Trace">{Trace}</div>
			</div>'.
			'<div class="MOC-Error-Reporting-Element">Code {Code} in {File} at line {Line}</div>'.
			'<div class="MOC-Error-Reporting-Element">{Information}</div>'.
			'</div>';

		$this->HtmlStyle =
			'<style type="text/css">'.
			'.MOC-Error-Reporting-Container { color: #F00; border: 1px dotted #F00; margin: 1px; padding: 10px; font-family: monospace; }'.
			'.MOC-Error-Reporting-Element { margin: 5px 0 5px 0; font-size: 10px; }'.
			'.MOC-Error-Reporting-Trace { padding: 5px; font-size: 9px; border: 1px dotted #F00;" }'.
			'</style>';
	}

	/**
	 * @param string $Html
	 *
	 * @return $this
	 */
	protected function setTemplate( $Html ) {

		$this->HtmlTemplate = $Html;

		return $this;
	}

	/**
	 * @return string
	 */
	private function getOutput() {

		return $this->HtmlStyle.str_replace(
			array( '{Title}', '{Message}', '{Code}', '{File}', '{Line}', '{Trace}', '{Information}' ),
			array( $this->Title, nl2br( $this->Message ), $this->Code, $this->File, $this->Line, nl2br( $this->Trace ), $this->Information ),
			$this->HtmlTemplate
		);
	}

	/**
	 * @return string
	 */
	function __toString() {

		return $this->getOutput();
	}
}
