<?php
namespace MOC\PhpUnit\Core\Drive;

use MOC\MarkIV\Api;

class FileTest extends \PHPUnit_Framework_TestCase {
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
	}
}
