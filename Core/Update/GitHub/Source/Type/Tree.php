<?php
namespace MOC\IV\Core\Update\GitHub\Source\Type;

use MOC\IV\Core\Update\GitHub\Source\Config;

class Tree {
	/** @var Config|null $Config */
	private $Config = null;
	/** @var null|string $Identifier */
	private $Identifier = null;
	/** @var null|int $Size */
	private $Size = null;
	/** @var null|string $Location */
	private $Location = null;

	/**
	 * @param \stdClass $Tree
	 * @param Config    $Config
	 */
	function __construct( \stdClass $Tree, Config $Config ) {

		$this->Config = $Config;
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

	/**
	 * @return Config|null
	 */
	public function getConfig() {
		return $this->Config;
	}
}
