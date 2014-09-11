<?php
namespace MOC\MarkIV\Extension;

use MOC\MarkIV\Core\Drive\Directory\IApiInterface;

/**
 * Interface IDocumentationInterface
 *
 * @package MOC\MarkIV\Extension
 */
interface IDocumentationInterface {

	/**
	 * @param IApiInterface $Source
	 * @param IApiInterface $Destination
	 *
	 * @return Documentation\ApiGen\Api
	 */
	public function useApiGen( IApiInterface $Source, IApiInterface $Destination );
}

/**
 * Class Documentation
 *
 * @package MOC\MarkIV\Extension
 */
class Documentation implements IDocumentationInterface {

	/**
	 * @param IApiInterface $Source
	 * @param IApiInterface $Destination
	 *
	 * @return Documentation\ApiGen\Api
	 */
	public function useApiGen( IApiInterface $Source, IApiInterface $Destination ) {

		return new Documentation\ApiGen\Api( $Source, $Destination );
	}
}
