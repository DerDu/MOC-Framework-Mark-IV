<?php
namespace MOC\MarkIV\Core\Update\GitHub\Source;

use MOC\MarkIV\Api;
use MOC\MarkIV\Core\Update\GitHub\Source\Utility\Ini;

/**
 * Class Config
 *
 * @package MOC\MarkIV\Core\Update\GitHub\Source
 */
interface IConfigInterface {

	/**
	 * @return bool
	 */
	public function getChannelActivePreview();

	/**
	 * @return bool
	 */
	public function getMatchAutoInstallBuild();

	/**
	 * @return bool
	 */
	public function getMatchAutoUpdatePatch();

	/**
	 * @return string
	 */
	public function getChannelListRelease();

	/**
	 * @return bool
	 */
	public function getChannelActiveNightly();

	/**
	 * @return bool
	 */
	public function getMatchAutoUpdateBuild();

	/**
	 * @return \MOC\MarkIV\Core\Network\Proxy\Source\Type\Generic
	 */
	public function getNetwork();

	/**
	 * @param string $Identifier
	 * @param bool   $Recursive
	 *
	 * @return string
	 */
	public function getGitHubChannelTree( $Identifier, $Recursive = true );

	/**
	 * @param string $Identifier
	 *
	 * @return string
	 */
	public function getGitHubChannelBlob( $Identifier );

	/**
	 * @return string
	 */
	public function getChannelListPreview();

	/**
	 * @return null|string
	 */
	public function getProxyHost();

	/**
	 * @return int
	 */
	public function getCurrentVersionPatch();

	/**
	 * @return Version|null
	 */
	public function getVersion();

	/**
	 * @return int
	 */
	public function getCurrentVersionMajor();

	/**
	 * @return bool
	 */
	public function getChannelActiveRelease();

	/**
	 * @return bool
	 */
	public function getMatchAutoUpdateMajor();

	/**
	 * @return null|string
	 */
	public function getProxyPass();

	/**
	 * @return bool
	 */
	public function getMatchAutoUpdateMinor();

	/**
	 * @return null|string
	 */
	public function getProxyPort();

	/**
	 * @return null|string
	 */
	public function getProxyUser();

	/**
	 * @return int
	 */
	public function getCurrentVersionBuild();

	/**
	 * @return string
	 */
	public function getChannelListNightly();

	/**
	 * @return bool
	 */
	public function getMatchAutoInstallPatch();

	/**
	 * @return string
	 */
	public function getGitHubChannelLimit();

	/**
	 * @return bool
	 */
	public function getMatchAutoInstallMinor();

	/**
	 * @return bool
	 */
	public function getMatchAutoInstallMajor();

	/**
	 * @return int
	 */
	public function getCurrentVersionMinor();
}

/**
 * Class Config
 *
 * @package MOC\MarkIV\Core\Update\GitHub\Source
 */
class Config implements IConfigInterface {

	private $Location = false;

	private $Structure = array(
		'Version:Current'   => array(
			'Major' => 0,
			'Minor' => 0,
			'Patch' => 0,
			'Build' => 0
		),
		'Channel:List'      => array(
			'Release'              => 'https://api.github.com/repos/DerDu/MOC-Framework-Mark-IV/releases',
			'Preview'              => 'https://api.github.com/repos/DerDu/MOC-Framework-Mark-IV/releases',
			'Nightly'              => 'https://api.github.com/repos/DerDu/MOC-Framework-Mark-IV/tags',
			/**
			 * Internal
			 */
			'GitHub:Channel:Tree'  => 'https://api.github.com/repos/DerDu/MOC-Framework-Mark-IV/git/trees',
			'GitHub:Channel:Blob'  => 'https://api.github.com/repos/DerDu/MOC-Framework-Mark-IV/git/blobs',
			'GitHub:Channel:Limit' => 'https://api.github.com/rate_limit'
		),
		'Channel:Active'    => array(
			'Release' => true,
			'Preview' => false,
			'Nightly' => false
		),
		'Network:Proxy'     => array(
			'Host' => null,
			'Port' => null,
			'User' => null,
			'Pass' => null
		),
		'Match:AutoUpdate'  => array(
			'Major' => true,
			'Minor' => true,
			'Patch' => false,
			'Build' => false
		),
		'Match:AutoInstall' => array(
			'Major' => true,
			'Minor' => true,
			'Patch' => true,
			'Build' => true
		)
	);

	private $Network = null;

	/** @var Version|null $Version */
	private $Version = null;

