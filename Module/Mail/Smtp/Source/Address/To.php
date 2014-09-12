<?php
namespace MOC\MarkIV\Module\Mail\Smtp\Source\Address;

use MOC\MarkIV\Api;
use MOC\MarkIV\Module\Mail\Smtp\Source\Address;

/**
 * Class To
 *
 * @package MOC\MarkIV\Module\Mail\Smtp\Source\Address
 */
class To extends Address {

	/**
	 * @return Address
	 */
	public function setAddress() {

		if( $this->isValid() ) {
			/** @var \PHPMailer $Extension */
			$Extension = Api::groupExtension()->unitMail()->usePHPMailer()->currentInstance()->getObject();
			$Extension->addAddress( $this->Mail, $this->Name );
		}

		return $this;
	}

}
