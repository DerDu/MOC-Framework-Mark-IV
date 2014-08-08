<?php
namespace MOC\IV\Core;

/**
 * Interface ICacheInterface
 *
 * @package MOC\IV\Core
 */
interface ICacheInterface {
	/**
	 * @param int    $Timeout
	 * @param string $Group
	 * @param string $Extension
	 *
	 * @return Cache\File\Api
	 */
	public function apiFile( $Timeout = 60, $Group = '', $Extension = 'cache' );
}

/**
 * Class Cache
 *
 * @package MOC\IV\Core
 */
class Cache implements ICacheInterface {

	/**
	 * @param int    $Timeout
	 * @param string $Group
	 * @param string $Extension
	 *
	 * @return Cache\File\Api
	 */
	public function apiFile( $Timeout = 60, $Group = '', $Extension = 'cache' ) {

		return new Cache\File\Api( $Timeout, $Group, $Extension );
	}

}
