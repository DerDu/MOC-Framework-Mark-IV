<?php
namespace MOC\IV\Core\Update\GitHub\Source\Type;

class Blob {

	/** @var null|string $Identifier */
	private $Identifier = null;
	/** @var null|int $Size */
	private $Size = null;
	/** @var null|string $Location */
	private $Location = null;
	/** @var null|string $Content */
	private $Content = null;

	function __construct( Tree $Tree ) {

		$this->Identifier = $Tree->getIdentifier();
		$this->Size = $Tree->getSize();
		$this->Location = $Tree->getLocation();

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

	/**
	 * @return null|string
	 */
	public function getLocation() {
		return $this->Location;
	}
}
