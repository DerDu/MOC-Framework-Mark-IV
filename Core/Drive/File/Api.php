<?php
namespace MOC\IV\Core\Drive\File;

use MOC\IV\Core\Drive\Directory\Utility\Check;

interface IApiInterface {

	const MODE_APPEND = 'a';
	const MODE_WRITE = 'w';
	const MODE_WRITE_BINARY = 'wb';

	/**
	 * @param string      $Mode (CLOSE_MODE_APPEND|CLOSE_MODE_WRITE|CLOSE_MODE_WRITE_BINARY)
	 * @param null|string $Location
	 *
	 * @return Api
	 */
	public function closeFile( $Mode = self::MODE_WRITE_BINARY, $Location = null );

	/**
	 * File-Size
	 *
	 * @return null|int
	 */
	public function getSize();

	/**
	 * @return bool
	 */
	public function checkExists();

	/**
	 * File-Name
	 *
	 * @return null|string
	 */
	public function getName();

	/**
	 * @return string
	 */
	public function getLocation();

	/**
	 * File-Path
	 *
	 * @return null|string
	 */
	public function getPath();

	/**
	 * File-Url
	 *
	 * @return string
	 */
	public function getUrl();

	/**
	 * File-Move
	 *
	 * @param string $Location
	 *
	 * @return bool
	 */
	public function moveFile( $Location );

	/**
	 * File-Touch
	 *
	 * @return bool
	 */
	public function touchFile();

	/**
	 * @return string
	 */
	public function getHash();

	/**
	 * File-Name (Name + Extension)
	 *
	 * @return null|string
	 */
	public function getFullName();

	/**
	 * @return bool|null|string
	 */
	public function getContent();

	/**
	 * File-Remove
	 *
	 * @return bool
	 */
	public function removeFile();

	/**
	 * File-Copy
	 *
	 * @param string $Location
	 *
	 * @return bool
	 */
	public function copyFile( $Location );

	/**
	 * @param string $Content
	 *
	 * @return Api
	 */
	public function setContent( $Content );

	/**
	 * File-Extension
	 *
	 * @return null|string
	 */
	public function getExtension();

	/**
	 * File-Timestamp
	 *
	 * @return null|int
	 */
	public function getTime();
}

class Api implements IApiInterface {

	/** @var string $Location */
	private $Location = '';
	/** @var null|string $Content */
	private $Content = null;

	/**
	 * @param string $Location
	 */
	function __construct( $Location ) {
		$this->Location = Check::convertCleanPathSyntax( $Location );
		return $this;
	}

	/**
	 * @return string
	 */
	final public function getLocation() {
		return $this->Location;
	}

	/**
	 * @param string $Mode (MODE_APPEND|MODE_WRITE|MODE_WRITE_BINARY)
	 * @param null|string $Location
	 *
	 * @return Api
	 */
	final public function closeFile( $Mode = self::MODE_WRITE_BINARY, $Location = null ) {
		if( null == $Location || $this->Location == $Location ) {
			$Mode = $this->fetchWriteMode( $Mode );
			if( is_array( $this->Content ) ) {
				if( !$this->lockWrite( $this->Location, implode( PHP_EOL, $this->Content ), $Mode ) ) {
					return false;
				}
			} else {
				if( !$this->lockWrite( $this->Location, $this->Content, $Mode ) ) {
					return false;
				}
			}
			return $this;
		} else if( null != $Location && $this->Location != $Location ) {
			$Mode = $this->fetchWriteMode( $Mode );
			if( is_array( $this->Content ) ) {
				if( !$this->lockWrite( $Location, implode( PHP_EOL, $this->Content ), $Mode ) ) {
					return false;
				}
			} else {
				if( !$this->lockWrite( $Location, $this->Content, $Mode ) ) {
					return false;
				}
			}
			$this->Location = $Location;
			return $this;
		}
		return $this;
	}


