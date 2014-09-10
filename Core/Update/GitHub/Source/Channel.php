<?php
namespace MOC\MarkIV\Core\Update\GitHub\Source;

use MOC\MarkIV\Api;
use MOC\MarkIV\Core\Update\GitHub\Api\Type;
use MOC\MarkIV\Core\Update\GitHub\Source\Type\Release;

class Channel {

	/** @var int $ChannelCache 1d */
	private $ChannelCache = 86400;
	/** @var int $DataCache 30d */
	private $DataCache = 2592000;

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

		set_time_limit( 120 );

		$this->Type = new Type();
		$this->Config = $Config;
		$this->Version = $this->Config->getVersion();
	}

	/**
	 * @param bool $Download
	 *
	 * @return Release[]|null
	 */
	public function getChannelRelease( $Download = false ) {

		$Channel = array();
		if( $this->Config->getChannelActiveRelease() ) {
			if( false === ( $ReleaseList = Api::groupCore()->unitCache()->apiFile( $this->ChannelCache, __CLASS__ )->getCacheData( sha1( $this->Config->getChannelListRelease() ) ) ) ) {
				$ReleaseList = json_decode(
					$this->Config->getNetwork()->getFile( $this->Config->getChannelListRelease() )
				);
				if( !$this->checkRateLimit( $ReleaseList ) ) {
					return false;
				};
				Api::groupCore()->unitCache()->apiFile( $this->ChannelCache, __CLASS__ )->setCacheData( $ReleaseList, sha1( $this->Config->getChannelListRelease() ) );
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
					if( false === ( $Release = $this->downloadTagTree( $Release ) ) ) {
						return false;
					};
					if( $Download ) {
						if( false === ( $Release = $this->downloadUpdate( $Release ) ) ) {
							return false;
						};
					}
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
				return false;
			} else {
				return true;
			}
		} else {
			return true;
		}
	}

	/**
	 * @param Release $Release
	 *
	 * @return bool|Release
	 */
	private function downloadTagTree( Release $Release ) {

		if( false === ( $TagList = Api::groupCore()->unitCache()->apiFile( $this->ChannelCache, __CLASS__ )->getCacheData( sha1( $this->Config->getChannelListNightly() ) ) ) ) {
			$TagList = json_decode(
				$this->Config->getNetwork()->getFile( $this->Config->getChannelListNightly() )
			);
			if( !$this->checkRateLimit( $TagList ) ) {
				return false;
			};
			Api::groupCore()->unitCache()->apiFile( $this->ChannelCache, __CLASS__ )->setCacheData( $TagList, sha1( $this->Config->getChannelListNightly() ) );
		}
		foreach( (array)$TagList as $TagItem ) {
			$Tag = $this->Type->buildTag( $TagItem );
			if( $Tag->getVersion()->getVersionString() == $Release->getVersion()->getVersionString() ) {
				$Release->setTag( $Tag );
				if( false === ( $TreeList = Api::groupCore()->unitCache()->apiFile( $this->ChannelCache, __CLASS__ )->getCacheData( sha1( $this->Config->getGitHubChannelTree( $Tag->getIdentifier() ) ) ) ) ) {
					$TreeList = json_decode(
						$this->Config->getNetwork()->getFile( $this->Config->getGitHubChannelTree( $Tag->getIdentifier() ) )
					);
					if( !$this->checkRateLimit( $TreeList ) ) {
						return false;
					};
					Api::groupCore()->unitCache()->apiFile( $this->ChannelCache, __CLASS__ )->setCacheData( $TreeList, sha1( $this->Config->getGitHubChannelTree( $Tag->getIdentifier() ) ) );
				}
				$Tree = $this->Type->buildTree( $TreeList );
				$Release->setTree( $Tree );

				return $Release;
			}
		}

		return false;
	}

	private function downloadUpdate( Release $Release ) {

		$BlobList = $Release->getTree()->getBlobList();

		/** @var \MOC\MarkIV\Core\Update\GitHub\Source\Type\Data[] $DataList */
		$DataList = array();
		/** @var \MOC\MarkIV\Core\Update\GitHub\Source\Type\Blob $Blob */
		foreach( (array)$BlobList as $Blob ) {

			if( false === ( $Data = Api::groupCore()->unitCache()->apiFile( $this->DataCache, __METHOD__ )->getCacheData( $Blob->getIdentifier() ) ) ) {
				$Data = json_decode(
					$this->Config->getNetwork()->getFile( $this->Config->getGitHubChannelBlob( $Blob->getIdentifier() ) )
				);
				if( !$this->checkRateLimit( $Data ) ) {
					return false;
				};
				Api::groupCore()->unitCache()->apiFile( $this->DataCache, __METHOD__ )->setCacheData( $Data, $Blob->getIdentifier() );
			}
			$Data = $this->Type->buildData( $Data );
			array_push( $DataList, $Data );

		}

		$Release->setDataList( $DataList );

		return $Release;
	}

	public function getChannelRetryTimestamp() {

		$Limit = json_decode(
			$this->Config->getNetwork()->getFile( $this->Config->getGitHubChannelLimit() )
		);

		$Return = '';
		$rem = $Limit->resources->core->reset - time();
		$day = floor( $rem / 86400 );
		$hr = floor( ( $rem % 86400 ) / 3600 );
		$min = floor( ( $rem % 3600 ) / 60 );
		$sec = ( $rem % 60 );

		if( $day )
			$Return .= "$day Days ";
		if( $hr )
			$Return .= "$hr Hours ";
		if( $min )
			$Return .= "$min Minutes ";
		if( $sec )
			$Return .= "$sec Seconds ";

		return $Return;
	}

	public function getChannelLimit() {

		$Limit = json_decode(
			$this->Config->getNetwork()->getFile( $this->Config->getGitHubChannelLimit() )
		);

		return $Limit->resources->core->remaining.'/'.$Limit->resources->core->limit;
	}

	/**
	 * @param bool $Download
	 *
	 * @return Release[]|null
	 */
	public function getChannelPreview( $Download = false ) {

		$Channel = array();
		if( $this->Config->getChannelActivePreview() ) {
			if( false === ( $ReleaseList = Api::groupCore()->unitCache()->apiFile( $this->ChannelCache, __CLASS__ )->getCacheData( sha1( $this->Config->getChannelListPreview() ) ) ) ) {
				$ReleaseList = json_decode(
					$this->Config->getNetwork()->getFile( $this->Config->getChannelListPreview() )
				);
				if( !$this->checkRateLimit( $ReleaseList ) ) {
					return false;
				};
				Api::groupCore()->unitCache()->apiFile( $this->ChannelCache, __CLASS__ )->setCacheData( $ReleaseList, sha1( $this->Config->getChannelListPreview() ) );
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
					if( false === ( $Release = $this->downloadTagTree( $Release ) ) ) {
						return false;
					};
					if( $Download ) {
						if( false === ( $Release = $this->downloadUpdate( $Release ) ) ) {
							return false;
						};
					}
					array_push( $Channel, $Release );
				}
			}

			return $Channel;
		} else {
			return null;
		}
	}

	/**
	 * @param bool $Download
	 *
	 * @return Release[]|null
	 */
	public function getChannelNightly( $Download = false ) {

		$Channel = array();
		if( $this->Config->getChannelActiveNightly() ) {
			if( false === ( $ReleaseList = Api::groupCore()->unitCache()->apiFile( $this->ChannelCache, __CLASS__ )->getCacheData( sha1( $this->Config->getChannelListNightly() ) ) ) ) {
				$ReleaseList = json_decode(
					$this->Config->getNetwork()->getFile( $this->Config->getChannelListNightly() )
				);
				if( !$this->checkRateLimit( $ReleaseList ) ) {
					return false;
				};
				Api::groupCore()->unitCache()->apiFile( $this->ChannelCache, __CLASS__ )->setCacheData( $ReleaseList, sha1( $this->Config->getChannelListNightly() ) );
			}
			foreach( (array)$ReleaseList as $ReleaseItem ) {
				$Release = $this->Type->buildRelease( $ReleaseItem );
				/**
				 * Skip older versions
				 */
				if( $this->Version->checkBehindAheadStatusOf( $Release->getVersion() ) <= 0 ) {
					continue;
				}
				if( false === ( $Release = $this->downloadTagTree( $Release ) ) ) {
					return false;
				};
				if( $Download ) {
					if( false === ( $Release = $this->downloadUpdate( $Release ) ) ) {
						return false;
					};
				}
				array_push( $Channel, $Release );
			}

			return $Channel;
		} else {
			return null;
		}
	}
}
