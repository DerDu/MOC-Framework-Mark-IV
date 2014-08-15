<?php
namespace MOC\IV\Core\Xml\Reader;

use MOC\IV\Core\Xml\Reader\Source\Node;
use MOC\IV\Core\Xml\Reader\Source\Parser;
use MOC\IV\Core\Xml\Reader\Source\Token;
use MOC\IV\Core\Xml\Reader\Source\Tokenizer;

/**
 * Interface IApiInterface
 *
 * @package MOC\IV\Core\Xml\Reader
 */
interface IApiInterface {

}

/**
 * Class Api
 *
 * @package MOC\IV\Core\Xml\Reader
 */
class Api implements IApiInterface {

	/** @var string $XmlContent */
	private $XmlContent = '';

	/**
	 * @param string $XmlContent
	 */
	function __construct( $XmlContent ) {

		$this->XmlContent = $XmlContent;
	}

	/**
	 * @return Source\Node|null
	 */
	public function parseContent() {
/*
		if( function_exists( 'simplexml_load_string' ) ) {
			$Xml = simplexml_load_string( $this->XmlContent );

			return $this->parseSimpleXml( $Xml );
		}
*/
		$Instance = new Parser( new Tokenizer( $this->XmlContent ) );

		return $Instance->getResult();
	}

	private function parseSimpleXml( \SimpleXMLElement $Xml ) {

		$Node = new Node();
		$Node->setName( $Xml->getName() );
		$Object = get_object_vars( $Xml );

		if( isset( $Object['@attributes'] ) ) {
			array_walk( $Object['@attributes'], function( $Value, $Name, Node $Node ){ $Node->setAttribute( $Name, $Value ); }, $Node );
			unset( $Object['@attributes'] );
		}

		if( count( $Object ) > 0 ) {
			$Object = new \ArrayIterator( $Object );
			foreach( $Object as $Children ) {
				if( is_object( $Children ) ) {
					$Node->addChild( $this->parseSimpleXml( $Children ) );
				} else {
					$Children = new \ArrayIterator( $Children );
					foreach( $Children as $Xml ) {
						$Node->addChild( $this->parseSimpleXml( $Xml ) );
					}
				}
			}
		} else {
			$Node->setContent( $Xml->__toString() );
		}

		return $Node;
	}

}
