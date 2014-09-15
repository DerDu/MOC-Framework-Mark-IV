<?php
namespace MOC\MarkIV\Core\Cache\File;

interface IApiInterface {

	/**
	 * @param mixed      $Data
	 * @param null|mixed $Identifier
	 *
	 * @return Api
	 */
	public function setCacheData( $Data, $Identifier = null );

	/**
	 * @param string $Identifier
	 *
	 * @return bool|mixed
	 */
	public function getCacheData( $Identifier );

	/**
	 * @param bool $Identifier
	 *
	 * @return bool|\MOC\MarkIV\Core\Drive\File\Api
	 */
	public function getCacheFile( $Identifier = false );

	/**
	 * @return mixed|void
	 */
	public function purgeCache();
}

class Api implements IApiInterface {

	/** @var \MOC\MarkIV\Core\Drive\Directory\Api $Directory */
	private $Directory = null;
	/** @var int $Timeout */
	private $Timeout = 60;
	/** @var string $Identifier */
	private $Identifier = '';
	/** @var string $Group */
	private $Group = '';
	/** @var string $Extension */
	private $Extension = 'cache';

	/**
	 *
	 */
	function __construct( $Timeout = 60, $Group = '', $Extension = 'cache' ) {

		$this->setTimeout( $Timeout );
		$this->setGroup( $Group );
		$this->setExtension( $Extension );
		$this->Directory = \MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory(
			\MOC\MarkIV\Api::groupCore()->unitDrive()->getDataDirectory()->getLocation().DIRECTORY_SEPARATOR.'Cache'
		);
		if( !$this->Directory->checkExists() ) {
			$this->Directory->createDirectory();
		}
	}

	/**
	 * @param int $Seconds
	 *
	 * @return Api
	 */
	private function setTimeout( $Seconds ) {

		$this->Timeout = time() + $Seconds;

		return $this;
	}

	/**
	 * @param mixed $Name
	 *
	 * @return Api
	 */
	private function setGroup( $Name ) {

		$this->Group = sha1( serialize( $Name ) );

		return $this;
	}

	/**
	 * @param string $Extension
	 *
	 * @return Api
	 */
	private function setExtension( $Extension ) {

		$this->Extension = $Extension;

		return $this;
	}

	/**
	 * @param mixed      $Data
	 * @param null|mixed $Identifier
	 *
	 * @return Api|string
	 */
	public function setCacheData( $Data, $Identifier = null ) {

		if( null === $Identifier ) {
			$this->setIdentifier( $Data );
		} else {
			$this->Identifier = $Identifier;
		}

		if( null === $Data ) {
			$this->setCacheFile( '' );
		} else {
			$this->setCacheFile( serialize( $Data ) );
		}

		if( null === $Identifier ) {
			return $this->Identifier;
		} else {
			return $this;
		}
	}

	/**
	 * @param mixed $Data
	 *
	 * @return string|Api
	 */
	private function setIdentifier( $Data ) {

		$this->Identifier = sha1( serialize( $Data ) );

		return $this;
	}

	/**
	 * @param mixed $Data
	 *
	 * @return \MOC\MarkIV\Core\Drive\File\Api
	 */
	private function setCacheFile( $Data ) {

		$Cache = \MOC\MarkIV\Api::groupCore()->unitDrive()->apiFile(
			$this->getLocation()->getLocation().DIRECTORY_SEPARATOR.
			$this->Identifier.'.'.$this->Timeout.'.'.$this->Extension
		)->setContent( $Data )->closeFile();

		/**
		 * Bug: Instant Cache-Timeout on No-Cache-File-Syntax named files
		 * Fix: Set File-Time to Cache-Timeout
		 */
		touch( $Cache->getLocation(), $this->Timeout );

		return $Cache;
	}

	/**
	 * @return \MOC\MarkIV\Core\Drive\Directory\Api
	 */
	private function getLocation() {

		return \MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( $this->Directory->getLocation().DIRECTORY_SEPARATOR.$this->Group, true );
	}

	/**
	 * @param string $Identifier
	 *
	 * @return bool|mixed
	 */
	public function getCacheData( $Identifier ) {

		$this->Identifier = $Identifier;

		if( false == ( $File = $this->getCacheFile() ) ) {
			return false;
		}
		$Data = $File->getContent();
		if( strlen( $Data ) > 0 ) {
			return unserialize( $Data );
		} else {
			return null;
		}
	}

	/**
	 * @param bool|string $Identifier
	 * @param bool        $Prepare
	 *
	 * @return bool|\MOC\MarkIV\Core\Drive\File\Api
	 */
	public function getCacheFile( $Identifier = false, $Prepare = false ) {

		if( $Identifier ) {
			$this->Identifier = $Identifier;
			if( $Prepare == true ) {
				$this->setCacheFile( '' );
			}
		}

		$CacheList = $this->getLocation()->getFileList();
		/** @var \MOC\MarkIV\Core\Drive\File\Api $Cache */
		foreach( (array)$CacheList as $Cache ) {
			if( $this->getIdentifier( $Cache ) == $this->Identifier ) {
				if( $this->getTimestamp( $Cache ) > time() ) {
					if( $this->getExtension( $Cache ) == $this->Extension ) {
						return $Cache;
					}
				} else {
					$this->purgeCache();
				}
			}
		}

		return false;
	}

	/**
	 * Cache-File Name-Convention
	 * [Identifier].[Timestamp].[Extension]
	 */

	/**
	 * @param \MOC\MarkIV\Core\Drive\File\IApiInterface $File
	 *
	 * @return int
	 */
	private function getIdentifier( \MOC\MarkIV\Core\Drive\File\IApiInterface $File ) {

		$Name = explode( '.', $File->getName() );

		return $Name[0];
	}

	/**
	 * @param \MOC\MarkIV\Core\Drive\File\IApiInterface $File
	 *
	 * @return int
	 */
	private function getTimestamp( \MOC\MarkIV\Core\Drive\File\IApiInterface $File ) {

		$Name = explode( '.', $File->getName() );
		if( isset( $Name[1] ) ) {
			return $Name[1];
		}

		return $File->getTime();
	}

	/**
	 * @param \MOC\MarkIV\Core\Drive\File\IApiInterface $File
	 *
	 * @return int
	 */
	private function getExtension( \MOC\MarkIV\Core\Drive\File\IApiInterface $File ) {

		return $File->getExtension();
	}

	/**
	 * @return mixed|void
	 */
	public function purgeCache() {

		$FileList = $this->Directory->getFileList( true );
		/** @var \MOC\MarkIV\Core\Drive\File\Api $File */
		foreach( (array)$FileList as $File ) {
			if( time() > $this->getTimestamp( $File ) ) {
				$File->removeFile();
			}
		}
		$DirectoryList = $this->Directory->getDirectoryList( true );
		/** @var \MOC\MarkIV\Core\Drive\Directory\Api $Directory */
		foreach( (array)$DirectoryList as $Directory ) {
			if( $Directory->checkIsEmpty() ) {
				$Directory->removeDirectory();
			}
		}
	}

}
