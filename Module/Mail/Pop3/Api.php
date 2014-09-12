<?php
namespace MOC\MarkIV\Module\Mail\Pop3;

use MOC\MarkIV\Module\Mail\IApiInterface;

/**
 * Class Api
 *
 * @package MOC\MarkIV\Module\Mail\Pop3
 */
class Api implements IApiInterface {

	/**
	 * @param string $Host
	 * @param string $User
	 * @param string $Password
	 * @param int    $Port
	 *
	 * @return IApiInterface
	 */
	public function openConnection( $Host, $User, $Password, $Port = 25 ) {
		// TODO: Implement openConnection() method.
	}

	public function apiAddress() {
		// TODO: Implement apiAddress() method.
	}

	public function apiContent() {
		// TODO: Implement apiContent() method.
	}

	public function sendMail() {
		// TODO: Implement sendMail() method.
	}

	public function closeConnection() {
		// TODO: Implement closeConnection() method.
	}

}
