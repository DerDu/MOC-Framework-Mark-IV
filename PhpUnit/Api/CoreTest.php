<?php
namespace MOC\PhpUnit\Api;

use MOC\MarkIV\Api;

class CoreTest extends \PHPUnit_Framework_TestCase {

	public function testUnitFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Error', Api::groupCore()->unitError() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Drive', Api::groupCore()->unitDrive() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Session', Api::groupCore()->unitSession() );
	}
}
