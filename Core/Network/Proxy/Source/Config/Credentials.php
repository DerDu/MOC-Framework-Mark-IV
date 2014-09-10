<?php
namespace MOC\MarkIV\Core\Network\Proxy\Source\Config;

/**
 * Class Credentials
 *
 * @package MOC\MarkIV\Core\Network\Proxy\Source\Config
 */
class Credentials {

	/** @var null|string $Username */
	private $Username = null;
	/** @var null|string $Password */
	private $Password = null;

	/**
	 * @param string $UserName
	 * @param string $Password
	 */
	function __construct( $UserName, $Password ) {

		$this->setUsername( $UserName );
		$this->setPassword( $Password );
	}

	/**
	 * @param null|string $Password
	 *
	 * @return Credentials
	 */
	public function setPassword( $Password ) {

		$this->Password = $Password;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getPassword() {

		return $this->Password;
	}

	/**
	 * @param null|string $Username
	 *
	 * @return Credentials
	 */
	public function setUsername( $Username ) {

		$this->Username = $Username;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getUsername() {

		return $this->Username;
	}
}
