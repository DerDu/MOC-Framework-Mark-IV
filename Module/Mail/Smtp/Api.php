<?php
namespace MOC\MarkIV\Module\Mail\Smtp;

use MOC\MarkIV\Module\Mail\IApiInterface;

/**
 * Class Api
 *
 * @package MOC\MarkIV\Module\Mail\Smtp
 */
class Api implements IApiInterface
{

    function __construct()
    {

        $Extension = \MOC\MarkIV\Api::groupExtension()->unitMail()->usePHPMailer()->currentInstance();
        if (null === $Extension) {
            \MOC\MarkIV\Api::groupExtension()->unitMail()->usePHPMailer()->buildInstance();
        }
    }

    /**
     * @param string $Host
     * @param string $User
     * @param string $Password
     * @param int    $Port
     *
     * @return IApiInterface
     */
    public function openConnection( $Host, $User, $Password, $Port = 25 )
    {

        $Extension = $this->prepareConnection( $Host, $User, $Password, $Port );
        $Extension->isSMTP();

        return $this;
    }

    /**
     * @param string $Host
     * @param string $User
     * @param string $Password
     * @param int    $Port
     *
     * @return \PHPMailer
     */
    protected function prepareConnection( $Host, $User, $Password, $Port = 25 )
    {

        /** @var \PHPMailer $Extension */
        $Extension = \MOC\MarkIV\Api::groupExtension()->unitMail()->usePHPMailer()->currentInstance()->getObject();
        $Extension->CharSet = 'utf-8';
        $Extension->Encoding = 'quoted-printable';
        $Extension->SMTPAuth = true;
        $Extension->Host = $Host;
        $Extension->Username = $User;
        $Extension->Password = $Password;
        $Extension->Port = $Port;

        return $Extension;
    }

    /**
     * @return Api\IAddressInterface
     */
    public function apiAddress()
    {

        return new Api\Address();
    }

    /**
     * @return Api\Content
     */
    public function apiContent()
    {

        return new Api\Content();
    }

    /**
     * @return IApiInterface
     */
    public function sendMail()
    {

        /** @var \PHPMailer $Extension */
        $Extension = \MOC\MarkIV\Api::groupExtension()->unitMail()->usePHPMailer()->currentInstance()->getObject();
        $Extension->send();

        return $this;
    }

    /**
     * @return IApiInterface
     */
    public function closeConnection()
    {

        return $this;
    }

}
