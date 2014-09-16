<?php
namespace MOC\PhpUnit\Core\Core;

use MOC\MarkIV\Api;

class GenericTest extends \PHPUnit_Framework_TestCase {
	/** @runTestsInSeparateProcesses */
	public function testGenericExtensionApi() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Generic\Extension\IApiInterface', Api::groupCore()->genericExtension() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Generic\Extension\Source\IInstanceInterface', $Api = Api::groupCore()->genericExtension()->buildInstance( new \stdClass(), 'TestDummy' ) );

		$this->assertEquals( 'TestDummy', $Api->getIdentifier() );
		$this->assertInstanceOf( '\stdClass', $Api->getObject() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Generic\Extension\Source\IInstanceInterface', $Api->setObject( new \stdClass() ) );
		$this->assertInstanceOf( '\stdClass', $Api->getObject() );
	}

	/** @runTestsInSeparateProcesses */
	public function testGenericGlobalsServerApi() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Generic\Globals\IApiInterface', Api::groupCore()->genericGlobals() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Generic\Globals\Source\IServerInterface', $Api = Api::groupCore()->genericGlobals()->useServer() );

		$Api::doRefresh();

		$this->assertEquals( $_SERVER['DOCUMENT_ROOT'], $Api->getServerDocumentRoot() );
		$this->assertEquals( $_SERVER['SERVER_PORT'], $Api->getServerPort() );
		$this->assertEquals( $_SERVER['SERVER_NAME'], $Api->getServerName() );
	}
}
