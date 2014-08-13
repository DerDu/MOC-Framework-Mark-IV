<?php
namespace MOC\IV\Core;

/**
 * Interface IXmlInterface
 *
 * @package MOC\IV\Core
 */
interface IXmlInterface {

	/**
	 * @param Drive\File\IApiInterface $XmlFile
	 *
	 * @return Xml\Reader\Api
	 */
	public function apiReader( Drive\File\IApiInterface $XmlFile );
}

/**
 * Class Xml
 *
 * @package MOC\IV\Core
 */
class Xml implements IXmlInterface {

	/**
	 * @param Drive\File\IApiInterface $XmlFile
	 *
	 * @return Xml\Reader\Api
	 */
	public function apiReader( Drive\File\IApiInterface $XmlFile ) {

		return new Xml\Reader\Api( $XmlFile->getContent() );
	}
}
