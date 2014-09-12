<?php
namespace MOC\PhpUnit\Core\Drive;

use MOC\MarkIV\Api;

class DirectoryTest extends \PHPUnit_Framework_TestCase {
	public function testDriveFile() {
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Drive\Directory\Api', $Api = Api::groupCore()->unitDrive()->apiDirectory( __DIR__ ) );

		$this->assertInternalType( 'bool', $Api->checkExists() );
		$this->assertInternalType( 'bool', $Api->checkIsEmpty() );
		$this->assertInternalType( 'string', $Api->getName() );
		$this->assertInternalType( 'string', $Api->getLocation() );
		$this->assertInternalType( 'string', $Api->getPath() );
		$this->assertInternalType( 'string', $Api->getUrl() );
		$this->assertInternalType( 'string', $Api->getHash() );
		$this->assertInternalType( 'int', $Api->getTime() );
	}
}
