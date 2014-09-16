<?php
namespace MOC\PhpUnit\Module\Encoding\Text;

use MOC\MarkIV\Api;
use MOC\MarkIV\Module\Encoding\Text\Source\Dictionary;

class ApiTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testEncodingTextApi() {

		$this->assertInternalType( 'string', Api::groupModule()->unitEncoding()->apiText( '' )->getLatin1() );
		$this->assertInternalType( 'string', Api::groupModule()->unitEncoding()->apiText( '' )->getUtf8() );

		$Dictionary = new Dictionary();
		$this->assertInternalType( 'array', $Dictionary->getMapLatin1ToUtf8() );
		$this->assertNotEmpty( $Dictionary->getMapLatin1ToUtf8() );
		$this->assertInternalType( 'array', $Dictionary->getMapUtf8ToLatin1() );
		$this->assertNotEmpty( $Dictionary->getMapUtf8ToLatin1() );

	}

	protected function setUp() {

		ob_console( __METHOD__ );
	}

	protected function tearDown() {

		ob_print();
	}
}
