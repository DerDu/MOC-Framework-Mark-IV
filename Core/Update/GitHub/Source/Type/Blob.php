<?php
namespace MOC\IV\Core\Update\GitHub\Source\Type;

class Blob {

	/** @var null|string $Identifier */
	private $Identifier = null;
	/** @var null|int $Size */
	private $Size = null;
	/** @var null|string $Content */
	private $Content = null;

	/**
	 * @param \stdClass $Blob
	 */
	function __construct( \stdClass $Blob ) {

		$this->Identifier = $Blob->sha;
		$this->Size = $Blob->size;
		$this->Content = ${$Blob->encoding.'_decode'}( $Blob->content );
	}

	/**
	 * @return null|string
	 */
	public function getContent() {

		return $this->Content;
	}

	/**
	 * @return null|string
	 */
	public function getIdentifier() {

		return $this->Identifier;
	}

	/**
	 * @return int|null
	 */
	public function getSize() {

		return $this->Size;
	}
}
