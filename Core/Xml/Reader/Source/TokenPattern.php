<?php
namespace MOC\IV\Core\Xml\Reader\Source;

abstract class TokenPattern extends TokenType {

	private $PatternTagOpen = '!^[^\!/].*?[^/]$!is';
	private $PatternTagClose = '!^/.*?!is';
	private $PatternTagShort = '!^[^\!].*?/$!is';
	private $PatternTagCDATA = '!^\!\[CDATA.*?\]\]$!is';
	private $PatternTagComment = '!^\![^\[].*?--$!is';

	/**
	 * @param $Content
	 */
	protected function determineType( &$Content ) {

		if( preg_match( $this->PatternTagOpen, $Content ) ) {
			$this->Type = self::TYPE_OPEN;
		} else
			if( preg_match( $this->PatternTagClose, $Content ) ) {
				$this->Type = self::TYPE_CLOSE;
			} else
				if( preg_match( $this->PatternTagShort, $Content ) ) {
					$this->Type = self::TYPE_SHORT;
				} else
					if( preg_match( $this->PatternTagCDATA, $Content ) ) {
						$this->Type = self::TYPE_CDATA;
					} else
						if( preg_match( $this->PatternTagComment, $Content ) ) {
							$this->Type = self::TYPE_COMMENT;
						}
	}
}
