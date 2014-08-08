<?php
namespace MOC\IV\Core\Update\GitHub\Source;

use MOC\IV\Api;
use MOC\IV\Core\Update\GitHub\Api\Type;
use MOC\IV\Core\Update\GitHub\Source\Type\Release;

class Channel {

	/** @var int $Cache */
	private $Cache = 3600;

	/** @var Type|null $Type */
	private $Type = null;
	/** @var Config|null $Config */
	private $Config = null;
	/** @var Version|null $Version */
	private $Version = null;

	/**
	 * @param Config $Config
	 */
	function __construct( Config $Config ) {

		$this->Type = new Type();
		$this->Config = $Config;
		$this->Version = new Version(
			$Config->getCurrentVersionMajor()
			.'.'.$Config->getCurrentVersionMinor()
			.'.'.$Config->getCurrentVersionPatch()
			.'.'.$Config->getCurrentVersionBuild()
		);
	}

	/**
	 * @return Release[]|null
	 */
	public function getChannelRelease() {

		$Channel = array();
		if( $this->Config->getChannelActiveRelease() ) {
			if( false === ( $ReleaseList = Api::groupCore()->unitCache()->apiFile( $this->Cache, __CLASS__ )->getCacheData( $this->Config->getChannelListRelease() ) ) ) {
				$ReleaseList = json_decode(
					$this->Config->getNetwork()->getFile( $this->Config->getChannelListRelease() )
				);
				if( !$this->checkRateLimit( $ReleaseList ) ) {
					return false;
				};
				Api::groupCore()->unitCache()->apiFile( $this->Cache, __CLASS__ )->setCacheData( $ReleaseList, $this->Config->getChannelListRelease() );
			}
			foreach( (array)$ReleaseList as $ReleaseItem ) {
				if( !$ReleaseItem->prerelease ) {
					$Release = $this->Type->buildRelease( $ReleaseItem );
					/**
					 * Skip older versions
					 */
					if( $this->Version->checkBehindAheadStatusOf( $Release->getVersion() ) <= 0 ) {
						continue;
					}
					if( false === ( $Release = $this->buildTagTree( $Release ) ) ) {
						return false;
					};
					array_push( $Channel, $Release );
				}
			}

			return $Channel;
		} else {
			return null;
		}
	}

	/**
	 * @param \stdClass|array $Response
	 *
	 * @return bool
	 */
	private function checkRateLimit( $Response ) {

		if( $Response instanceof \stdClass ) {
			if( isset( $Response->message ) && isset( $Response->documentation_url ) ) {
				$Limit = json_decode(
					$this->Config->getNetwork()->getFile( $this->Config->getGitHubChannelLimit() )
				);
				trigger_error(
					$Response->message
					.'<br/>'.$Response->documentation_url
					.'<br/>'
					.'<br/>Limit: '.$Limit->resources->core->limit.' per hour'
					.'<br/>Reset: '.date( 'd.m.Y H:i:s', $Limit->resources->core->reset )
				);

				return false;
			} else {
				return true;
			}
		} else {
			return true;
		}
	}

	/**
	 * @return Release[]|null
	 */
	public function getChannelPreview() {

		$Channel = array();
		if( $this->Config->getChannelActivePreview() ) {
			if( false === ( $ReleaseList = Api::groupCore()->unitCache()->apiFile( $this->Cache, __CLASS__ )->getCacheData( $this->Config->getChannelListPreview() ) ) ) {
				$ReleaseList = json_decode(
					$this->Config->getNetwork()->getFile( $this->Config->getChannelListPreview() )
				);
				if( !$this->checkRateLimit( $ReleaseList ) ) {
					return false;
				};
				Api::groupCore()->unitCache()->apiFile( $this->Cache, __CLASS__ )->setCacheData( $ReleaseList, $this->Config->getChannelListPreview() );
			}
			foreach( (array)$ReleaseList as $ReleaseItem ) {
				if( $ReleaseItem->prerelease ) {
					$Release = $this->Type->buildRelease( $ReleaseItem );
					/**
					 * Skip older versions
					 */
					if( $this->Version->checkBehindAheadStatusOf( $Release->getVersion() ) <= 0 ) {
						continue;
					}
					if( false === ( $Release = $this->buildTagTree( $Release ) ) ) {
						return false;
					};
					array_push( $Channel, $Release );
				}
			}

			return $Channel;
		} else {
			return null;
		}
	}

	/**
	 * @return Release[]|null
	 */
	public function getChannelNightly() {

		$Channel = array();
		if( $this->Config->getChannelActiveNightly() ) {
			if( false === ( $ReleaseList = Api::groupCore()->unitCache()->apiFile( $this->Cache, __CLASS__ )->getCacheData( $this->Config->getChannelListNightly() ) ) ) {
				$ReleaseList = json_decode(
					$this->Config->getNetwork()->getFile( $this->Config->getChannelListNightly() )
				);
				if( !$this->checkRateLimit( $ReleaseList ) ) {
					return false;
				};
				Api::groupCore()->unitCache()->apiFile( $this->Cache, __CLASS__ )->setCacheData( $ReleaseList, $this->Config->getChannelListNightly() );
			}
			foreach( (array)$ReleaseList as $ReleaseItem ) {
				$Release = $this->Type->buildRelease( $ReleaseItem );
				/**
				 * Skip older versions
				 */
				if( $this->Version->checkBehindAheadStatusOf( $Release->getVersion() ) <= 0 ) {
					continue;
				}
				if( false === ( $Release = $this->buildTagTree( $Release ) ) ) {
					return false;
				};
				array_push( $Channel, $Release );
			}

			return $Channel;
		} else {
			return null;
		}
	}

	/**
	 * @param Release $Release
	 *
	 * @return bool|Release
	 */
	private function buildTagTree( Release $Release ) {
		if( false === ( $TagList = Api::groupCore()->unitCache()->apiFile( $this->Cache, __CLASS__ )->getCacheData( $this->Config->getChannelListNightly() ) ) ) {
			$TagList = json_decode(
				$this->Config->getNetwork()->getFile( $this->Config->getChannelListNightly() )
			);
			if( !$this->checkRateLimit( $TagList ) ) {
				return false;
			};
			Api::groupCore()->unitCache()->apiFile( $this->Cache, __CLASS__ )->setCacheData( $TagList, $this->Config->getChannelListNightly() );
		}
		foreach( (array)$TagList as $TagItem ) {
			$Tag = $this->Type->buildTag( $TagItem );
			if( $Tag->getVersion()->getVersionString() == $Release->getVersion()->getVersionString() ) {
				$Release->setTag( $Tag );
				if( false === ( $TreeList = Api::groupCore()->unitCache()->apiFile( $this->Cache, __CLASS__ )->getCacheData( $this->Config->getGitHubChannelTree( $Tag->getIdentifier() ) ) ) ) {
					$TreeList = json_decode(
						$this->Config->getNetwork()->getFile( $this->Config->getGitHubChannelTree( $Tag->getIdentifier() ) )
					);
					if( !$this->checkRateLimit( $TreeList ) ) {
						return false;
					};
					Api::groupCore()->unitCache()->apiFile( $this->Cache, __CLASS__ )->setCacheData( $TreeList, $this->Config->getGitHubChannelTree( $Tag->getIdentifier() ) );
				}
				$Tree = $this->Type->buildTree( $TreeList );
				$Release->setTree( $Tree );
				return $Release;
			}
		}
		return false;
	}
}
