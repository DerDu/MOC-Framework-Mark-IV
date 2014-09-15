<?php
namespace MOC\PhpUnit\Module;

use MOC\MarkIV\Api;

class DocumentTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testDocumentApi() {

		$this->assertInstanceOf( '\MOC\MarkIV\Module\Document\Excel\Api', Api::groupModule()->unitDocument()->apiExcel() );
	}

	protected function setUp() {

		ob_console();
	}

	protected function tearDown() {

		ob_print();
	}
}
