<?php
namespace MOC\PhpUnit;

use MOC\IV\Api;

class ApiTest extends \PHPUnit_Framework_TestCase {
	public function testInstanceCreation() {
		$this->assertInstanceOf( '\MOC\IV\Api\Core', Api::groupCore() );
		$this->assertInstanceOf( '\MOC\IV\Api\Module', Api::groupModule() );
		$this->assertInstanceOf( '\MOC\IV\Api\Extension', Api::groupExtension() );
		$this->assertInstanceOf( '\MOC\IV\Api\Plugin', Api::groupPlugin() );
	}
}
