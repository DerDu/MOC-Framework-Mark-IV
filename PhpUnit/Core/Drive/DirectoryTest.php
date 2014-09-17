<?php
namespace MOC\PhpUnit\Core\Drive;

use MOC\MarkIV\Api;

class DirectoryTest extends \PHPUnit_Framework_TestCase
{

    /** @runTestsInSeparateProcesses */
    public function testDriveDirectory()
    {

        $this->assertInstanceOf( '\MOC\MarkIV\Core\Drive\Directory\Api',
            $Api = Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/../../' ) );

        $this->assertInternalType( 'bool', $Api->checkExists() );
        $this->assertInternalType( 'bool', $Api->checkIsEmpty() );
        $this->assertInternalType( 'string', $Api->getName() );
        $this->assertInternalType( 'string', $Api->getLocation() );
        $this->assertInternalType( 'string', $Api->getPath() );
        $this->assertInternalType( 'string', $Api->getUrl() );
        $this->assertInternalType( 'string', $Api->getHash() );
        $this->assertInternalType( 'int', $Api->getTime() );

        $ResultA = $Api->getFileList();
        $this->assertInternalType( 'array', $ResultA );
        $this->assertNotEmpty( $ResultA );
        $ResultB = $Api->getFileList( true );
        $this->assertInternalType( 'array', $ResultB );
        $this->assertNotEmpty( $ResultB );
        $this->assertNotEquals( $ResultA, $ResultB );

        $ResultA = $Api->getDirectoryList();
        $this->assertInternalType( 'array', $ResultA );
        $this->assertNotEmpty( $ResultA );
        $ResultB = $Api->getDirectoryList( true );
        $this->assertInternalType( 'array', $ResultB );
        $this->assertNotEmpty( $ResultB );
        $this->assertNotEquals( $ResultA, $ResultB );
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
