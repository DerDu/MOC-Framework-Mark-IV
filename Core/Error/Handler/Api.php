<?php
namespace MOC\IV\Core\Error\Handler;

use MOC\IV\Core\Error\Handler\Api\Type;
use MOC\IV\Core\Error\Handler\Source\Type\Generic;

/**
 * Interface IApi
 *
 * @package MOC\IV\Core\Error\Handler
 */
interface IApi {

	/**
	 * @param Generic $Type
	 *
	 * @return Api
	 */
	public function Register( Generic $Type );
}

/**
 * Class Api
 *
 * @package MOC\IV\Core\Error\Handler
 */
class Api implements IApi {

	/**
	 * @return Type
	 */
	public function Type() {

		return new Type();
	}

	/**
	 * @param Generic $Type
	 *
	 * @return Api
	 */
	public function Register( Generic $Type ) {

		$Type->Register();

		return $this;
	}
}
