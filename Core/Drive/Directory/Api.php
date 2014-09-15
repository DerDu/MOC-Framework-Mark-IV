<?php
namespace MOC\MarkIV\Core\Drive\Directory;

use MOC\MarkIV\Core\Drive\Directory\Utility\Check;

/**
 * Interface IApiInterface
 *
 * @package MOC\MarkIV\Core\Drive\Directory
 */
interface IApiInterface {

	/**
	 * @return bool
	 */
	public function checkExists();

	/**
	 * @return bool
	 */
	public function checkIsEmpty();

	/**
	 * @param bool $Recursive
	 *
	 * @return \MOC\MarkIV\Core\Drive\Directory\Api[]
	 */
	public function getDirectoryList( $Recursive = false );

	/**
	 * @param string $Location
	 *
	 * @return \MOC\MarkIV\Core\Drive\Directory\Api
	 */
	public function getDirectory( $Location );

	/**
	 * @param string $Location
	 *
	 * @return \MOC\MarkIV\Core\Drive\File\Api
	 */
	public function getFile( $Location );

	/**
	 * @return string
	 */
	public function getHash();

	/**
	 * @param bool $Recursive
	 *
	 * @return \MOC\MarkIV\Core\Drive\File\Api[]
	 */
	public function getFileList( $Recursive = false );

	/**
	 * @return string
	 */
	public function getLocation();

	/**
	 * File-Name
	 *
	 * @return null|string
	 */
	public function getName();

	/**
	 * File-Path
	 *
	 * @return null|string
	 */
	public function getPath();

	/**
	 * File-Timestamp
	 *
	 * @return null|int
	 */
	public function getTime();

	/**
	 * @param string $Name
	 *
	 * @return \MOC\MarkIV\Core\Drive\Directory\Api
	 * @throws \Exception
	 */
	public function createDirectory( $Name );

	/**
	 * @return bool
	 * @throws \Exception
	 */
	public function removeDirectory();

	/**
	 * File-Url
	 *
	 * @return string
	 */
	public function getUrl();
}

/**
 * Class Api
 *
 * @package MOC\MarkIV\Core\Drive\Directory
 */
class Api implements IApiInterface {

	/** @var string $Location */
	private $Location = '';

	/**
	 * @param string $Location
	 * @param bool   $createIfNotExists
	 */
	function __construct( $Location, $createIfNotExists = false ) {

		$this->Location = Check::convertCleanPathSyntax( $Location );
		if( $createIfNotExists && !$this->checkExists() ) {
			$this->createDirectory();
		}

		return $this;
	}

