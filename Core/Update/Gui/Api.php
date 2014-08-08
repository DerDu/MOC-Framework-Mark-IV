<?php
namespace MOC\IV\Core\Update\Gui;

interface IApiInterface {

}

class Api implements IApiInterface {

	private $AvailableRelease = array();
	private $AvailablePreview = array();
	private $AvailableNightly = array();

	public function searchUpdate() {

	}

	public function installUpdate() {

	}
}
