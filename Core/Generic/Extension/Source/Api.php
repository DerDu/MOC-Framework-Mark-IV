<?php
namespace MOC\MarkIV\Core\Generic\Extension\Source;

/**
 * Class Api
 *
 * @package MOC\MarkIV\Core\Generic\Extension\Source
 */
abstract class Api {

	/** @var null|Instance $Instance */
	protected static $Instance = null;
	/** @var Instance[] $InstanceQueue */
	protected static $InstanceQueue = array();

	/**
	 * Bootstrap
	 */
	abstract function __construct();

	/**
	 * @param object      $Extension
	 * @param null|string $Identifier
	 *
	 * @return Api
	 */
	protected function buildInstance( $Extension, $Identifier = null ) {

		$Instance = new Instance( $Extension, $Identifier );
		if( null !== self::$Instance ) {
			self::$InstanceQueue[self::$Instance->getIdentifier()] = self::$Instance;
		}
		self::$Instance = $Instance;

		return $this;
	}

	/**
	 * @return null|Instance
	 */
	public function currentInstance() {

		return self::$Instance;
	}

	/**
	 * @param $Identifier
	 *
	 * @return Api
	 */
	public function selectInstance( $Identifier ) {

		if( null !== self::$Instance ) {
			self::$InstanceQueue[self::$Instance->getIdentifier()] = self::$Instance;
		}
		self::$Instance = self::$InstanceQueue[$Identifier];

		return $this;
	}

	/**
	 * @return Api
	 */
	public function destroyInstance() {

		unset( self::$InstanceQueue[self::$Instance->getIdentifier()] );
		self::$Instance = null;

		return $this;
	}
}
