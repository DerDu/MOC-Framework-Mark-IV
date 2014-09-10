<?php
namespace MOC\MarkIV\Plugin;

use MOC\MarkIV\Api;
use \MOC\MarkIV\Core\Drive\File\IApiInterface as File;
use MOC\MarkIV\Core\Xml\Reader\Source\Node;
use MOC\MarkIV\Plugin\OSMEngine\Api\Element;
use MOC\MarkIV\Plugin\OSMEngine\Source\Parser;

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
