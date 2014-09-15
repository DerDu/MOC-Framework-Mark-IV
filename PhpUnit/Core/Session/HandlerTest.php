<?php
namespace MOC\PhpUnit\Core\Session\Handler;

use MOC\MarkIV\Api;

class HandlerTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @runTestsInSeparateProcesses
	 */
	public function testSessionHandlerApi() {

		ob_console();

		$this->assertEmpty( Api::groupCore()->unitSession()->apiHandler()->getIdentifier() );

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Session\Handler\Api', Api::groupCore()->unitSession()->apiHandler()->openSession() );
		$this->assertNotEmpty( Api::groupCore()->unitSession()->apiHandler()->getIdentifier() );

		$this->assertInternalType( 'array', Api::groupCore()->unitSession()->apiHandler()->getValue() );
		$this->assertEmpty( Api::groupCore()->unitSession()->apiHandler()->getValue() );
		$this->assertNull( Api::groupCore()->unitSession()->apiHandler()->getValue( 'KeyNotExists' ) );

		Api::groupCore()->unitSession()->apiHandler()->newIdentifier();
		$this->assertInternalType( 'array', Api::groupCore()->unitSession()->apiHandler()->getContent() );

		Api::groupCore()->unitSession()->apiHandler()->setValue( 'Key', 'Value' );
		$this->assertEquals( 'Value', Api::groupCore()->unitSession()->apiHandler()->getValue( 'Key' ) );

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Session\Handler\Api', Api::groupCore()->unitSession()->apiHandler()->destroySession() );
		$this->assertEmpty( Api::groupCore()->unitSession()->apiHandler()->getIdentifier() );

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Session\Handler\Api', Api::groupCore()->unitSession()->apiHandler()->closeSession() );
		Api::groupCore()->unitSession()->apiHandler()->setIdentifier( 'Test2' );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Session\Handler\Api', Api::groupCore()->unitSession()->apiHandler()->destroySession() );

		ob_close();
	}
}
