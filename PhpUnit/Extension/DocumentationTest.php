<?php
namespace MOC\PhpUnit\Extension;

use MOC\MarkIV\Api;

class DocumentationTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testDocumentationApi() {

		$this->assertInstanceOf( '\MOC\MarkIV\Extension\Documentation\ApiGen\Api', $Api = Api::groupExtension()->unitDocumentation()->useApiGen(
				Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/../../Core/Generic' ),
				Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/../../System/Documentation/Content/' )
			)
		);

	}

	protected function setUp() {

		ob_console( __METHOD__ );
	}

	protected function tearDown() {

		ob_print();
	}
}