	/**
	 * @return bool
	 */
	public function checkExists() {

		if( file_exists( $this->Location ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @param string $Name
	 *
	 * @return Api
	 * @throws \Exception
	 */
	public function createDirectory( $Name = '' ) {

		$Name = Check::convertCleanPathSyntax( $this->Location.DIRECTORY_SEPARATOR.$Name );
		if( !is_dir( $Name ) && !is_file( $Name ) ) {
			if( false === mkdir( $Name, 0777, true ) ) {
				throw new \Exception( 'Unable to create directory!'."\n".$Name );
			} else {
				return $this->getDirectory( $Name );
			}
		} else {
			trigger_error( 'Directory or file exists already!'."\n".$Name );

			return $this->getDirectory( $Name );
		}
	}

	/**
	 * @param string $Location
	 *
	 * @return Api
	 */
	public function getDirectory( $Location ) {

		return new Api( $Location );
	}

	/**
	 * @return bool
	 */
	public function checkIsEmpty() {

		if( !count( $this->getDirectoryList() ) && !count( $this->getFileList() ) ) {
			return true;
		}

		return false;
	}

	/**
	 * @param bool $Recursive
	 *
	 * @return Api[]
	 */
	public function getDirectoryList( $Recursive = false ) {

		if( is_dir( $this->Location ) ) {
			$List = array();
			if( ( $Directory = $this->openDirectoryHandler() ) ) {
				if( $Recursive ) {
					while( false !== ( $Item = $Directory->read() ) ) {
						if( $Item != '.' && $Item != '..' ) {
							$Item = Check::convertCleanPathSyntax( $this->Location.DIRECTORY_SEPARATOR.$Item );
							if( is_dir( $Item ) ) {
								$Recursive = $this->getDirectory( $Item );
								array_push( $List, $this->getDirectory( $Item ) );
								$List = array_merge( $List, $Recursive->getDirectoryList( true ) );
							}
						}
					}
				} else {
					while( false !== ( $Item = $Directory->read() ) ) {
						if( $Item != '.' && $Item != '..' ) {
							$Item = Check::convertCleanPathSyntax( $this->Location.DIRECTORY_SEPARATOR.$Item );
							if( is_dir( $Item ) ) {
								array_push( $List, $this->getDirectory( $Item ) );
							}
						}
					}
				}
			}
			$Directory->close();

			return $List;
		} else {
			return array();
		}
	}

	/**
	 * @return bool|\Directory
	 */
	private function openDirectoryHandler() {

		if( !is_object( $Handler = dir( $this->Location ) ) ) {
			return false;
		}

		return $Handler;
	}

	/**
	 * @param bool $Recursive
	 *
	 * @return \MOC\MarkIV\Core\Drive\File\Api[]
	 */
	public function getFileList( $Recursive = false ) {

		if( is_dir( $this->Location ) ) {
			$List = array();
			if( ( $Directory = $this->openDirectoryHandler() ) ) {
				if( $Recursive ) {
					while( false !== ( $Item = $Directory->read() ) ) {
						if( $Item != '.' && $Item != '..' ) {
							$Item = Check::convertCleanPathSyntax( $this->Location.DIRECTORY_SEPARATOR.$Item );
							if( is_dir( $Item ) ) {
								$Recursive = $this->getDirectory( $Item );
								$List = array_merge( $List, $Recursive->getFileList( true ) );
							} else {
								array_push( $List, $this->getFile( $Item ) );
							}
						}
					}
				} else {
					while( false !== ( $Item = $Directory->read() ) ) {
						if( $Item != '.' && $Item != '..' ) {
							$Item = Check::convertCleanPathSyntax( $this->Location.DIRECTORY_SEPARATOR.$Item );
							if( !is_dir( $Item ) ) {
								array_push( $List, $this->getFile( $Item ) );
							}
						}
					}
				}
			}
			$Directory->close();

			return $List;
		} else {
			return array();
		}
	}

	/**
	 * @param string $Location
	 *
	 * @return \MOC\MarkIV\Core\Drive\File\Api
	 */
	public function getFile( $Location ) {

		return \MOC\MarkIV\Api::groupCore()->unitDrive()->apiFile( $Location );
	}

	/**
	 * @return string
	 */
	public function getHash() {

		return sha1( $this->Location );
	}

	/**
	 * File-Name
	 *
	 * @return string|null
	 */
	public function getName() {

		return pathinfo( $this->Location, PATHINFO_FILENAME );
	}

	/**
	 * File-Timestamp
	 *
	 * @return int|null
	 */
	public function getTime() {

		return $this->CheckExists() ? filemtime( $this->Location ) : null;
	}

	/**
	 * @return string
	 */
	public function getUrl() {

		return $this->fetchScheme().$this->fetchHost().( $this->fetchPort() ? ':'.$this->fetchPort() : '' ).'/'.$this->fetchPath().'/'.basename( $this->getLocation() );
	}

	/**
	 * @return string
	 */
	private function fetchScheme() {

		switch( $this->fetchPort() ) {
			case '80':
				return 'http://';
			case '21':
				return 'ftp://';
			case '443':
				return 'https://';
			default:
				return 'http://';
		}
	}

	/**
	 * @return bool
	 */
	private function fetchPort() {

		if( !isset( $_SERVER['SERVER_PORT'] ) ) {
			return false;
		}

		return $_SERVER['SERVER_PORT'];
	}

	/**
	 * @return string
	 */
	private function fetchHost() {

		if( isset( $_SERVER['SERVER_NAME'] ) ) {
			return $_SERVER['SERVER_NAME'];
		} else {
			return 'localhost';
		}
	}

	/**
	 * @return string
	 */
	private function fetchPath() {

		$Directory = \MOC\MarkIV\Api::groupCore()->unitDrive()->apiDirectory( $this->getPath() );

		return str_replace( '\\', '/', trim( trim( str_replace( \MOC\MarkIV\Api::groupCore()->unitDrive()->getRootDirectory()->getLocation(), '', $Directory->getLocation() ), '\\' ), '/' ) );
	}

	/**
	 * File-Path
	 *
	 * @return string|null
	 */
	public function getPath() {

		return pathinfo( $this->Location, PATHINFO_DIRNAME );
	}

	/**
	 * @return string
	 */
	public function getLocation() {

		return $this->Location;
	}

	/**
	 * @return bool
	 * @throws \Exception
	 */
	public function removeDirectory() {

		if( false === rmdir( $this->Location ) ) {
			throw new \Exception( 'Unable to remove directory!' );
		}

		return true;
	}
}
