<?php
namespace MOC\PhpUnit\Api;

use MOC\MarkIV\Api;

class PluginTest extends \PHPUnit_Framework_TestCase {

	public function testUnitFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Plugin\OSMEngine', Api::groupPlugin()->unitOSMEngine() );
	}
}
