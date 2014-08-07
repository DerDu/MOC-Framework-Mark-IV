<?php
namespace MOC\IV\Core\Update\GitHub\Source\Channel;

use MOC\IV\Core\Update\GitHub\Source\Config;

abstract class Generic {

	protected $Config = null;
	protected $Channel = array();

	function __construct( Config $Config ) {

		$this->Config = $Config;
	}

	abstract public function getList();
}
