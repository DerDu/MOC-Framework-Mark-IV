<?php
namespace MOC\MarkIV\Module\Mail\Smtp\Source\Address;

use MOC\MarkIV\Api;

/**
 * Class Address
 *
 * @package MOC\MarkIV\Module\Mail\Smtp\Source\Address
 */
abstract class Address {

	/** @var string $Mail */
	protected $Mail = '';
	/** @var string $Name */
	protected $Name = '';

	/**
	 * @param string $Address
	 * @param string $Name
	 */
	final function __construct( $Address, $Name ) {

		$this->Mail = $Address;
		$this->Name = $Name;
	}

	abstract public function setAddress();

	/**
	 * @return bool
	 */
	final public function isValid() {

		/** @var \PHPMailer $Extension */
		$Extension = Api::groupExtension()->unitMail()->usePHPMailer()->currentInstance()->getObject();
		if( $Extension->ValidateAddress( $this->Mail ) ) {
			return true;
		} else {
			return false;
		}
	}
}
