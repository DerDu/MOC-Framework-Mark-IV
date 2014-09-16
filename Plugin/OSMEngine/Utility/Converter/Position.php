<?php
namespace MOC\MarkIV\Plugin\OSMEngine\Utility\Converter;

/**
 * Class Position
 *
 * @package MOC\MarkIV\Plugin\OSMEngine\Utility\Converter
 */
class Position {

	/** @var int $X */
	private $X = 0;
	/** @var int $Y */
	private $Y = 0;

	/**
	 * @param int $X
	 * @param int $Y
	 */
	function __construct( $X, $Y ) {

		$this->X = $X;
		$this->Y = $Y;
	}

	/**
	 * @return int
	 */
	public function getX() {

		return $this->X;
	}

	/**
	 * @return int
	 */
	public function getY() {

		return $this->Y;
	}
}
