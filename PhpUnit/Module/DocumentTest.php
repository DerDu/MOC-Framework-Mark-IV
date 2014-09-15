<?php
namespace MOC\PhpUnit\Module;

use MOC\MarkIV\Api;

class DocumentTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @runTestsInSeparateProcesses
	 */
	public function testDocumentApi() {

		ob_console();

		$this->assertInstanceOf( '\MOC\MarkIV\Module\Document\Excel\Api', Api::groupModule()->unitDocument()->apiExcel() );

		ob_print();
	}

	protected function setUp() {

		Api::runBootstrap();
	}
}
