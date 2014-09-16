<?php
namespace MOC\PhpUnit\Core;

use MOC\MarkIV\Api;

class SessionTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testSessionApi() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Session\Handler\Api', Api::groupCore()->unitSession()->apiHandler() );
	}

	protected function setUp() {

		\BufferHandler::obSetUp( __CLASS__ );
	}

	protected function tearDown() {

		\BufferHandler::obTearDown();
	}

}
