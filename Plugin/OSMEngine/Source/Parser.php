<?php
namespace MOC\IV\Plugin\OSMEngine\Source;

use \MOC\IV\Core\Drive\File\IApiInterface as File;
use MOC\IV\Plugin\OSMEngine\Api\Element;

class Parser {

	/** @var null|string $OSMData */
	private $OSMData = null;

	/**
	 * @param File $OSMFile
	 */
	function __construct( File $OSMFile ) {
		$this->OSMData = simplexml_load_string( $OSMFile->getContent() );

		//var_dump( $this->OSMData );

		$Element = new Element( $this->OSMData );

		var_dump( $Element );
	}

}
