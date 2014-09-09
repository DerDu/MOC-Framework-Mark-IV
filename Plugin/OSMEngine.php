<?php
namespace MOC\IV\Plugin;

use MOC\IV\Api;
use \MOC\IV\Core\Drive\File\IApiInterface as File;
use MOC\IV\Core\Xml\Reader\Source\Node;
use MOC\IV\Plugin\OSMEngine\Api\Element;
use MOC\IV\Plugin\OSMEngine\Source\Parser;

interface IOSMEngineInterface {

}

class OSMEngine implements IOSMEngineInterface {

	public function apiParser( File $OSMFile ) {

		return new Parser( $OSMFile );
	}

	public function apiElement( Node $OSMElement ) {
		return new Element( $OSMElement );
	}

}
