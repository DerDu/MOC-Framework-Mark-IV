<?php
namespace MOC\MarkIV\Module;

/**
 * Interface IMailInterface
 *
 * @package MOC\MarkIV\Module
 */
interface IMailInterface
{

    /**
     * @return Mail\Smtp\Api
     */
    public function apiSmtp();

    /**
     * @return Mail\Pop3\Api
     */
    public function apiPop3();

    /**
     * @return Mail\QMail\Api
     */
    public function apiQMail();

    /**
     * @return Mail\SendMail\Api
     */
    public function apiSendMail();
}

/**
 * Class Mail
 *
 * @package MOC\MarkIV\Module
 */
class Mail
{

    /**
     * @return Mail\Smtp\Api
     */
    public function apiSmtp()
    {

        return new Mail\Smtp\Api();
    }

    /**
     * @return Mail\Pop3\Api
     */
    public function apiPop3()
    {

        return new Mail\Pop3\Api();
    }

    /**
     * @return Mail\QMail\Api
     */
    public function apiQMail()
    {

        return new Mail\QMail\Api();
    }

    /**
     * @return Mail\SendMail\Api
     */
    public function apiSendMail()
    {

        return new Mail\SendMail\Api();
    }
}
