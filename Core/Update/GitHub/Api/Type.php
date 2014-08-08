<?php
namespace MOC\IV\Core\Update\GitHub\Api;

use MOC\IV\Core\Update\GitHub\Source\Type\Release;
use MOC\IV\Core\Update\GitHub\Source\Type\Tag;
use MOC\IV\Core\Update\GitHub\Source\Type\Tree;
use MOC\IV\Core\Update\GitHub\Source\Type\Blob;
use MOC\IV\Core\Update\GitHub\Source\Type\Data;

interface ITypeInterface {

	/**
	 * @param \stdClass $Item
	 *
	 * @return Release
	 */
	public function buildRelease( \stdClass $Item );

	/**
	 * @param \stdClass $Item
	 *
	 * @return Tag
	 */
	public function buildTag( \stdClass $Item );

	/**
	 * @param \stdClass $Item
	 *
	 * @return Tree
	 */
	public function buildTree( \stdClass $Item );

	/**
	 * @param \stdClass $Item
	 *
	 * @return Blob
	 */
	public function buildBlob( \stdClass $Item );

	/**
	 * @param \stdClass $Item
	 *
	 * @return Data
	 */
	public function buildData( \stdClass $Item );
}

class Type implements ITypeInterface {

	/**
	 * @param \stdClass $Item
	 *
	 * @return Release
	 */
	public function buildRelease( \stdClass $Item ) {

		return new Release( $Item );
	}

	/**
	 * @param \stdClass $Item
	 *
	 * @return Tag
	 */
	public function buildTag( \stdClass $Item ) {

		return new Tag( $Item );
	}

	/**
	 * @param \stdClass $Item
	 *
	 * @return Tree
	 */
	public function buildTree( \stdClass $Item ) {

		return new Tree( $Item );
	}

	/**
	 * @param \stdClass $Item
	 *
	 * @return Blob
	 */
	public function buildBlob( \stdClass $Item ) {

		return new Blob( $Item );
	}

	/**
	 * @param \stdClass $Item
	 *
	 * @return Data
	 */
	public function buildData( \stdClass $Item ) {

		return new Data( $Item );
	}

}
