<?php
namespace MOC\PhpUnit;

use MOC\IV\Api;

class ApiTest extends \PHPUnit_Framework_TestCase {
	public function testInstanceCreation() {
		$this->assertInstanceOf( '\MOC\IV\Api\Core', Api::Core() );
		$this->assertInstanceOf( '\MOC\IV\Api\Module', Api::Module() );
		$this->assertInstanceOf( '\MOC\IV\Api\Extension', Api::Extension() );
		$this->assertInstanceOf( '\MOC\IV\Api\Plugin', Api::Plugin() );
	}
}
