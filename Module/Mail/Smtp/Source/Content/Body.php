<?php
namespace MOC\MarkIV\Module\Mail\Smtp\Source\Content;

use MOC\MarkIV\Api;

/**
 * Class Body
 *
 * @package MOC\MarkIV\Module\Mail\Smtp\Source\Content
 */
class Body {

	/**
	 * @param string $Value
	 * @param bool   $asHtml
	 */
	function __construct( $Value = '', $asHtml = true ) {

		/** @var \PHPMailer $Extension */
		$Extension = Api::groupExtension()->unitMail()->usePHPMailer()->currentInstance()->getObject();
		$Extension->isHTML( $asHtml );
		$Extension->AltBody = $Value;
		$Extension->msgHTML( $Value );
	}

}
