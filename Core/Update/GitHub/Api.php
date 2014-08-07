<?php
namespace MOC\IV\Core\Update\GitHub;

interface IApiInterface {

}

class Api implements IApiInterface {

	public function createConfig( $Location ) {
		return new Source\Config( $Location );
	}

}
