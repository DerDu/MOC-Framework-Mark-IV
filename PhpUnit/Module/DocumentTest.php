<?php
namespace MOC\PhpUnit\Module;

use MOC\MarkIV\Api;

class DocumentTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testDocumentApi() {

		$this->assertInstanceOf( '\MOC\MarkIV\Module\Document\Excel\Api', Api::groupModule()->unitDocument()->apiExcel() );
	}

	protected function setUp() {

		\BufferHandler::obSetUp( __CLASS__ );
	}

	protected function tearDown() {

		\BufferHandler::obTearDown();
	}
}
