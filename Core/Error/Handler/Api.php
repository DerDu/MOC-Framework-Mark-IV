<?php
namespace MOC\IV\Core\Error\Handler;

use MOC\IV\Core\Error\Handler\Api\Type;
use MOC\IV\Core\Error\Handler\Source\Type\Generic;

/**
 * Interface IApi
 *
 * @package MOC\IV\Core\Error\Handler
 */
interface IApiInterface {

	/**
	 * @param Generic $Type
	 *
	 * @return Api
	 */
	public function registerType( Generic $Type );
}

/**
 * Class Api
 *
 * @package MOC\IV\Core\Error\Handler
 */
class Api implements IApiInterface {

	/**
	 * @return Type
	 */
	public function apiType() {

		return new Type();
	}

	/**
	 * @param Generic $Type
	 *
	 * @return Api
	 */
	public function registerType( Generic $Type ) {

		$Type->registerType();

		return $this;
	}
}
