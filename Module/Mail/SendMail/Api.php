<?php
namespace MOC\MarkIV\Module\Mail\SendMail;

use MOC\MarkIV\Module\Mail\IApiInterface;

/**
 * Class Api
 *
 * @package MOC\MarkIV\Module\Mail\SendMail
 */
class Api extends \MOC\MarkIV\Module\Mail\Smtp\Api implements IApiInterface
{

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
        $Extension->isSendmail();

        return $this;
    }

}
