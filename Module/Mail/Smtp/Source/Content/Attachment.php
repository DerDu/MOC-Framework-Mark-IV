<?php
namespace MOC\MarkIV\Module\Mail\Smtp\Source\Content;

use MOC\MarkIV\Api;

/**
 * Class Attachment
 *
 * @package MOC\MarkIV\Module\Mail\Smtp\Source\Content
 */
class Attachment {

	function __construct( \MOC\MarkIV\Core\Drive\File\IApiInterface $File ) {

		/** @var \PHPMailer $Extension */
		$Extension = Api::groupExtension()->unitMail()->usePHPMailer()->currentInstance()->getObject();
		$Extension->addAttachment( $File->getLocation() );
	}

}
