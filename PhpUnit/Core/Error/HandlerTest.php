<?php
namespace MOC\PhpUnit\Core\Error\Handler;

use MOC\MarkIV\Api;

class HandlerTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testErrorHandlerApi() {

		$Handler = Api::groupCore()->unitError()->apiHandler();

		$Handler->apiType()->buildError()->setData( 'Test', 'Message', 'Code', __FILE__, __LINE__, 'Trace', 'Information' );
		$Handler->apiType()->buildException()->setData( 'Test', 'Message', 'Code', __FILE__, __LINE__, 'Trace', 'Information' );
		$Handler->apiType()->buildShutdown()->setData( 'Test', 'Message', 'Code', __FILE__, __LINE__, 'Trace', 'Information' );

	}

	protected function setUp() {

		\BufferHandler::obSetUp( __CLASS__ );
	}

	protected function tearDown() {

		\BufferHandler::obTearDown();
	}
}
