<?php
namespace MOC\MarkIV\Api;

use MOC\MarkIV\Extension\Database;
use MOC\MarkIV\Extension\Documentation;
use MOC\MarkIV\Extension\Excel;
use MOC\MarkIV\Extension\Mail;

/**
 * Interface IExtensionInterface
 *
 * @package MOC\MarkIV\Api
 */
interface IExtensionInterface
{

    /**
     * @return Documentation
     */
    public function unitDocumentation();

    /**
     * @return Documentation
     */
    public function unitDatabase();

    /**
     * @return Mail
     */
    public function unitMail();

    /**
     * @return Excel
     */
    public function unitExcel();
}

/**
 * Class Extension
 *
 * @package MOC\MarkIV\Api
 */
class Extension implements IExtensionInterface
{

    /**
     * @return Documentation
     */
    public function unitDocumentation()
    {

        return new Documentation();
    }

    /**
     * @return Database
     */
    public function unitDatabase()
    {

        return new Database();
    }

    /**
     * @return Mail
     */
    public function unitMail()
    {

        return new Mail();
    }

    /**
     * @return Excel
     */
    public function unitExcel()
    {

        return new Excel();
    }
}
