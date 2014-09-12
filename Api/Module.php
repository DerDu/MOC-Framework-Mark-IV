<?php
namespace MOC\MarkIV\Api;

use MOC\MarkIV\Module\Document;
use MOC\MarkIV\Module\Encoding;
use MOC\MarkIV\Module\Mail;

/**
 * Interface IModuleInterface
 *
 * @package MOC\MarkIV\Api
 */
interface IModuleInterface {

	/**
	 * @return Encoding
	 */
	public function unitEncoding();

	/**
	 * @return Document
	 */
	public function unitDocument();

	/**
	 * @return Mail
	 */
	public function unitMail();
}

/**
 * Class Module
 *
 * @package MOC\MarkIV\Api
 */
class Module implements IModuleInterface {

	/**
	 * @return Encoding
	 */
	public function unitEncoding() {

		return new Encoding();
	}

	/**
	 * @return Document
	 */
	public function unitDocument() {

		return new Document();
	}

	/**
	 * @return Mail
	 */
	public function unitMail() {

		return new Mail();
	}
}
