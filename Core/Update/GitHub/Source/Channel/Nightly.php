<?php
namespace MOC\IV\Core\Update\GitHub\Source\Channel;

use MOC\IV\Core\Update\GitHub\Source\Config;
use MOC\IV\Core\Update\GitHub\Source\Type\Tag as NightlyItem;

class Nightly extends Generic {

	function __construct( Config $Config ) {

		parent::__construct( $Config );

		$ItemList = json_decode( $this->Config->getNetwork()->getFile( 'https://api.github.com/repos/DerDu/MOC-Framework-Mark-IV/tags' ) );
		foreach( (array)$ItemList as $Item ) {
			$Item = new NightlyItem( $Item );
			$this->Channel[$Item->getVersion()] = $Item;
		}
		krsort( $this->Channel );
	}

	/**
	 * @return NightlyItem[]
	 */
	public function getList() {

		return $this->Channel;
	}

	public function getBuild( $Name ) {

		return $this->Channel[$Name];
	}
}
