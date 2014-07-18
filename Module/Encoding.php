<?php
namespace MOC\IV\Module;

interface IEncoding {
	public function useText( $Text );
}

class Encoding implements IEncoding {

	public function useText( $Text ) {
		return new Encoding\Text( $Text );
	}

}
