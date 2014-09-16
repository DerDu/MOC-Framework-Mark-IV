<?php
namespace MOC\PhpUnit\Core\Session\Handler;

use MOC\MarkIV\Api;

class HandlerTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testSessionHandlerApi() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Session\Handler\IApiInterface', $Api = Api::groupCore()->unitSession()->apiHandler() );
		$this->assertEmpty( $Api->getIdentifier() );

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Session\Handler\IApiInterface', $Api->openSession() );
		$this->assertNotEmpty( $Api->getIdentifier() );
		$this->assertInternalType( 'array', $Api->getValue() );
		$this->assertEmpty( $Api->getValue() );
		$this->assertNull( $Api->getValue( 'KeyNotExists' ) );
		$this->assertInternalType( 'array', $Api->getContent() );

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Session\Handler\IApiInterface', $Api->setValue( 'Key', 'Value' ) );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Session\Handler\IApiInterface', $Api->newIdentifier() );
		$this->assertEquals( 'Value', $Api->getValue( 'Key' ) );

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Session\Handler\IApiInterface', $Api->destroySession() );
		$this->assertEmpty( $Api->getIdentifier() );

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Session\Handler\IApiInterface', $Api->closeSession() );
	}

	protected function setUp() {

		\BufferHandler::obSetUp( __CLASS__ );
	}

	protected function tearDown() {

		\BufferHandler::obTearDown();
	}
}
