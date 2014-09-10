<?php
namespace MOC\MarkIV\Plugin;

use MOC\MarkIV\Core\Drive\File\IApiInterface as File;
use MOC\MarkIV\Core\Xml\Reader\Source\Node;
use MOC\MarkIV\Plugin\OSMEngine\Api\Element;
use MOC\MarkIV\Plugin\OSMEngine\Source\Parser;

/**
 * Interface IOSMEngineInterface
 *
 * @package MOC\MarkIV\Plugin
 */
interface IOSMEngineInterface {

	/**
	 * @param File $OSMFile
	 *
	 * @return Parser
	 */
	public function apiParser( File $OSMFile );

	/**
	 * @param Node $OSMElement
	 *
	 * @return Element
	 */
	public function apiElement( Node $OSMElement );
}

/**
 * Class OSMEngine
 *
 * @package MOC\MarkIV\Plugin
 */
class OSMEngine implements IOSMEngineInterface {

	/**
	 * @param File $OSMFile
	 *
	 * @return Parser
	 */
	public function apiParser( File $OSMFile ) {

		return new Parser( $OSMFile );
	}

	/**
	 * @param Node $OSMElement
	 *
	 * @return Element
	 */
	public function apiElement( Node $OSMElement ) {

		return new Element( $OSMElement );
	}

}
