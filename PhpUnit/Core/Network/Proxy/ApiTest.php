<?php
namespace MOC\PhpUnit\Core\Network\Proxy;

use MOC\IV\Api;

class ApiTest extends \PHPUnit_Framework_TestCase {

	public function testProxyApi() {
		$this->assertInstanceOf( '\MOC\IV\Core\Network\Proxy\Source\Api\Config', Api::groupCore()->unitNetwork()->apiProxy()->apiConfig() );
		$this->assertInstanceOf( '\MOC\IV\Core\Network\Proxy\Source\Api\Type', Api::groupCore()->unitNetwork()->apiProxy()->apiType() );
	}

	public function testConfigApi() {
		$this->assertInstanceOf( '\MOC\IV\Core\Network\Proxy\Source\Config\Credentials', Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildCredentials( 'DummyUser', 'DummyPassword' ) );
		$this->assertInstanceOf( '\MOC\IV\Core\Network\Proxy\Source\Config\Server', Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildServer( 'DummyHost', '1234' ) );
	}

	public function testTypeApi() {
		$Server = Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildServer( '127.0.0.1', '80' );
		$Credentials = Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildCredentials( 'DummyUser', 'DummyPassword' );

		$this->assertInstanceOf( '\MOC\IV\Core\Network\Proxy\Source\Type\None', $None = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildNone() );
		$this->assertInstanceOf( '\MOC\IV\Core\Network\Proxy\Source\Type\Relay', $Relay = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildRelay( $Server ) );
		$this->assertInstanceOf( '\MOC\IV\Core\Network\Proxy\Source\Type\Basic', $Basic = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildBasic( $Server, $Credentials ) );

		$this->assertInternalType('string', $None->getFile( 'http://127.0.0.1', true ) );
		$this->assertInternalType('string', $Relay->getFile( 'http://127.0.0.1', true ) );
		$this->assertInternalType('string', $Basic->getFile( 'http://127.0.0.1', true ) );

	}
}
