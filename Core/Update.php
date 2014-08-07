<?php
namespace MOC\IV\Core;

use MOC\IV\Api;
use MOC\IV\Core\Update\GitHub\Source\Channel\Draft;
use MOC\IV\Core\Update\GitHub\Source\Channel\Nightly;
use MOC\IV\Core\Update\GitHub\Source\Channel\Release;
use MOC\IV\Core\Update\GitHub\Source\Channel\Tree;

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
			// Get Release
			$ReleaseChannel = new Release( $Configuration );
			// Latest Release
			/** @var \MOC\IV\Core\Update\GitHub\Source\Type\Release $Release */
			$Release = current( $ReleaseChannel->getList() );
			if( $Release ) {
				// Get Tag
				$NightlyChannel = new Nightly( $Configuration );
				/** @var \MOC\IV\Core\Update\GitHub\Source\Type\Tag $Tag */
				$Tag = $NightlyChannel->getBuild( $Release->getVersion() );
				// Get Files
				$Tree = new Tree( $Configuration, $Tag->getIdentifier() );

				var_dump( $Tree );
			}
		}

		if( $Configuration->getChannelDraft() ) {
			// Get Draft
			$DraftChannel = new Draft( $Configuration );
			// Latest Draft
			/** @var \MOC\IV\Core\Update\GitHub\Source\Type\Release $Draft */
			$Draft = current( $DraftChannel->getList() );
			if( $Draft ) {
				// Get Tag
				$NightlyChannel = new Nightly( $Configuration );
				/** @var \MOC\IV\Core\Update\GitHub\Source\Type\Tag $Tag */
				$Tag = $NightlyChannel->getBuild( $Draft->getVersion() );
				// Get Files
				$Tree = new Tree( $Configuration, $Tag->getIdentifier() );

				var_dump( $Tree );
			}
		}



		if( $Configuration->getChannelNightly() ) {
			// Get Nightly
			$NightlyChannel = new Nightly( $Configuration );
			// Latest Nightly
			/** @var \MOC\IV\Core\Update\GitHub\Source\Type\Tag $Tag */
			$Tag = current( $NightlyChannel->getList() );
			if( $Tag ) {
				// Get Files
				$Tree = new Tree( $Configuration, $Tag->getIdentifier() );

				var_dump( $Tree );
			}
		}

	}

	/**
	 * @return Update\GitHub\Api
	 */
	public function apiGitHub() {
		return new Update\GitHub\Api();
	}
}
