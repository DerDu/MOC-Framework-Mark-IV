<?php
namespace MOC\IV\Core;

use MOC\IV\Api;

/**
 * Interface IUpdateInterface
 *
 * @package MOC\IV\Core
 */
interface IUpdateInterface {

}

/**
 * Class Update
 *
 * @package MOC\IV\Core
 */
class Update implements IUpdateInterface {

	function __construct() {

		$Server = Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->createServer( '192.168.100.254', '3128' );
		$Credentials = Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->createCredentials( 'Kunze', 'Ny58N' );

		$Proxy = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->createBasic( $Server, $Credentials );
		$Proxy->setCustomHeader( 'User-Agent', 'DerDu' );

		var_dump( json_decode( $Proxy->getFile( 'https://api.github.com/repos/DerDu/MOC-Framework-Mark-IV/tags' ) ) );
		var_dump( json_decode( $Proxy->getFile( 'https://api.github.com/repos/DerDu/MOC-Framework-Mark-IV/releases' ) ) );

	}

}
