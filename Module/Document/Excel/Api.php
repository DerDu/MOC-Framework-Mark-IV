<?php
namespace MOC\MarkIV\Module\Document\Excel;

use MOC\MarkIV\Module\Document\IApiInterface;

class Api implements IApiInterface {

	const FILE_TYPE_EXCEL2007 = 'xlsx';
	const FILE_TYPE_EXCEL5 = 'xls';
	const FILE_TYPE_CSV = 'csv';

	function __construct( \MOC\MarkIV\Core\Drive\File\IApiInterface $File = null ) {

		$Extension = \MOC\MarkIV\Api::groupExtension()->unitExcel()->usePHPExcel()->currentInstance();
		if( null === $Extension ) {
			\MOC\MarkIV\Api::groupExtension()->unitExcel()->usePHPExcel()->buildInstance();
		}

		if( null !== $File ) {
			$this->openDocument( $File );
		}
	}

	public function openDocument( \MOC\MarkIV\Core\Drive\File\IApiInterface $File ) {

		$Extension = \MOC\MarkIV\Api::groupExtension()->unitExcel()->usePHPExcel()->currentInstance();
		$Extension->setObject(
			\PHPExcel_IOFactory::load( $File->getLocation() )
		);

		return $this;
	}

	public function closeDocument( \MOC\MarkIV\Core\Drive\File\IApiInterface $File, $Type = self::FILE_TYPE_EXCEL2007 ) {

		/** @var \PHPExcel $Extension */
		$Extension = \MOC\MarkIV\Api::groupExtension()->unitExcel()->usePHPExcel()->currentInstance()->getObject();
		switch( $Type ) {
			case self::FILE_TYPE_EXCEL2007:
			{
				$Writer = new \PHPExcel_Writer_Excel2007( $Extension );
				$Writer->save( $File->getLocation() );
				break;
			}
			case self::FILE_TYPE_EXCEL5:
			{
				$Writer = new \PHPExcel_Writer_Excel5( $Extension );
				$Writer->save( $File->getLocation() );
				break;
			}
			case self::FILE_TYPE_CSV:
			{
				$Writer = new \PHPExcel_Writer_CSV( $Extension );
				$Writer->save( $File->getLocation() );
				break;
			}
		}
		\MOC\MarkIV\Api::groupExtension()->unitExcel()->usePHPExcel()->destroyInstance();

		return $this;
	}

	public function apiPage() {
	}

	public function apiWorksheet() {
	}

	public function apiCell() {
	}
}
