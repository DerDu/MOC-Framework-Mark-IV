<?php
namespace MOC\MarkIV\Extension\Mail\PHPMailer;

use MOC\MarkIV\Core\Generic\Extension\Source\Instance;
use MOC\MarkIV\Extension\Mail\IApiInterface;

/**
 * Class Api
 *
 * @package MOC\MarkIV\Extension\Mail\PHPMailer
 */
class Api extends \MOC\MarkIV\Core\Generic\Extension\Source\Api implements IApiInterface {

	/** @var null|Instance $Instance */
	protected static $Instance = null;
	/** @var Instance[] $InstanceQueue */
	protected static $InstanceQueue = array();

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

		$this->createInstance( new \PHPMailer(), $Identifier );

		return $this;
	}
}
