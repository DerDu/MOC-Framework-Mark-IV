<?php
namespace MOC\PhpUnit\Api;

use MOC\MarkIV\Api;

class CoreTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testUnitFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Error', Api::groupCore()->unitError() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Drive', Api::groupCore()->unitDrive() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Session', Api::groupCore()->unitSession() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Cache', Api::groupCore()->unitCache() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Update', Api::groupCore()->unitUpdate() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Xml', Api::groupCore()->unitXml() );
	}

	/** @runTestsInSeparateProcesses */
	public function testUnitErrorFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Error\Handler\Api', Api::groupCore()->unitError()->apiHandler() );
	}

	/** @runTestsInSeparateProcesses */
	public function testUnitDriveFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Drive\Directory\Api', Api::groupCore()->unitDrive()->apiDirectory( __DIR__ ) );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Drive\File\Api', Api::groupCore()->unitDrive()->apiFile( __FILE__ ) );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Drive\Directory\Api', Api::groupCore()->unitDrive()->getCurrentDirectory() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Drive\Directory\Api', Api::groupCore()->unitDrive()->getDataDirectory() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Drive\Directory\Api', Api::groupCore()->unitDrive()->getRootDirectory() );
	}

	/** @runTestsInSeparateProcesses */
	public function testUnitSessionFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Session\Handler\Api', Api::groupCore()->unitSession()->apiHandler() );
	}

	/** @runTestsInSeparateProcesses */
	public function testUnitCacheFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Cache\File\Api', Api::groupCore()->unitCache()->apiFile() );
	}

	/** @runTestsInSeparateProcesses */
	public function testUnitUpdateFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Update\GitHub\Api', $GitHub = Api::groupCore()->unitUpdate()->apiGitHub() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Update\GitHub\Gui\Api', $Gui = Api::groupCore()->unitUpdate()->apiGui() );

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Update\GitHub\Source\IConfigInterface', $Config = $GitHub->buildConfig() );

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

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Update\GitHub\Source\IVersionInterface', $Version = $Config->getVersion() );
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

		$this->assertInternalType( 'int', $GitHub->buildVersion('0.0.0.0')->checkBehindAheadStatusOf( $Version ) );

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

	/** @runTestsInSeparateProcesses */
	public function testUnitXmlFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Xml\Reader\Api', $Api = Api::groupCore()->unitXml()->apiReader(
			Api::groupCore()->unitDrive()->apiFile( __DIR__.'/../../phpunit.xml' )
		) );
		$Content = $Api->parseContent();
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Xml\Reader\Source\Node', $Child = $Content->getChild( 'testsuites' ) );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Xml\Reader\Source\Node', $Child->getParent() );
		$this->assertInternalType( 'array', $Content->getAttributeList() );
		$this->assertInternalType( 'string', $Content->getAttributeString() );
		$this->assertInternalType( 'array', $Content->getChildList() );
		$this->assertInternalType( 'int', $Content->getChildListCount() );
		$this->assertInternalType( 'string', $Content->getCode() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Xml\Reader\Source\Node', $Child = $Content->getChild( 'blacklist', null, 0 ) );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Xml\Reader\Source\Node', $Child->getChild( 'directory', null, 0 ) );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Xml\Reader\Source\Node', $Child->getChild( 'directory', array(), 0 ) );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Xml\Reader\Source\Node', $Child->getChild( 'directory', array(), null, true, false, true ) );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Xml\Reader\Source\Node', $Content->getChild( 'testsuite', array( 'name' => 'TravisCI' ), 0 ) );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Xml\Reader\Source\Node', $Content->getChild( 'testsuite', array( 'name' => 'TravisCI' ), null, true, false, true ) );
	}

	protected function setUp() {

		\BufferHandler::obSetUp( __CLASS__ );
	}

	protected function tearDown() {

		\BufferHandler::obTearDown();
	}

}
