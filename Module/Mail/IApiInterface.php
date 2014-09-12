<?php
namespace MOC\MarkIV\Module\Mail;

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

	public function apiAddress();

	public function apiContent();

	public function sendMail();

	public function closeConnection();
}
