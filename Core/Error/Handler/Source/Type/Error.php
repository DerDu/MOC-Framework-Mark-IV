<?php
namespace MOC\MarkIV\Core\Error\Handler\Source\Type;

/**
 * Class Error
 *
 * @package MOC\MarkIV\Core\Error\Handler\Source\Type
 */
class Error extends Generic {

	/**
	 * @return void
	 */
	public function registerType() {

		set_error_handler(
			create_function( '$Code, $Message, $File, $Line',
				'\MOC\MarkIV\Api::groupCore()->unitError()->apiHandler()->apiType()->buildError()'.
				'->setData( "Runtime Error", $Message, $Code, $File, $Line, "", "Execution has been continued..." );'
			)
		);
	}
}
