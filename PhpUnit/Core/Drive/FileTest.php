<?php
namespace MOC\PhpUnit\Core\Drive;

use MOC\MarkIV\Api;

class FileTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testDriveFile() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Drive\File\Api', $Api = Api::groupCore()->unitDrive()->apiFile( __FILE__ ) );

		$this->assertInternalType( 'int', $Api->getSize() );
		$this->assertInternalType( 'bool', $Api->checkExists() );
		$this->assertInternalType( 'string', $Api->getName() );
		$this->assertInternalType( 'string', $Api->getLocation() );
		$this->assertInternalType( 'string', $Api->getPath() );
		$this->assertInternalType( 'string', $Api->getUrl() );
		$this->assertInternalType( 'string', $Api->getHash() );
		$this->assertInternalType( 'string', $Api->getFullName() );
		$this->assertInternalType( 'string', $Api->getContent() );
		$this->assertInternalType( 'string', $Api->getExtension() );
		$this->assertInternalType( 'int', $Api->getTime() );

		$Api = Api::groupCore()->unitCache()->apiFile()->getCacheFile( 'Dummy', true );
		$this->assertTrue( $Api->moveFile( $Api->getLocation().'.Test1' ) );
		$this->assertTrue( $Api->copyFile( $Api->getLocation().'.Test2' ) );
		$this->assertTrue( $Api->removeFile() );
	}

	protected function setUp() {

		ob_console( __METHOD__ );
	}

	protected function tearDown() {

		ob_print();
	}
}
