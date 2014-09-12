<?php
namespace MOC\MarkIV\Extension\Excel\PHPExcel;

use MOC\MarkIV\Extension\Excel\IApiInterface;

/**
 * Class Api
 *
 * @package MOC\MarkIV\Extension\Excel\PHPExcel
 */
class Api extends \MOC\MarkIV\Core\Generic\Extension\Source\Api implements IApiInterface {

	/**
	 * Bootstrap
	 */
	function __construct() {

		require_once( '3rdParty/PHPExcel/Classes/PHPExcel.php' );
		\PHPExcel_Cell::setValueBinder( new \PHPExcel_Cell_AdvancedValueBinder() );
	}

	/**
	 * @param null|string $Identifier
	 *
	 * @return Api
	 */
	public function buildInstance( $Identifier = null ) {

		$this->createInstance( new \PHPExcel(), $Identifier );

		return $this;
	}
}
