<?php
namespace MOC\IV\Core\Update\GitHub\Source\Type;

/**
 * Class Release
 *
 * @package MOC\IV\Core\Update\GitHub\Source\Type
 */
class Release {

	/** @var null|string $Name */
	private $Name = null;
	/** @var null|string $Version */
	private $Version = null;
	/** @var int|null $Timestamp */
	private $Timestamp = null;
	/** @var null|bool $Draft */
	private $Draft = null;

	/**
	 * @param \stdClass $Release
	 */
	function __construct( \stdClass $Release ) {

		$this->Name = $Release->name;
		$this->Version = $Release->tag_name;
		$this->Timestamp = strtotime( $Release->published_at );

		$this->Draft = $Release->prerelease;
	}

	/**
	 * @return bool|null
	 */
	public function getDraft() {

		return $this->Draft;
	}

	/**
	 * @return null|string
	 */
	public function getName() {

		return $this->Name;
	}

	/**
	 * @return int|null
	 */
	public function getTimestamp() {

		return $this->Timestamp;
	}

	/**
	 * @return null|string
	 */
	public function getVersion() {

		return $this->Version;
	}

}
