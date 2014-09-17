<?php
namespace MOC\MarkIV\Extension;

/**
 * Interface IExcelInterface
 *
 * @package MOC\MarkIV\Extension
 */
interface IExcelInterface
{

    /**
     * @return Excel\PHPExcel\Api
     */
    public function usePHPExcel();
}

/**
 * Class Excel
 *
 * @package MOC\MarkIV\Extension
 */
class Excel implements IExcelInterface
{

    /**
     * @return Excel\PHPExcel\Api
     */
    public function usePHPExcel()
    {

        return new Excel\PHPExcel\Api();
    }
}
