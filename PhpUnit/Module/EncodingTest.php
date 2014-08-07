<?php
namespace MOC\PhpUnit\Module;

use MOC\IV\Api;

class EncodingTest extends \PHPUnit_Framework_TestCase {

	public function testEncodingApi() {

		$this->assertInstanceOf( '\MOC\IV\Module\Encoding\Text\Api', Api::groupModule()->unitEncoding()->apiText( '' ) );
	}
}
