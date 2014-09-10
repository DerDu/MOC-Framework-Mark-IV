<?php
namespace MOC\MarkIV\Core\Network\Proxy\Source\Config;

/**
 * Class Server
 *
 * @package MOC\MarkIV\Core\Network\Proxy\Source\Config
 */
class Server {

	/** @var null|string $Host */
	private $Host = null;
	/** @var null|string $Port */
	private $Port = null;

	/**
	 * @param string $Host
	 * @param string $Port
	 */
	function __construct( $Host, $Port ) {

		$this->setHost( $Host );
		$this->setPort( $Port );
	}

	/**
	 * @param null|string $Port
	 *
	 * @return Server
	 */
	public function setPort( $Port ) {

		$this->Port = (integer)$Port;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getPort() {

		return $this->Port;
	}

	/**
	 * @param null|string $Host
	 *
	 * @return Server
	 */
	public function setHost( $Host ) {

		$this->Host = $Host;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getHost() {

		return $this->Host;
	}
}
