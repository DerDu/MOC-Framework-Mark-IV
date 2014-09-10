<?php
namespace MOC\MarkIV\Core\Update\GitHub\Source\Type;

/**
 * Class Tree
 *
 * @package MOC\MarkIV\Core\Update\GitHub\Source\Type
 */
class Tree {

	/** @var Blob[] $BlobList */
	private $BlobList = array();

	/**
	 * @param \stdClass $Tree
	 */
	function __construct( \stdClass $Tree ) {

		foreach( (array)$Tree->tree as $TreeItem ) {
			if( $TreeItem->type == 'blob' ) {
				array_push( $this->BlobList, new Blob( $TreeItem ) );
			}
		}
	}

	/**
	 * @return Blob[]
	 */
	public function getBlobList() {

		return $this->BlobList;
	}

}
