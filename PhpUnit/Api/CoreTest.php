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

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Update\GitHub\Api', Api::groupCore()->unitUpdate()->apiGitHub() );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Update\GitHub\Gui\Api', Api::groupCore()->unitUpdate()->apiGui() );
	}

	/** @runTestsInSeparateProcesses */
	public function testUnitXmlFactory() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Xml\Reader\Api', $Api = Api::groupCore()->unitXml()->apiReader(
			Api::groupCore()->unitDrive()->apiFile( __DIR__.'/../../phpunit.xml' )
		) );
		$Api->parseContent()->getCode();

	}

	protected function setUp() {

		ob_console(__CLASS__);
	}

	protected function tearDown() {

		ob_print();
	}

}
