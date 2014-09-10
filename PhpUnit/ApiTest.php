<?php
namespace MOC\PhpUnit;

use MOC\MarkIV\Api;

class ApiTest extends \PHPUnit_Framework_TestCase {

	public function testGroupFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Api\Core', Api::groupCore() );
		$this->assertInstanceOf( '\MOC\MarkIV\Api\Module', Api::groupModule() );
		$this->assertInstanceOf( '\MOC\MarkIV\Api\Extension', Api::groupExtension() );
		$this->assertInstanceOf( '\MOC\MarkIV\Api\Plugin', Api::groupPlugin() );
	}
}