	/**
	 * @return bool
	 */
	final public function checkExists() {
		if( file_exists( $this->Location ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @return string
	 */
	final public function getHash() {
		return ( file_exists( $this->Location ) ? sha1_file( $this->Location ) : sha1( $this->Location ) );
	}

	/**
	 * @return bool|null|string
	 */
	final public function getContent() {
		// Read from File
		if( $this->checkExists() && $this->Content === null ) {
			$this->Content = file_get_contents( $this->Location );
		}
		return $this->Content;
	}

	/**
	 * @param string $Content
	 *
	 * @return Api
	 */
	final public function setContent( $Content ) {
		$this->Content = $Content;
		return $this;
	}

	/**
	 * File-Name
	 *
	 * @return string|null
	 */
	final public function getName() {
		return pathinfo( $this->Location, PATHINFO_FILENAME );
	}

	/**
	 * File-Name (Name + Extension)
	 *
	 * @return string|null
	 */
	final public function getFullName() {
		return $this->getName().( $this->getExtension() != null ? '.'.$this->getExtension() : '' );
	}

	/**
	 * File-Extension
	 *
	 * @return string|null
	 */
	final public function getExtension() {
		return pathinfo( $this->Location, PATHINFO_EXTENSION );
	}

	/**
	 * File-Path
	 *
	 * @return string|null
	 */
	final public function getPath() {
		return pathinfo( $this->Location, PATHINFO_DIRNAME );
	}

	/**
	 * File-Size
	 *
	 * @return int|null
	 */
	final public function getSize() {
		return $this->checkExists() ? filesize( $this->Location ) : null;
	}

	/**
	 * File-Timestamp
	 *
	 * @return int|null
	 */
	final public function getTime() {
		return $this->checkExists() ? filemtime( $this->Location ) : null;
	}

	/**
	 * @return string
	 */
	public function GetUrl() {
		return $this->fetchScheme().$this->fetchHost().( $this->fetchPort()?':'.$this->fetchPort():'' ).'/'.$this->fetchPath().'/'.basename( $this->getLocation() );
	}

	/**
	 * File-Copy
	 *
	 * @param string $Location
	 *
	 * @return bool
	 */
	final public function copyFile( $Location ) {
		if( file_exists( $this->Location ) ) {
			if( copy( $this->Location, Check::convertCleanPathSyntax( $Location ) ) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * File-Move
	 *
	 * @param string $Location
	 *
	 * @return bool
	 */
	final public function moveFile( $Location ) {
		if( file_exists( $this->Location ) ) {
			if( ($Return = $this->lockRename( $Location )) ) {
				$this->Location = $Location;
			}
			return $Return;
		}
		return false;
	}

	/**
	 * File-Remove
	 *
	 * @return bool
	 */
	final public function removeFile() {
		if( file_exists( $this->Location ) ) {
			return $this->lockRemove();
		}
		return false;
	}

	/**
	 * File-Touch
	 *
	 * @return bool
	 */
	final public function touchFile() {
		if( strlen( $this->Location ) > 0 ) {
			fclose( fopen( $this->Location, 'a' ) );
			return true;
		} else {
			return false;
		}
	}


	/**
	 * @param null|string $Location
	 * @param null|string $Content
	 * @param string      $Mode
	 *
	 * @return bool
	 * @throws \Exception
	 */
	final private function lockWrite( $Location = null, $Content = null, $Mode = null ) {
		$Mode = $this->fetchWriteMode( $Mode );
		switch( strtoupper( $Mode ) ) {
			case 'A': {
			if( ( $Handler = fopen( $this->Location, 'a' ) ) !== false	) {
				if( fwrite( $Handler, $Content ) === false ) {
					return false;
				}
				if( fclose( $Handler ) === false ) {
					return false;
				}
				return true;
			}
			return false;
			break;
			}
			default: {

			// OPEN CACHE
			$CacheFile = new Api( $this->fetchCacheFile() );
			if( ( $CacheHandler = fopen( $CacheFile->getLocation(), $Mode ) ) === false	) {
				throw new \Exception( 'Cache-Access failed!' );
			}
			// LOCK / WRITE TO CACHE
			$CacheTimeout = 15;
			while( flock( $CacheHandler, LOCK_EX | LOCK_NB ) === false && $CacheTimeout > 0 ) {
				usleep( round( rand( 1,1000 )*1000 ) );
				$CacheTimeout--;
			}
			if( ! $CacheTimeout > 0 ) {
				throw new \Exception( 'Cache-Lock failed!' );
			}
			if( fwrite( $CacheHandler, $Content ) === false ) {
				throw new \Exception( 'Cache-Write failed!' );
			}
			// UNLOCK / CLOSE CACHE
			if( flock( $CacheHandler, LOCK_UN ) === false ) {
				throw new \Exception( 'Cache-UnLock failed!' );
			}
			if( fclose( $CacheHandler ) === false ) {
				throw new \Exception( 'Cache-Close failed!' );
			}
			$Timeout = 15;
			while( ( $Check = $this->lockRemove() ) === false && $Timeout > 0 ) {
				usleep( round( rand( 1,1000 )*1000 ) );
				$Timeout--;
			}
			if( $Check === false ) {
				throw new \Exception( 'File-UnLink failed!' );
			}

			$Timeout = 15;
			while( ( $Check = $CacheFile->lockRename( $Location ) ) === false && $Timeout > 0 ) {
				usleep( round( rand( 1,1000 )*1000 ) );
				$Timeout--;
			}
			if( $Check === false ) {
				throw new \Exception( 'File-Write failed!' );
			}
			return true;
			}
		}
	}

	/**
	 * @param string $Location
	 * @param int    $Timeout
	 *
	 * @return bool
	 */
	final private function lockRename( $Location, $Timeout = 15 ) {
		if( is_file( $this->Location ) ) {
			if(
				( false !== ( $HandlerA = fopen( $this->Location, "r" ) ) )
				&& ( false !== ( $HandlerB = fopen( $Location, "w" ) ) )
			){
				$TimeoutA = $TimeoutB = $Timeout;
				while( flock( $HandlerA, LOCK_EX | LOCK_NB ) === false && $TimeoutA > 0 ) {
					usleep( round( rand( 1,1000 )*1000 ) );
					$TimeoutA--;
				}
				if( $TimeoutA > 0 ) {
					while( flock( $HandlerB, LOCK_EX | LOCK_NB ) === false && $TimeoutB > 0 ) {
						usleep( round( rand( 1,1000 )*1000 ) );
						$TimeoutB--;
					}
					if( $TimeoutB > 0 ) {
						flock( $HandlerA, LOCK_UN );
						fclose( $HandlerA );
						flock( $HandlerB, LOCK_UN );
						fclose( $HandlerB );
						return rename( $this->Location, $Location );
					}
				}
				flock( $HandlerA, LOCK_UN );
				fclose( $HandlerA );
				fclose( $HandlerB );
			}
		}
		return false;
	}

	/**
	 * @param int $Timeout
	 *
	 * @return bool
	 */
	final private function lockRemove( $Timeout = 15 ) {
		if( is_file( $this->Location ) ) {
			if( false !== ( $Handler = fopen( $this->Location, "w" ) ) ) {
				while( flock( $Handler, LOCK_EX | LOCK_NB ) === false && $Timeout > 0 ) {
					usleep( round( rand( 1,1000 )*1000 ) );
					$Timeout--;
				}
				if( $Timeout > 0 ) {
					flock( $Handler, LOCK_UN );
					fclose( $Handler );
					return unlink( $this->Location );
				}
				fclose( $Handler );
			}
		} else {
			return true;
		}
		return false;
	}

	/**
	 * File-Write-Cache
	 *
	 * @return string
	 * @throws \Exception
	 */
	final private function fetchCacheFile() {
		if( ( $CacheFile = tempnam( ini_get('upload_tmp_dir'), 'write' ) ) === false ) {
			throw new \Exception( 'Cache-Access failed!' );
		}
		return $CacheFile;
	}

	/**
	 * File-Write-Mode
	 *
	 * @param int|string $Mode
	 *
	 * @return string
	 */
	final private function fetchWriteMode( $Mode ) {
		switch( $Mode ) {
			case 1: { return self::MODE_APPEND; }
			case 2: { return self::MODE_WRITE; }
			case 3: { return self::MODE_WRITE_BINARY; }
			case self::MODE_APPEND: { return self::MODE_APPEND; }
			case self::MODE_WRITE: { return self::MODE_WRITE; }
			case self::MODE_WRITE_BINARY: { return self::MODE_WRITE_BINARY; }
			default: { return self::MODE_WRITE_BINARY; }
		}
	}

	/**
	 * @return string
	 */
	final private function fetchPath() {
		$Directory = \MOC\IV\Api::groupCore()->unitDrive()->apiDirectory( $this->getPath() );
		return str_replace( '\\', '/', trim( trim( str_replace( \MOC\IV\Api::groupCore()->unitDrive()->getRootDirectory()->getLocation(), '', $Directory->getLocation() ), '\\'), '/' ) );
	}

	/**
	 * @return string
	 */
	final private function fetchHost() {
		return $_SERVER['SERVER_NAME'];
	}

	/**
	 * @return string
	 */
	final private function fetchScheme() {
		switch( $this->fetchPort() ) {
			case '80': return 'http://';
			case '21': return 'ftp://';
			case '443': return 'https://';
			default: return 'http://';
		}
	}

	/**
	 * @return bool
	 */
	final private function fetchPort() {
		if( !isset( $_SERVER['SERVER_PORT'] ) ) {
			return false;
		}
		return $_SERVER['SERVER_PORT'];
	}
}
