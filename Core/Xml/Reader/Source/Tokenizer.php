<?php
namespace MOC\IV\Core\Xml\Reader\Source;

class Tokenizer extends Mask {

	private $Content = '';
	private $PatternToken = '!(?<=<)[^?][^<>]*?(?=>)!is';
	private $Result = array();

	function __construct( $Content ) {

		$this->encodePayload( $this->Content, self::MASK_COMMENT );
		$this->encodePayload( $this->Content, self::MASK_CDATA );
		preg_match_all( $this->PatternToken, $this->Content, $this->Result, PREG_OFFSET_CAPTURE );
		$this->Result = array_map( function ( $Content ) {

			return new Token( $Content );
		}, $this->Result[0] );

	}

	/**
	 * @return array
	 */
	public function getResult() {

		return $this->Result;
	}

	/**
	 * @return string
	 */
	public function getContent() {

		return $this->Content;
	}

}
