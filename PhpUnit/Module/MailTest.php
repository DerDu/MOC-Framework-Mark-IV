<?php
namespace MOC\PhpUnit\Module;

use MOC\MarkIV\Api;

class MailTest extends \PHPUnit_Framework_TestCase {

	public function testMailApi() {

		var_dump( func_get_args() );

		$this->assertInstanceOf( '\MOC\MarkIV\Module\Mail\Smtp\Api', Api::groupModule()->unitMail()->apiSmtp() );
		$this->assertInstanceOf( '\MOC\MarkIV\Module\Mail\SendMail\Api', Api::groupModule()->unitMail()->apiSendMail() );
		$this->assertInstanceOf( '\MOC\MarkIV\Module\Mail\QMail\Api', Api::groupModule()->unitMail()->apiQMail() );
		$this->assertInstanceOf( '\MOC\MarkIV\Module\Mail\Pop3\Api', Api::groupModule()->unitMail()->apiPop3() );
	}
}
