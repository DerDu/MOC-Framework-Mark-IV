<?php
namespace MOC\IV\Core\Update\GitHub\Source\Channel;

use MOC\IV\Core\Update\GitHub\Source\Config;
use MOC\IV\Core\Update\GitHub\Source\Type\Tree as TreeItem;

class Tree extends Generic {

	function __construct( Config $Config, $Identifier ) {

		parent::__construct( $Config );

		$ItemList = json_decode( $this->Config->getNetwork()->getFile( 'https://api.github.com/repos/DerDu/MOC-Framework-Mark-IV/git/trees/'.$Identifier.'?recursive=1' ) );
		foreach( (array)$ItemList->tree as $Item ) {
			if( $Item->type == 'blob' ) {
				$Item = new TreeItem( $Item );
				$this->Channel[] = $Item;
			}
		}
		krsort( $this->Channel );
	}

	/**
	 * @return TreeItem[]
	 */
	public function getList() {

		return $this->Channel;
	}

}
