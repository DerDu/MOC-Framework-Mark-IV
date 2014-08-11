<?php
namespace MOC\PhpUnit\Core;

use MOC\IV\Api;

class SessionTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @runTestsInSeparateProcesses
	 */
	public function testSessionApi() {

		$this->assertInstanceOf( '\MOC\IV\Core\Session\Handler\Api', Api::groupCore()->unitSession()->apiHandler() );
	}
}
