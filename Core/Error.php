<?php
namespace MOC\IV\Core;

interface IError {
	public function registerType( Error\Type\Generic $Type );
}

class Error implements IError {

	public function getType() {
		return new Error\Type();
	}

	public function registerType( Error\Type\Generic $Type ) {
		$Type->registerType();
	}

}
