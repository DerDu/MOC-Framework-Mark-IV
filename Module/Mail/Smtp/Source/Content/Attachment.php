<?php
namespace MOC\MarkIV\Module\Mail\Smtp\Source\Content;

use MOC\MarkIV\Api;
use MOC\MarkIV\Core\Drive\File\IApiInterface;

/**
 * Class Attachment
 *
 * @package MOC\MarkIV\Module\Mail\Smtp\Source\Content
 */
class Attachment {

	/**
	 * @param IApiInterface $File
	 *
	 * @throws \Exception
	 * @throws \phpmailerException
	 */
	function __construct( IApiInterface $File ) {

		/** @var \PHPMailer $Extension */
		$Extension = Api::groupExtension()->unitMail()->usePHPMailer()->currentInstance()->getObject();
		$Extension->addAttachment( $File->getLocation() );
	}

}
