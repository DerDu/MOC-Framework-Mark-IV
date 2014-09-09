<?php
namespace MOC\IV\Core;

use MOC\IV\Api;

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

		$Cache = Api::groupCore()->unitCache()->apiFile( 3600, __CLASS__, 'object' );
		if( false === ( $Reader = $Cache->getCacheData( $XmlFile->getHash() ) ) ) {
			$Reader = new Xml\Reader\Api( $XmlFile->getContent() );
			$Cache->setCacheData( $Reader, $XmlFile->getHash() );
		}

		return $Reader;
	}
}
