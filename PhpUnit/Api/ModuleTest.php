<?php
namespace MOC\PhpUnit\Api;

use MOC\MarkIV\Api;

class ModuleTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testUnitFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Module\Encoding', Api::groupModule()->unitEncoding() );
		$this->assertInstanceOf( '\MOC\MarkIV\Module\Document', Api::groupModule()->unitDocument() );
		$this->assertInstanceOf( '\MOC\MarkIV\Module\Mail', Api::groupModule()->unitMail() );
	}

	protected function setUp() {

		ob_console(__CLASS__);
	}

	protected function tearDown() {

		ob_print();
	}
}
