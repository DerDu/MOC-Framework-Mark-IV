<?php
namespace MOC\MarkIV\Core;

/**
 * Interface ICacheInterface
 *
 * @package MOC\MarkIV\Core
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
 * @package MOC\MarkIV\Core
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
