<?php
namespace MOC\MarkIV\Plugin\OSMEngine\Source;

use \MOC\MarkIV\Core\Drive\File\IApiInterface as File;
use MOC\MarkIV\Plugin\OSMEngine\Api\Element;

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
