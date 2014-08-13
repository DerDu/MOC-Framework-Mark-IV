<?php
namespace MOC\IV\Core\Xml\Reader;

use MOC\IV\Core\Xml\Reader\Source\Parser;
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

		$Instance = new Parser( new Tokenizer( $this->XmlContent ) );
		return $Instance->getResult();
	}

}
