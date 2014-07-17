<?php
namespace MOC\IV\Module;

interface IEncoding {
	public function useText();
}

class Encoding implements IEncoding {

	public function useText() {
		return new Encoding\Text();
	}

}
