<?php
namespace MOC\PhpUnit;

use MOC\MarkIV\Api;

class ApiTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testGroupFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Api\Core', Api::groupCore() );
		$this->assertInstanceOf( '\MOC\MarkIV\Api\Module', Api::groupModule() );
		$this->assertInstanceOf( '\MOC\MarkIV\Api\Extension', Api::groupExtension() );
		$this->assertInstanceOf( '\MOC\MarkIV\Api\Plugin', Api::groupPlugin() );

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Update', Api::runUpdate() );

		Api::registerNamespace( 'NotAvailableNamespace', Api::groupCore()->unitDrive()->apiDirectory( __DIR__ ) );
		Api::registerNamespace( '\\', Api::groupCore()->unitDrive()->apiDirectory( __DIR__ ) );

		$this->assertFalse( Api::loadClass( '\NotAvailableClass' ) );
		$this->assertFalse( Api::loadInterface( '\INotAvailableInterface', '\INotAvailableInterface' ) );
		$this->assertFalse( Api::loadNamespace( '\NotAvailableClass' ) );
	}

	protected function setUp() {

		ob_console(__CLASS__);
	}

	protected function tearDown() {

		ob_print();
	}
}
