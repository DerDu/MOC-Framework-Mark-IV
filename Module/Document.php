<?php
namespace MOC\MarkIV\Module;

/**
 * Interface IDocumentInterface
 *
 * @package MOC\MarkIV\Module
 */
interface IDocumentInterface {

	/**
	 * @param \MOC\MarkIV\Core\Drive\File\IApiInterface $File
	 *
	 * @return Document\Excel\Api
	 */
	public function apiExcel( \MOC\MarkIV\Core\Drive\File\IApiInterface $File = null );
}

/**
 * Class Document
 *
 * @package MOC\MarkIV\Module
 */
class Document {

	/**
	 * @param \MOC\MarkIV\Core\Drive\File\IApiInterface $File
	 *
	 * @return Document\Excel\Api
	 */
	public function apiExcel( \MOC\MarkIV\Core\Drive\File\IApiInterface $File = null ) {

		return new Document\Excel\Api( $File );
	}
}
