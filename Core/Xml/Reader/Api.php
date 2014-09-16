<?php
namespace MOC\MarkIV\Core\Xml\Reader;

use MOC\MarkIV\Core\Xml\Reader\Source\Node;
use MOC\MarkIV\Core\Xml\Reader\Source\Parser;
use MOC\MarkIV\Core\Xml\Reader\Source\Tokenizer;

/**
 * Interface IApiInterface
 *
 * @package MOC\MarkIV\Core\Xml\Reader
 */
interface IApiInterface {

}

/**
 * Class Api
 *
 * @package MOC\MarkIV\Core\Xml\Reader
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
	 * @return Node|null
	 */
	public function parseContent() {

		$Instance = new Parser( new Tokenizer( $this->XmlContent ) );

		return $Instance->getResult();
	}

	/**
	 * @param \SimpleXMLElement $Xml
	 *
	 * @codeCoverageIgnore
	 * @return Node
	 */
	private function parseSimpleXml( \SimpleXMLElement $Xml ) {

		$Node = new Node();
		$Node->setName( $Xml->getName() );
		$Object = get_object_vars( $Xml );

		if( isset( $Object['@attributes'] ) ) {
			array_walk( $Object['@attributes'], function ( $Value, $Name, Node $Node ) {

				$Node->setAttribute( $Name, $Value );
			}, $Node );
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
