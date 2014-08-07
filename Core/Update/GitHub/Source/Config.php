<?php
namespace MOC\IV\Core\Update\GitHub\Source;

use MOC\IV\Api;
use MOC\IV\Core\Update\GitHub\Source\Utility\Ini;

class Config {

	private $Location = false;

	private $ProxyHost = null;
	private $ProxyPort = null;
	private $ProxyUser = null;
	private $ProxyPass = null;

	private $ChannelRelease = true;
	private $ChannelDraft = false;
	private $ChannelNightly = false;

	private $VersionMajor = 0;
	private $VersionMinor = 0;
	private $VersionPatch = 0;
	private $VersionBuild = 0;

	private $Network = null;

	function __construct( $Location ) {
		$this->Location = $Location;
		$ValueList = Ini::readFile( $this->Location );
		if( isset( $ValueList['Version'] ) ) {
			if( isset( $ValueList['Version']['CurrentMajor'] ) ) {
				$this->VersionMajor = $ValueList['Version']['CurrentMajor'];
			}
			if( isset( $ValueList['Version']['CurrentMinor'] ) ) {
				$this->VersionMinor = $ValueList['Version']['CurrentMinor'];
			}
			if( isset( $ValueList['Version']['CurrentPatch'] ) ) {
				$this->VersionPatch = $ValueList['Version']['CurrentPatch'];
			}
			if( isset( $ValueList['Version']['CurrentBuild'] ) ) {
				$this->VersionBuild = $ValueList['Version']['CurrentBuild'];
			}
		}
		if( isset( $ValueList['Channel'] ) ) {
			if( isset( $ValueList['Channel']['UseRelease'] ) ) {
				$this->ChannelRelease = $ValueList['Channel']['UseRelease'];
			}
			if( isset( $ValueList['Channel']['UseDraft'] ) ) {
				$this->ChannelDraft = $ValueList['Channel']['UseDraft'];
			}
			if( isset( $ValueList['Channel']['UseNightly'] ) ) {
				$this->ChannelNightly = $ValueList['Channel']['UseNightly'];
			}
		}
		if( isset( $ValueList['Network'] ) ) {
			if( isset( $ValueList['Network']['ProxyHost'] ) ) {
				$this->ProxyHost = $ValueList['Network']['ProxyHost'];
			}
			if( isset( $ValueList['Network']['ProxyPort'] ) ) {
				$this->ProxyPort = $ValueList['Network']['ProxyPort'];
			}
			if( isset( $ValueList['Network']['ProxyUser'] ) ) {
				$this->ProxyUser = $ValueList['Network']['ProxyUser'];
			}
			if( isset( $ValueList['Network']['ProxyPass'] ) ) {
				$this->ProxyPass = $ValueList['Network']['ProxyPass'];
			}
		}
		if( null !== $this->ProxyHost && null !== $this->ProxyUser ) {
			$this->Network = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->createBasic(
				Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->createServer( $this->ProxyHost, $this->ProxyPort ),
				Api::groupCore()->unitNetwork()->apiProxy()->apiConfig()->createCredentials( $this->ProxyUser, $this->ProxyPass )
			);
		} else {
			$this->Network = Api::groupCore()->unitNetwork()->apiProxy()->apiType()->createNone();
		}
		$this->Network->setCustomHeader( 'User-Agent', 'DerDu' );
	}

	/**
	 * @param boolean $ChannelDraft
	 */
	public function setChannelDraft( $ChannelDraft ) {

		$this->ChannelDraft = $ChannelDraft;
	}

	/**
	 * @return boolean
	 */
	public function getChannelDraft() {

		return $this->ChannelDraft;
	}

	/**
	 * @param boolean $ChannelNightly
	 */
	public function setChannelNightly( $ChannelNightly ) {

		$this->ChannelNightly = $ChannelNightly;
	}

	/**
	 * @return boolean
	 */
	public function getChannelNightly() {

		return $this->ChannelNightly;
	}

	/**
	 * @param boolean $ChannelRelease
	 */
	public function setChannelRelease( $ChannelRelease ) {

		$this->ChannelRelease = $ChannelRelease;
	}

	/**
	 * @return boolean
	 */
	public function getChannelRelease() {

		return $this->ChannelRelease;
	}

	/**
	 * @return \MOC\IV\Core\Network\Proxy\Source\Type\None|null
	 */
	public function getNetwork() {

		return $this->Network;
	}

	/**
	 * @param null $ProxyHost
	 */
	public function setProxyHost( $ProxyHost ) {

		$this->ProxyHost = $ProxyHost;
	}

	/**
	 * @return null
	 */
	public function getProxyHost() {

		return $this->ProxyHost;
	}

	/**
	 * @param null $ProxyPass
	 */
	public function setProxyPass( $ProxyPass ) {

		$this->ProxyPass = $ProxyPass;
	}

	/**
	 * @return null
	 */
	public function getProxyPass() {

		return $this->ProxyPass;
	}

	/**
	 * @param null $ProxyPort
	 */
	public function setProxyPort( $ProxyPort ) {

		$this->ProxyPort = $ProxyPort;
	}

	/**
	 * @return null
	 */
	public function getProxyPort() {

		return $this->ProxyPort;
	}

	/**
	 * @param null $ProxyUser
	 */
	public function setProxyUser( $ProxyUser ) {

		$this->ProxyUser = $ProxyUser;
	}

	/**
	 * @return null
	 */
	public function getProxyUser() {

		return $this->ProxyUser;
	}

	/**
	 * @param int $VersionBuild
	 */
	public function setVersionBuild( $VersionBuild ) {

		$this->VersionBuild = $VersionBuild;
	}

	/**
	 * @return int
	 */
	public function getVersionBuild() {

		return $this->VersionBuild;
	}

	/**
	 * @param int $VersionMajor
	 */
	public function setVersionMajor( $VersionMajor ) {

		$this->VersionMajor = $VersionMajor;
	}

	/**
	 * @return int
	 */
	public function getVersionMajor() {

		return $this->VersionMajor;
	}

	/**
	 * @param int $VersionMinor
	 */
	public function setVersionMinor( $VersionMinor ) {

		$this->VersionMinor = $VersionMinor;
	}

	/**
	 * @return int
	 */
	public function getVersionMinor() {

		return $this->VersionMinor;
	}

	/**
	 * @param int $VersionPatch
	 */
	public function setVersionPatch( $VersionPatch ) {

		$this->VersionPatch = $VersionPatch;
	}

	/**
	 * @return int
	 */
	public function getVersionPatch() {

		return $this->VersionPatch;
	}

}
