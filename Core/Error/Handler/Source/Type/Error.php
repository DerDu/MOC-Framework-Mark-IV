<?php
namespace MOC\IV\Core\Error\Handler\Source\Type;

/**
 * Class Error
 *
 * @package MOC\IV\Core\Error\Handler\Source\Type
 */
class Error extends Generic {

	/**
	 * @return void
	 */
	public function registerType() {

		set_error_handler(
			create_function( '$Code, $Message, $File, $Line',
				'\MOC\IV\Api::groupCore()->unitError()->apiHandler()->apiType()->createError()'.
				'->setData( "Runtime Error", $Message, $Code, $File, $Line, "", "Execution has been continued..." );'
			)
		);
	}
}
