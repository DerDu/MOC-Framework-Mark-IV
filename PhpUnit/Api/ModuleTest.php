<?php
namespace MOC\PhpUnit\Api;

use MOC\IV\Api;

class ModuleTest extends \PHPUnit_Framework_TestCase {
	public function testUnitFactory() {
		$this->assertInstanceOf( '\MOC\IV\Module\Encoding', Api::groupModule()->unitEncoding() );
	}
}
