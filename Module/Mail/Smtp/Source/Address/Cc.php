<?php
namespace MOC\MarkIV\Module\Mail\Smtp\Source\Address;

use MOC\MarkIV\Api;
use MOC\MarkIV\Module\Mail\Smtp\Source\Address;

/**
 * Class Cc
 *
 * @package MOC\MarkIV\Module\Mail\Smtp\Source\Address
 */
class Cc extends Address {

	/**
	 * @return Address
	 */
	public function setAddress() {

		if( $this->isValid() ) {
			/** @var \PHPMailer $Extension */
			$Extension = Api::groupExtension()->unitMail()->usePHPMailer()->currentInstance()->getObject();
			$Extension->addCC( $this->Mail, $this->Name );
		}

		return $this;
	}

}
