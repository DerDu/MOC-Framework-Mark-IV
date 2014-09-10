<?php
namespace MOC\PhpUnit\Module;

use MOC\MarkIV\Api;

class EncodingTest extends \PHPUnit_Framework_TestCase {

	public function testEncodingApi() {

		$this->assertInstanceOf( '\MOC\MarkIV\Module\Encoding\Text\Api', Api::groupModule()->unitEncoding()->apiText( '' ) );
	}
}
