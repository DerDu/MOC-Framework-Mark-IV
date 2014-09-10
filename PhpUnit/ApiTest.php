<?php
namespace MOC\PhpUnit;

use MOC\MarkIV\Api;

class ApiTest extends \PHPUnit_Framework_TestCase {

	protected function setUp() {
		Api::runBootstrap();
	}


	public function testGroupFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Api\Core', Api::groupCore() );
		$this->assertInstanceOf( '\MOC\MarkIV\Api\Module', Api::groupModule() );
		$this->assertInstanceOf( '\MOC\MarkIV\Api\Extension', Api::groupExtension() );
		$this->assertInstanceOf( '\MOC\MarkIV\Api\Plugin', Api::groupPlugin() );

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Update', Api::runUpdate() );
		$this->assertFalse( Api::loadAdditional( 'FALSE' ) );
		$this->assertFalse( Api::loadInterface( 'FALSE', 'FALSE' ) );
		$this->assertFalse( Api::loadClass( 'FALSE' ) );
	}
}