	function __construct( $Location ) {

		/**
		 * Parse File
		 */
		$this->Location = $Location;
		$ValueList = Ini::readFile( $this->Location, INI_SCANNER_RAW );
		/**
		 * Prepare Content
		 */
		foreach( (array)$this->Structure as $Group => $ItemList ) {
			foreach( (array)$ItemList as $Key => $Value ) {
				if( isset( $ValueList[$Group] ) && isset( $ValueList[$Group][$Key] ) ) {
					switch( strtoupper( $Group ) ) {
						case 'VERSION:CURRENT':
						{
							$ValueList[$Group][$Key] = (integer)$ValueList[$Group][$Key];
							break;
						}
					}
					switch( strtoupper( $ValueList[$Group][$Key] ) ) {
						case 'TRUE':
						case 'ON':
						{
							$ValueList[$Group][$Key] = true;
							break;
						}
						case 'FALSE':
						case 'OFF':
						{
							$ValueList[$Group][$Key] = false;
							break;
						}
					}
					$this->Structure[$Group][$Key] = $ValueList[$Group][$Key];
				}
			}
		}
		/**
		 * Create Network
		 */
		if( null !== $this->getProxyHost() && null !== $this->getProxyUser() ) {
			$this->Network = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildBasic(
				Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildServer( $this->getProxyHost(), $this->getProxyPort() ),
				Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildCredentials( $this->getProxyUser(), $this->getProxyPass() )
			);
		} else if( null !== $this->getProxyHost() ) {
			$this->Network = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildRelay(
				Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->buildServer( $this->getProxyHost(), $this->getProxyPort() )
			);
		} else {
			$this->Network = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->buildNone();
		}

		$this->Network->setCustomHeader( 'User-Agent', $this->getChannelListRelease() );
		$this->Version = new Version( $this->getCurrentVersionMajor()
			.'.'.$this->getCurrentVersionMinor()
			.'.'.$this->getCurrentVersionPatch()
			.'.'.$this->getCurrentVersionBuild()
		);
	}

	/**
	 * @return null|string
	 */
	public function getProxyHost() {

		return $this->Structure['Network:Proxy']['Host'];
	}

	/**
	 * @return null|string
	 */
	public function getProxyUser() {

		return $this->Structure['Network:Proxy']['User'];
	}

	/**
	 * @return null|string
	 */
	public function getProxyPort() {

		return $this->Structure['Network:Proxy']['Port'];
	}

	/**
	 * @return null|string
	 */
	public function getProxyPass() {

		return $this->Structure['Network:Proxy']['Pass'];
	}

	/**
	 * @return string
	 */
	public function getChannelListRelease() {

		return $this->Structure['Channel:List']['Release'];
	}

	/**
	 * @return int
	 */
	public function getCurrentVersionMajor() {

		return $this->Structure['Version:Current']['Major'];
	}

	/**
	 * @return int
	 */
	public function getCurrentVersionMinor() {

		return $this->Structure['Version:Current']['Minor'];
	}

	/**
	 * @return int
	 */
	public function getCurrentVersionPatch() {

		return $this->Structure['Version:Current']['Patch'];
	}

	/**
	 * @return int
	 */
	public function getCurrentVersionBuild() {

		return $this->Structure['Version:Current']['Build'];
	}

	/**
	 * @return \MOC\MarkIV\Core\Network\Proxy\Source\Type\Generic
	 */
	public function getNetwork() {

		return $this->Network;
	}

	/**
	 * @return string
	 */
	public function getChannelListPreview() {

		return $this->Structure['Channel:List']['Preview'];
	}

	/**
	 * @return string
	 */
	public function getChannelListNightly() {

		return $this->Structure['Channel:List']['Nightly'];
	}

	/**
	 * @return bool
	 */
	public function getMatchAutoUpdateMajor() {

		return $this->Structure['Match:AutoUpdate']['Major'];
	}

	/**
	 * @return bool
	 */
	public function getMatchAutoUpdateMinor() {

		return $this->Structure['Match:AutoUpdate']['Minor'];
	}

	/**
	 * @return bool
	 */
	public function getMatchAutoUpdatePatch() {

		return $this->Structure['Match:AutoUpdate']['Patch'];
	}

	/**
	 * @return bool
	 */
	public function getMatchAutoUpdateBuild() {

		return $this->Structure['Match:AutoUpdate']['Build'];
	}

	/**
	 * @return bool
	 */
	public function getMatchAutoInstallMajor() {

		return $this->Structure['Match:AutoInstall']['Major'];
	}

	/**
	 * @return bool
	 */
	public function getMatchAutoInstallMinor() {

		return $this->Structure['Match:AutoInstall']['Minor'];
	}

	/**
	 * @return bool
	 */
	public function getMatchAutoInstallPatch() {

		return $this->Structure['Match:AutoInstall']['Patch'];
	}

	/**
	 * @return bool
	 */
	public function getMatchAutoInstallBuild() {

		return $this->Structure['Match:AutoInstall']['Build'];
	}

	/**
	 * @return bool
	 */
	public function getChannelActiveRelease() {

		return $this->Structure['Channel:Active']['Release'];
	}

	/**
	 * @return bool
	 */
	public function getChannelActivePreview() {

		return $this->Structure['Channel:Active']['Preview'];
	}

	/**
	 * @return bool
	 */
	public function getChannelActiveNightly() {

		return $this->Structure['Channel:Active']['Nightly'];
	}

	/**
	 * @param string $Identifier
	 * @param bool   $Recursive
	 *
	 * @return string
	 */
	public function getGitHubChannelTree( $Identifier, $Recursive = true ) {

		return $this->Structure['Channel:List']['GitHub:Channel:Tree'].'/'.$Identifier.( $Recursive ? '?recursive=1' : '' );
	}

	/**
	 * @param string $Identifier
	 *
	 * @return string
	 */
	public function getGitHubChannelBlob( $Identifier ) {

		return $this->Structure['Channel:List']['GitHub:Channel:Blob'].'/'.$Identifier;
	}

	/**
	 * @return string
	 */
	public function getGitHubChannelLimit() {

		return $this->Structure['Channel:List']['GitHub:Channel:Limit'];
	}

	/**
	 * @return Version|null
	 */
	public function getVersion() {

		return $this->Version;
	}

}
