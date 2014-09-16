<?php
namespace MOC\PhpUnit\Module;

use MOC\MarkIV\Api;

class EncodingTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testEncodingApi() {

		$this->assertInstanceOf( '\MOC\MarkIV\Module\Encoding\Text\Api', Api::groupModule()->unitEncoding()->apiText( '' ) );
	}

	protected function setUp() {

		ob_console( __CLASS__ );
	}

	protected function tearDown() {

		ob_print();
	}
}
