<?php
namespace MOC\PhpUnit\Module;

use MOC\MarkIV\Api;

class DocumentationTest extends \PHPUnit_Framework_TestCase {

	/** @runTestsInSeparateProcesses */
	public function testDocumentationApi() {
		ob_console();

		$this->assertInstanceOf( '\MOC\MarkIV\Extension\Documentation\ApiGen\Api', $Api = Api::groupExtension()->unitDocumentation()->useApiGen(
				Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/../../' ),
				Api::groupCore()->unitDrive()->apiDirectory( __DIR__.'/../../System/Documentation/Content/' )
			)
		);

		var_dump( $Api->createDocumentation() );

		ob_print();
	}
}
