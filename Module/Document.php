<?php
namespace MOC\MarkIV\Module;

use MOC\MarkIV\Core\Drive\File\IApiInterface;

/**
 * Interface IDocumentInterface
 *
 * @package MOC\MarkIV\Module
 */
interface IDocumentInterface {

	/**
	 * @param IApiInterface $File
	 *
	 * @return Document\Excel\Api
	 */
	public function apiExcel( IApiInterface $File = null );
}

/**
 * Class Document
 *
 * @package MOC\MarkIV\Module
 */
class Document {

	/**
	 * @param IApiInterface $File
	 *
	 * @return Document\Excel\Api
	 */
	public function apiExcel( IApiInterface $File = null ) {

		return new Document\Excel\Api( $File );
	}
}
