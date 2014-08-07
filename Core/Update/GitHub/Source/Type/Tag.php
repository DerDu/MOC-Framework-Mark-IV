<?php
namespace MOC\IV\Core\Update\GitHub\Source\Type;

/**
 * Class Tag
 *
 * @package MOC\IV\Core\Update\GitHub\Source\Type
 */
class Tag {

	/** @var null|string $Version */
	private $Version = null;
	/** @var null|string $Identifier */
	private $Identifier = null;

	/**
	 * @param \stdClass $Tag
	 */
	function __construct( \stdClass $Tag ) {

		$this->Version = $Tag->name;
		$this->Identifier = $Tag->commit->sha;
	}

	/**
	 * @return null|string
	 */
	public function getVersion() {

		return $this->Version;
	}

	/**
	 * @return null|string
	 */
	public function getIdentifier() {

		return $this->Identifier;
	}

}
