<?php
namespace MOC\MarkIV\Extension;

/**
 * Interface IMailInterface
 *
 * @package MOC\MarkIV\Extension
 */
interface IMailInterface
{

    /**
     * @return Mail\PHPMailer\Api
     */
    public function usePHPMailer();
}

/**
 * Class Mail
 *
 * @package MOC\MarkIV\Extension
 */
class Mail implements IMailInterface
{

    /**
     * @return Mail\PHPMailer\Api
     */
    public function usePHPMailer()
    {

        return new Mail\PHPMailer\Api();
    }
}
