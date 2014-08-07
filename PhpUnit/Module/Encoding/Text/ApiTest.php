<?php
namespace MOC\PhpUnit\Module\Encoding\Text;

use MOC\IV\Api;

class ApiTest extends \PHPUnit_Framework_TestCase {

	public function testTextApi() {

		$this->assertInternalType( 'string', Api::groupModule()->unitEncoding()->apiText( '' )->getLatin1() );
		$this->assertInternalType( 'string', Api::groupModule()->unitEncoding()->apiText( '' )->getUtf8() );
	}
}
