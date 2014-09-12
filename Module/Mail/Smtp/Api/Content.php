<?php
namespace MOC\MarkIV\Module\Mail\Smtp\Api;

use MOC\MarkIV\Module\Mail\Smtp\Source\Content\Attachment;
use MOC\MarkIV\Module\Mail\Smtp\Source\Content\Body;
use MOC\MarkIV\Module\Mail\Smtp\Source\Content\Subject;

/**
 * Class Content
 *
 * @package MOC\MarkIV\Module\Mail\Smtp\Api
 */
class Content {

	/**
	 * @param string $Value
	 *
	 * @return Subject
	 */
	public function buildSubject( $Value ) {

		return new Subject( $Value );
	}

	/**
	 * @param string $Value
	 * @param bool   $asHtml
	 *
	 * @return Body
	 */
	public function buildBody( $Value, $asHtml = true ) {

		return new Body( $Value, $asHtml );
	}

	/**
	 * @param \MOC\MarkIV\Core\Drive\File\IApiInterface $File
	 *
	 * @return Attachment
	 */
	public function buildAttachment( \MOC\MarkIV\Core\Drive\File\IApiInterface $File ) {

		return new Attachment( $File );
	}
}
