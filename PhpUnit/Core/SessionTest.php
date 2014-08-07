<?php
namespace MOC\PhpUnit\Core;

use MOC\IV\Api;

class SessionTest extends \PHPUnit_Framework_TestCase {

	public function testSessionApi() {

		$this->assertInstanceOf( '\MOC\IV\Core\Session\Handler\Api', Api::groupCore()->unitSession()->apiHandler() );
	}
}
