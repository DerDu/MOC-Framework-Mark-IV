<?php
namespace MOC\IV\Core\Update\GitHub\Source\Type;

class Tree {

	/** @var null|string $Identifier */
	private $Identifier = null;
	/** @var null|int $Size */
	private $Size = null;
	/** @var null|string $Location */
	private $Location = null;

	/**
	 * @param \stdClass $Tree
	 */
	function __construct( \stdClass $Tree ) {

		$this->Identifier = $Tree->sha;
		$this->Size = $Tree->size;
		$this->Location = $Tree->path;
	}

	/**
	 * @return null|string
	 */
	public function getLocation() {

		return $this->Location;
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
