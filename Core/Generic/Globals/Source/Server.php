<?php
namespace MOC\MarkIV\Core\Generic\Globals\Source;

class Server {

	public static $Content = array();

	function __construct() {
		if( empty( self::$Content ) ) {
			self::$Content = $_SERVER;
		}
	}

	public static function doRefresh() {
		self::$Content = $_SERVER;
	}

	public function getServerPort( $Default = null ) {
		return $this->useDefault( $this->getValue( 'SERVER_PORT' ), $Default );
	}

	public function setServerPort( $Value ) {
		$this->setValue( 'SERVER_PORT', $Value );
		return $this;
	}

	public function getServerName( $Default = null ) {
		return $this->useDefault( $this->getValue( 'SERVER_NAME' ), $Default );
	}

	public function setServerName( $Value ) {
		$this->setValue( 'SERVER_NAME', $Value );
		return $this;
	}

	private function useDefault( $Value, $Default ) {
		if( null === $Value ) {
			return $Default;
		} else {
			return $Value;
		}
	}

	private function getValue( $Index ) {
		if( isset( self::$Content[$Index] )){
			return self::$Content[$Index];
		} else {
			return null;
		}
	}

	private function setValue( $Index, $Value ) {
		return self::$Content[$Index] = $Value;
	}
}
