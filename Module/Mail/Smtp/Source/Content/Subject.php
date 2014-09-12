<?php
namespace MOC\MarkIV\Module\Mail\Smtp\Source\Content;

use MOC\MarkIV\Api;

/**
 * Class Subject
 *
 * @package MOC\MarkIV\Module\Mail\Smtp\Source\Content
 */
class Subject {

	/**
	 * @param string $Value
	 */
	function __construct( $Value ) {

		/** @var \PHPMailer $Extension */
		$Extension = Api::groupExtension()->unitMail()->usePHPMailer()->currentInstance()->getObject();
		$Extension->Subject = $Value;
	}

}
