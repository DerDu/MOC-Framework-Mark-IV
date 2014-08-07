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
	/** @var bool $ApplyHtmlStyle */
	private static $ApplyHtmlStyle = true;

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
			'<div class="MOC-Error-Reporting-Container MOC-Error-Reporting-Type-Error">'.
			'<div class="MOC-Error-Reporting-Element">{Title}</div>'.
			'<div class="MOC-Error-Reporting-Element MOC-Error-Reporting-Message">{Message}</div>'.
			'<div class="MOC-Error-Reporting-Element">Code {Code} in {File} at line {Line}</div>'.
			'<div class="MOC-Error-Reporting-Element">
				<div class="MOC-Error-Reporting-Trace">{Trace}</div>
			</div>'.
			'<div class="MOC-Error-Reporting-Element">{Information}</div>'.
			'</div>';

		$this->HtmlStyle =
			'<style type="text/css">'.
			'.MOC-Error-Reporting-Container { margin: 1px; padding: 10px; font-family: arial; margin: 5px 0 5px 0; font-size: 14px; }'.
			'.MOC-Error-Reporting-Element { margin: 5px 0 5px 0; font-size: 13px; }'.
			'.MOC-Error-Reporting-Message { font-size: 13px; font-weight: bold; padding: 7px 0 7px 0; }'.

			'.MOC-Error-Reporting-Trace { padding: 7px; font-size: 12px; border: 1px dotted #F00; font-family: monospace; margin: 15px 0 15px 0; }'.
			'.MOC-Error-Reporting-Trace ul { padding: 0; margin: 0; }'.
			'.MOC-Error-Reporting-Trace li { padding: 5px; border-top: 1px dotted #F00; }'.
			'.MOC-Error-Reporting-Trace li:first-child { border-top: none; }'.

			'.MOC-Error-Reporting-Type-Error { background-color: #FEA; color: #F00; border: 1px dotted #F00; }'.

			'.MOC-Error-Reporting-Type-Exception { background-color: #B00; color: #ED9; border: 1px dotted #ED9; }'.
			'.MOC-Error-Reporting-Type-Exception .MOC-Error-Reporting-Trace { border: 1px dotted #ED9; }'.
			'.MOC-Error-Reporting-Type-Exception .MOC-Error-Reporting-Trace li { border-top: 1px dotted #ED9; }'.
			'.MOC-Error-Reporting-Type-Exception .MOC-Error-Reporting-Trace li:first-child { border-top: none; }'.

			'.MOC-Error-Reporting-Type-Shutdown { background-color: #B00; color: #ED9; border: 1px dotted #ED9; }'.
			'.MOC-Error-Reporting-Type-Shutdown .MOC-Error-Reporting-Trace { border: 1px dotted #ED9; }'.
			'.MOC-Error-Reporting-Type-Shutdown .MOC-Error-Reporting-Trace li { border-top: 1px dotted #ED9; }'.
			'.MOC-Error-Reporting-Type-Shutdown .MOC-Error-Reporting-Trace li:first-child { border-top: none; }'.
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
		$Output = ( self::$ApplyHtmlStyle ? $this->HtmlStyle : '' ).str_replace(
			array( '{Title}', '{Message}', '{Code}', '{File}', '{Line}', '{Trace}', '{Information}' ),
			array( $this->Title, nl2br( $this->Message ), $this->Code, $this->File, $this->Line, nl2br( $this->Trace ), $this->Information ),
			$this->HtmlTemplate
		);
		self::$ApplyHtmlStyle = false;
		return $Output;
	}

	/**
	 * @return string
	 */
	function __toString() {

		return $this->getOutput();
	}
}
