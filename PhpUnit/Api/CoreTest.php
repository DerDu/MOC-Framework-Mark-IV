<?php
namespace MOC\PhpUnit\Api;

use MOC\IV\Api;

class CoreTest extends \PHPUnit_Framework_TestCase {

	public function testUnitFactory() {

		$this->assertInstanceOf( '\MOC\IV\Core\Error', Api::groupCore()->unitError() );
		$this->assertInstanceOf( '\MOC\IV\Core\Drive', Api::groupCore()->unitDrive() );
		$this->assertInstanceOf( '\MOC\IV\Core\Session', Api::groupCore()->unitSession() );
	}
}
