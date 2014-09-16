<?php
namespace MOC\PhpUnit\Module;

use MOC\MarkIV\Api;

class EncodingTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testEncodingApi() {

		$this->assertInstanceOf( '\MOC\MarkIV\Module\Encoding\Text\Api', Api::groupModule()->unitEncoding()->apiText( '' ) );
	}

	protected function setUp() {

		\BufferHandler::obSetUp( __CLASS__ );
	}

	protected function tearDown() {

		\BufferHandler::obTearDown();
	}
}
