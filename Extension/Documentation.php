<?php
namespace MOC\IV\Extension;

use MOC\IV\Core\Drive\Directory\IApiInterface;

/**
 * Interface IDocumentationInterface
 *
 * @package MOC\IV\Extension
 */
interface IDocumentationInterface {

	/**
	 * @param IApiInterface $Source
	 * @param IApiInterface $Destination
	 *
	 * @return Documentation\Generator\Api
	 */
	public function apiGenerator( IApiInterface $Source, IApiInterface $Destination );
}

/**
 * Class Documentation
 *
 * @package MOC\IV\Extension
 */
class Documentation implements IDocumentationInterface {

	/**
	 * @param IApiInterface $Source
	 * @param IApiInterface $Destination
	 *
	 * @return Documentation\Generator\Api
	 */
	public function apiGenerator( IApiInterface $Source, IApiInterface $Destination ) {

		return new Documentation\Generator\Api( $Source, $Destination );
	}
}
