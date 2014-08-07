<?php
namespace MOC\IV\Core;

use MOC\IV\Api;
use MOC\IV\Core\Update\GitHub\Source\Channel\Draft;
use MOC\IV\Core\Update\GitHub\Source\Channel\Nightly;
use MOC\IV\Core\Update\GitHub\Source\Channel\Release;

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
		$Configuration = $this->apiGitHub()->createConfig( __DIR__.'/Update/Config.ini' );

		if( $Configuration->getChannelRelease() ) {
			$Channel = new Release( $Configuration );
			var_dump( $Channel->getList() );
		}

		if( $Configuration->getChannelDraft() ) {
			$Channel = new Draft( $Configuration );
			var_dump( $Channel->getList() );
		}

		if( $Configuration->getChannelNightly() ) {
			$Channel = new Nightly( $Configuration );
			var_dump( $Channel->getList() );
		}

	}

	/**
	 * @return Update\GitHub\Api
	 */
	public function apiGitHub() {
		return new Update\GitHub\Api();
	}
}
