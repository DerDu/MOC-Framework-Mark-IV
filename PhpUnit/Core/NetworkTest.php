<?php
namespace MOC\PhpUnit\Core;

use MOC\MarkIV\Api;

class NetworkTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testNetworkApi() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Api', Api::groupCore()->unitNetwork()->apiProxy() );
	}

	protected function setUp() {

		ob_console();
	}

	protected function tearDown() {

		ob_print();
	}
}
