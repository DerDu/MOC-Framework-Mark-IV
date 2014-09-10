<?php
namespace MOC\PhpUnit\Core;

use MOC\MarkIV\Api;

class NetworkTest extends \PHPUnit_Framework_TestCase {

	public function testNetworkApi() {

		$this->assertInstanceOf( '\MOC\MarkIV\Core\Network\Proxy\Api', Api::groupCore()->unitNetwork()->apiProxy() );
	}
}
