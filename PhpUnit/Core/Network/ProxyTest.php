<?php
namespace MOC\PhpUnit\Core\Network;

use MOC\MarkIV\Api;

class ProxyTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testNetworkProxyApi() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Api\Config', Api::groupCore()->unitNetwork()->apiProxy()->apiConfig() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Api\Type', Api::groupCore()->unitNetwork()->apiProxy()->apiType() );

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Config\Credentials', Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildCredentials( 'DummyUser', 'DummyPassword' ) );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Config\Server', Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildServer( 'DummyHost', '1234' ) );

		$Server = Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildServer( '127.0.0.1', '80' );
		$Credentials = Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildCredentials( 'DummyUser', 'DummyPassword' );

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Type\None', $None = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildNone() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Type\Relay', $Relay = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildRelay( $Server ) );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Type\Basic', $Basic = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildBasic( $Server, $Credentials ) );
	}

	protected function setUp() {

		ob_console();
	}

	protected function tearDown() {

		ob_print();
	}
}
