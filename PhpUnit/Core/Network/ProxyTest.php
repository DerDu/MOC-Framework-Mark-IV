<?php
namespace MOC\PhpUnit\Core\Network;

use MOC\MarkIV\Api;

class ProxyTest extends \PHPUnit_Framework_TestCase
{

    /** @runTestsInSeparateProcesses */
    public function testProxyApi()
    {

        $this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Api\Config',
            Api::groupCore()->unitNetwork()->apiProxy()->apiConfig() );
        $this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Api\Type',
            Api::groupCore()->unitNetwork()->apiProxy()->apiType() );
    }

    /** @runTestsInSeparateProcesses */
    public function testProxyServer()
    {

        $this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Config\Server',
            $Api = Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildServer( 'Host', '1234' )
        );

        $this->assertInternalType( 'string', $Api->getHost() );
        $this->assertInternalType( 'int', $Api->getPort() );

        $this->assertEquals( 'Host', $Api->getHost() );
        $this->assertEquals( '1234', $Api->getPort() );

        $this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Config\Server',
            $Api->setHost( 'DummyHost' )
        );
        $this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Config\Server',
            $Api->setPort( '5678' )
        );

        $this->assertInternalType( 'string', $Api->getHost() );
        $this->assertInternalType( 'int', $Api->getPort() );

        $this->assertEquals( 'DummyHost', $Api->getHost() );
        $this->assertEquals( '5678', $Api->getPort() );
    }

    /** @runTestsInSeparateProcesses */
    public function testProxyCredentials()
    {

        $this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Config\Credentials',
            $Api = Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildCredentials( 'User', 'Pass' )
        );

        $this->assertInternalType( 'string', $Api->getUsername() );
        $this->assertInternalType( 'string', $Api->getPassword() );

        $this->assertEquals( 'User', $Api->getUsername() );
        $this->assertEquals( 'Pass', $Api->getPassword() );

        $this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Config\Credentials',
            $Api->setUsername( 'Username' )
        );
        $this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Config\Credentials',
            $Api->setPassword( 'Password' )
        );

        $this->assertInternalType( 'string', $Api->getUsername() );
        $this->assertInternalType( 'string', $Api->getPassword() );

        $this->assertEquals( 'Username', $Api->getUsername() );
        $this->assertEquals( 'Password', $Api->getPassword() );
    }

    /** @runTestsInSeparateProcesses */
    public function testProxyFileHttp()
    {

        $Globals = new \MOC\MarkIV\Core\Generic\Globals\Api();

        $Globals->useServer()->setServerPort( 80 );
        $Url = 'http://www.google.de';

        $this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Type\None',
            $Api = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildNone()
        );

        $this->assertRegExp( '!^([0-9]{3}|)$!', $Api->getFile( $Url, true ) );

        $Config = Api::groupCore()->unitUpdate()->apiGitHub()->buildConfig();

        $Server = Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildServer( $Config->getProxyHost(),
            $Config->getProxyPort() );
        $this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Type\Relay',
            $Api = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildRelay( $Server )
        );

        $this->assertRegExp( '!^([0-9]{3}|)$!', $Api->getFile( $Url, true ) );

        $Credentials = Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildCredentials( $Config->getProxyUser(),
            $Config->getProxyPass() );
        $this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Type\Basic',
            $Api = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildBasic( $Server, $Credentials )
        );

        $this->assertRegExp( '!^([0-9]{3}|)$!', $Api->getFile( $Url, true ) );

    }

    /** @runTestsInSeparateProcesses */
    public function testProxyFileHttps()
    {

        $Globals = new \MOC\MarkIV\Core\Generic\Globals\Api();

        $Globals->useServer()->setServerPort( 443 );
        $Url = 'http://www.google.de';

        $this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Type\None',
            $Api = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildNone()
        );

        $this->assertRegExp( '!^([0-9]{3}|)$!', $Api->getFile( $Url, true ) );

        $Config = Api::groupCore()->unitUpdate()->apiGitHub()->buildConfig();

        $Server = Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildServer( $Config->getProxyHost(),
            $Config->getProxyPort() );
        $this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Type\Relay',
            $Api = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildRelay( $Server )
        );

        $this->assertRegExp( '!^([0-9]{3}|)$!', $Api->getFile( $Url, true ) );

        $Credentials = Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildCredentials( $Config->getProxyUser(),
            $Config->getProxyPass() );
        $this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Source\Type\Basic',
            $Api = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildBasic( $Server, $Credentials )
        );

        $this->assertRegExp( '!^([0-9]{3}|)$!', $Api->getFile( $Url, true ) );

    }

    protected function setUp()
    {

        \BufferHandler::obSetUp( __CLASS__ );
    }

    protected function tearDown()
    {

        \BufferHandler::obTearDown();
    }
}
