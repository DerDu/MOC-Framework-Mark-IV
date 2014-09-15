<?php
namespace MOC\PhpUnit\Api;

use MOC\MarkIV\Api;

class PluginTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testUnitFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Plugin\OSMEngine', Api::groupPlugin()->unitOSMEngine() );
	}

	protected function setUp() {

		ob_console();
	}

	protected function tearDown() {

		ob_print();
	}
}
