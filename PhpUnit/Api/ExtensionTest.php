<?php
namespace MOC\PhpUnit\Api;

use MOC\MarkIV\Api;

class ExtensionTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testUnitFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Extension\Documentation', Api::groupExtension()->unitDocumentation() );
		$this->assertInstanceOf( '\MOC\MarkIV\Extension\Excel', Api::groupExtension()->unitExcel() );
		$this->assertInstanceOf( '\MOC\MarkIV\Extension\Mail', Api::groupExtension()->unitMail() );
	}

	protected function setUp() {

		\BufferHandler::obSetUp( __CLASS__ );
	}

	protected function tearDown() {

		\BufferHandler::obTearDown();
	}
}
