<?php
namespace MOC\MarkIV\Module\Mail;

use MOC\MarkIV\Module\Mail\Smtp\Api\IAddressInterface;
use MOC\MarkIV\Module\Mail\Smtp\Api\IContentInterface;

/**
 * Interface IApiInterface
 *
 * @package MOC\MarkIV\Module\Mail
 */
interface IApiInterface {

	/**
	 * @param string $Host
	 * @param string $User
	 * @param string $Password
	 * @param int    $Port
	 *
	 * @return IApiInterface
	 */
	public function openConnection( $Host, $User, $Password, $Port = 25 );

	/**
	 * @return IAddressInterface
	 */
	public function apiAddress();

	/**
	 * @return IContentInterface
	 */
	public function apiContent();

	/**
	 * @return IApiInterface
	 */
	public function sendMail();

	/**
	 * @return IApiInterface
	 */
	public function closeConnection();
}
