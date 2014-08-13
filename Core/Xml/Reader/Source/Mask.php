<?php
namespace MOC\IV\Core\Xml\Reader\Source;

abstract class Mask {

	const MASK_COMMENT = '!(?<=\!--).*?(?=//-->)!is';
	const MASK_CDATA = '!(?<=\!\[CDATA\[).*?(?=\]\]>)!is';

	/**
	 * @param string $Payload
	 * @param string $Pattern
	 *
	 * @return mixed
	 */
	protected function encodePayload( $Payload, $Pattern ) {

		return preg_replace_callback( $Pattern, array( $this, 'encodeMethod' ), $Payload );
	}

	/**
	 * @param Node   $Node
	 * @param string $Pattern
	 */
	protected function decodePayload( Node &$Node, $Pattern ) {

		$Match = array();
		preg_match( $Pattern, $Node->getContent(), $Match );
		$Node->setContent( $this->decodeMethod( $Match[0] ) );
	}

	/**
	 * @param $Payload
	 *
	 * @return string
	 */
	private function decodeMethod( $Payload ) {

		return base64_decode( $Payload );
	}

	/**
	 * @param $Payload
	 *
	 * @return string
	 */
	private function encodeMethod( $Payload ) {

		return base64_encode( $Payload[0] );
	}
}
