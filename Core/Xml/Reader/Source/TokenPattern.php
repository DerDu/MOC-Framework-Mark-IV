<?php
namespace MOC\MarkIV\Core\Xml\Reader\Source;

/**
 * Class TokenPattern
 *
 * @package MOC\MarkIV\Core\Xml\Reader\Source
 */
abstract class TokenPattern extends TokenType {

	private $PatternTagOpen = '!^[^\!/].*?[^/]$!is';
	private $PatternTagClose = '!^/.*?!is';
	private $PatternTagShort = '!^[^\!].*?/$!is';
	private $PatternTagCDATA = '!^\!\[CDATA.*?\]\]$!is';
	private $PatternTagComment = '!^\![^\[].*?--$!is';

	/**
	 * @param $Content
	 */
	protected function determineType( $Content ) {

		if( $Content[0] == '/' ) {
			$this->Type = self::TYPE_CLOSE;
		} else
			if( $Content[strlen( $Content ) - 1] == '/' ) {
				$this->Type = self::TYPE_SHORT;
			} else
				if( strpos( $Content, '/' ) !== 0 ) {
					$this->Type = self::TYPE_OPEN;
				} else
					if( preg_match( $this->PatternTagCDATA, $Content ) ) {
						$this->Type = self::TYPE_CDATA;
					} else
						if( preg_match( $this->PatternTagComment, $Content ) ) {
							$this->Type = self::TYPE_COMMENT;
						}
	}
}
