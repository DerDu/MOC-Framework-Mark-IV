<?php
namespace MOC\MarkIV\Core\Update\GitHub\Source;

/**
 * Class Version
 *
 * @package MOC\MarkIV\Core\Update\GitHub\Source
 */
interface IVersionInterface {

	/**
	 * @return int
	 */
	public function getMinor();

	/**
	 * @param int $Patch
	 */
	public function setPatch( $Patch );

	/**
	 * @return int
	 */
	public function getBuild();

	/**
	 * @param int $Build
	 */
	public function setBuild( $Build );

	/**
	 * @param Version $Version
	 *
	 * @return int
	 */
	public function checkBehindAheadStatusOf( Version $Version );

	/**
	 * @return string
	 */
	public function getVersionString();

	/**
	 * @param int $Major
	 */
	public function setMajor( $Major );

	/**
	 * @param int $Minor
	 */
	public function setMinor( $Minor );

	/**
	 * @return int
	 */
	public function getPatch();

	/**
	 * @return int
	 */
	public function getMajor();
}

/**
 * Class Version
 *
 * @package MOC\MarkIV\Core\Update\GitHub\Source
 */
class Version implements IVersionInterface {

	/** @var int $Major */
	private $Major = 0;
	/** @var int $Minor */
	private $Minor = 0;
	/** @var int $Patch */
	private $Patch = 0;
	/** @var int $Build */
	private $Build = 0;

	/**
	 * @param string $VersionString
	 */
	function __construct( $VersionString ) {

		if( preg_match( '!([0-9]+)\.([0-9]+)\.([0-9]+)\.([0-9]+)!is', $VersionString, $Match ) ) {
			$this->Major = $Match[1];
			$this->Minor = $Match[2];
			$this->Patch = $Match[3];
			$this->Build = $Match[4];
		}
	}

	/**
	 * @param Version $Version
	 *
	 * @return int
	 */
	public function checkBehindAheadStatusOf( Version $Version ) {

		if( $this->getMajor() != $Version->getMajor() ) {
			if( $this->getMajor() < $Version->getMajor() ) {
				return 1;
			} else {
				return -1;
			}
		} else if( $this->getMinor() != $Version->getMinor() ) {
			if( $this->getMinor() < $Version->getMinor() ) {
				return 1;
			} else {
				return -1;
			}
		} else if( $this->getPatch() != $Version->getPatch() ) {
			if( $this->getPatch() < $Version->getPatch() ) {
				return 1;
			} else {
				return -1;
			}
		} else if( $this->getBuild() != $Version->getBuild() ) {
			if( $this->getBuild() < $Version->getBuild() ) {
				return 1;
			} else {
				return -1;
			}
		} else {
			return 0;
		}
	}

	/**
	 * @return int
	 */
	public function getMajor() {

		return (int)$this->Major;
	}

	/**
	 * @param int $Major
	 */
	public function setMajor( $Major ) {

		$this->Major = $Major;
	}

	/**
	 * @return int
	 */
	public function getMinor() {

		return (int)$this->Minor;
	}

	/**
	 * @param int $Minor
	 */
	public function setMinor( $Minor ) {

		$this->Minor = $Minor;
	}

	/**
	 * @return int
	 */
	public function getPatch() {

		return (int)$this->Patch;
	}

	/**
	 * @param int $Patch
	 */
	public function setPatch( $Patch ) {

		$this->Patch = $Patch;
	}

	/**
	 * @return int
	 */
	public function getBuild() {

		return (int)$this->Build;
	}

	/**
	 * @param int $Build
	 */
	public function setBuild( $Build ) {

		$this->Build = $Build;
	}

	/**
	 * @return string
	 */
	public function getVersionString() {

		return $this->Major.'.'.$this->Minor.'.'.$this->Patch.'.'.$this->Build;
	}

}
