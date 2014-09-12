<?php
namespace MOC\MarkIV\Extension\Mail\PHPMailer;

use MOC\MarkIV\Extension\Mail\IApiInterface;

/**
 * Class Api
 *
 * @package MOC\MarkIV\Extension\Mail\PHPMailer
 */
class Api extends \MOC\MarkIV\Core\Generic\Extension\Source\Api implements IApiInterface {

	/**
	 * Bootstrap
	 */
	function __construct() {

		require_once( '3rdParty/PHPMailer/class.phpmailer.php' );
		require_once( '3rdParty/PHPMailer/class.pop3.php' );
		require_once( '3rdParty/PHPMailer/class.smtp.php' );
	}

	/**
	 * @param null|string $Identifier
	 *
	 * @return Api
	 */
	public function buildInstance( $Identifier = null ) {

		parent::buildInstance( new \PHPMailer(), $Identifier );

		return $this;
	}
}
