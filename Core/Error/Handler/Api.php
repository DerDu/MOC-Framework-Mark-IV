<?php
namespace MOC\MarkIV\Core\Error\Handler;

use MOC\MarkIV\Core\Error\Handler\Api\Type;
use MOC\MarkIV\Core\Error\Handler\Source\Type\Generic;

/**
 * Interface IApi
 *
 * @package MOC\MarkIV\Core\Error\Handler
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
 * @package MOC\MarkIV\Core\Error\Handler
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
