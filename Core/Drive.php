<?php
namespace MOC\IV\Core;

use MOC\IV\Core\Drive\Directory\Utility\Check;

/**
 * Interface IDrive
 *
 * @package MOC\IV\Core
 */
interface IDriveInterface {

	/**
	 * @param string $Location
	 *
	 * @return Drive\Directory\Api
	 */
	public function apiDirectory( $Location );

	/**
	 * @param string $Location
	 *
	 * @return Drive\File\Api
	 */
	public function apiFile( $Location );

	/**
	 * @return Drive\Directory\Api
	 */
	public function getRootDirectory();

	/**
	 * @return Drive\Directory\Api
	 */
	public function getCurrentDirectory();
}

/**
 * Class Drive
 *
 * @package MOC\IV\Core
 */
class Drive implements IDriveInterface {

	/**
	 * @param string $Location
	 *
	 * @return Drive\File\Api
	 */
	public function apiFile( $Location ) {

		return new Drive\File\Api( $Location );
	}

	/**
	 * @param string $Location
	 *
	 * @return Drive\Directory\Api
	 */
	public function apiDirectory( $Location ) {

		return new Drive\Directory\Api( $Location );
	}

	/**
	 * @return Drive\Directory\Api
	 */
	public function getRootDirectory() {

		return Check::getRootDirectory();
	}

	/**
	 * @return Drive\Directory\Api
	 */
	public function getCurrentDirectory() {

		return Check::getCurrentDirectory();
	}

}
