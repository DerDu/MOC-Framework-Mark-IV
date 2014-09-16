<?php
namespace MOC\PhpUnit\Core;

use MOC\MarkIV\Api;

class CacheTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testNetworkApi() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Cache\File\Api', $Api = Api::groupCore()->unitCache()->apiFile() );

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Cache\File\Api', $Api->setCacheData( 'Dummy', 'UnitTest' ) );
		$this->assertEquals( 'Dummy', $Api->getCacheData( 'UnitTest' ) );
		$this->assertInstanceOf( '\MOC\MarkIV\Core\Drive\File\Api', $File = $Api->getCacheFile( 'UnitTest' ) );
		$File->touchFile();
		$File->removeFile();
		$Api->purgeCache();
	}

	protected function setUp() {

		\BufferHandler::obSetUp( __CLASS__ );
	}

	protected function tearDown() {

		\BufferHandler::obTearDown();
	}
}
