<?php
namespace MOC\PhpUnit\Module\Encoding\Text;

use MOC\IV\Api;
use MOC\IV\Module\Encoding\Text\Source\Dictionary;

class ApiTest extends \PHPUnit_Framework_TestCase {

	public function testEncodingTextApi() {

		$this->assertInternalType( 'string', Api::groupModule()->unitEncoding()->apiText( '' )->getLatin1() );
		$this->assertInternalType( 'string', Api::groupModule()->unitEncoding()->apiText( '' )->getUtf8() );

		$Dictionary = new Dictionary();
		$this->assertInternalType( 'array', $Dictionary->getMapLatin1ToUtf8() );
		$this->assertNotEmpty( $Dictionary->getMapLatin1ToUtf8() );
		$this->assertInternalType( 'array', $Dictionary->getMapUtf8ToLatin1() );
		$this->assertNotEmpty( $Dictionary->getMapUtf8ToLatin1() );

	}
}
