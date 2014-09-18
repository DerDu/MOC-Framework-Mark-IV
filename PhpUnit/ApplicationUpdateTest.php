<?php
namespace MOC\PhpUnit;

use MOC\MarkIV\Api;

class ApplicationUpdateTest extends \PHPUnit_Framework_TestCase
{

    /** @runTestsInSeparateProcesses */
    public function testApplication()
    {

        $this->assertInstanceOf( '\MOC\MarkIV\Core\Update\GitHub\Api',
            $GitHub = Api::groupCore()->unitUpdate()->apiGitHub() );
        $this->assertInstanceOf( '\MOC\MarkIV\Core\Update\GitHub\Gui\Api',
            $Gui = Api::groupCore()->unitUpdate()->apiGui() );

        $this->assertInstanceOf( '\MOC\MarkIV\Core\Update\GitHub\Source\IConfigInterface',
            $Config = $GitHub->buildConfig() );

        $this->assertInternalType( 'bool', $Config->getChannelActiveRelease() );
        $this->assertInternalType( 'bool', $Config->getChannelActiveNightly() );
        $this->assertInternalType( 'bool', $Config->getChannelActivePreview() );

        $this->assertInternalType( 'bool', $Config->getMatchAutoUpdateMajor() );
        $this->assertInternalType( 'bool', $Config->getMatchAutoUpdateMinor() );
        $this->assertInternalType( 'bool', $Config->getMatchAutoUpdatePatch() );
        $this->assertInternalType( 'bool', $Config->getMatchAutoUpdateBuild() );

        $this->assertInternalType( 'bool', $Config->getMatchAutoInstallBuild() );
        $this->assertInternalType( 'bool', $Config->getMatchAutoInstallMajor() );
        $this->assertInternalType( 'bool', $Config->getMatchAutoInstallMinor() );
        $this->assertInternalType( 'bool', $Config->getMatchAutoInstallPatch() );

        $this->assertInternalType( 'string', $Config->getChannelListRelease() );
        $this->assertInternalType( 'string', $Config->getChannelListPreview() );
        $this->assertInternalType( 'string', $Config->getChannelListNightly() );

        $this->assertInternalType( 'string', $Config->getGitHubChannelTree( 'Identifier', true ) );
        $this->assertInternalType( 'string', $Config->getGitHubChannelBlob( 'Identifier' ) );

        $this->assertInstanceOf( '\MOC\MarkIV\Core\Update\GitHub\Source\IVersionInterface',
            $Version = $Config->getVersion() );
        $this->assertInternalType( 'int', $Version->getMajor() );
        $this->assertInternalType( 'int', $Version->getMinor() );
        $this->assertInternalType( 'int', $Version->getPatch() );
        $this->assertInternalType( 'int', $Version->getBuild() );
        $this->assertInternalType( 'string', $Version->getVersionString() );

        $Config->getNetwork();

        $this->assertInternalType( 'int', $Config->getCurrentVersionMajor() );
        $this->assertInternalType( 'int', $Config->getCurrentVersionMinor() );
        $this->assertInternalType( 'int', $Config->getCurrentVersionPatch() );
        $this->assertInternalType( 'int', $Config->getCurrentVersionBuild() );

        $this->assertInternalType( 'int',
            $GitHub->buildVersion( '0.0.0.0' )->checkBehindAheadStatusOf( $Version ) );

        $Config->getProxyHost();
        $Config->getProxyPort();
        $Config->getProxyUser();
        $Config->getProxyPass();

        $this->assertInternalType( 'string', $Config->getGitHubChannelLimit() );

        $this->assertInternalType( 'string', $GitHub->buildChannel( $Config )->getChannelLimit() );
        $this->assertInternalType( 'string', $GitHub->buildChannel( $Config )->getChannelRetryTimestamp() );

        $this->assertInternalType( 'array', $Release = $GitHub->buildChannel( $Config )->getChannelRelease() );
        $this->assertInternalType( 'array', $Release = $GitHub->buildChannel( $Config )->getChannelPreview() );
        $this->assertInternalType( 'array', $Release = $GitHub->buildChannel( $Config )->getChannelNightly() );

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
