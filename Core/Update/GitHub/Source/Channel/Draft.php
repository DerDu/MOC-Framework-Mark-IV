<?php
namespace MOC\IV\Core\Update\GitHub\Source\Channel;

use MOC\IV\Core\Update\GitHub\Source\Config;
use MOC\IV\Core\Update\GitHub\Source\Type\Release as ReleaseItem;

class Draft extends Generic {

	function __construct( Config $Config ) {

		parent::__construct( $Config );
		$ItemList = json_decode( $this->Config->getNetwork()->getFile( 'https://api.github.com/repos/DerDu/MOC-Framework-Mark-IV/releases' ) );
		foreach( (array)$ItemList as $Item ) {
			$Item = new ReleaseItem( $Item );
			if( $Item->getDraft() ) {
				$this->Channel[$Item->getTimestamp()] = $Item;
			}
		}
		krsort( $this->Channel );
	}

	public function getList() {

		return $this->Channel;
	}
}
