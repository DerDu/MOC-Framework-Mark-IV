<?php
namespace MOC\PhpUnit\Core;

use MOC\IV\Api;

class NetworkTest extends \PHPUnit_Framework_TestCase {

	public function testNetworkApi() {

		$this->assertInstanceOf( '\MOC\IV\Core\Network\Proxy\Api', Api::groupCore()->unitNetwork()->apiProxy() );
	}
}
