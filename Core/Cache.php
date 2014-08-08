<?php
/**
 * LICENSE (BSD)
 *
 * Copyright (c) 2014, Gerd Christian Kunze
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 *
 *  * Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *
 *  * Redistributions in binary form must reproduce the above copyright
 *    notice, this list of conditions and the following disclaimer in the
 *    documentation and/or other materials provided with the distribution.
 *
 *  * Neither the name of Gerd Christian Kunze nor the names of the
 *    contributors may be used to endorse or promote products derived from
 *    this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
 * IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
 * LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * Cache
 * 30.01.2014 11:36
 */
namespace MOC\Core;
use MOC\Api;

/**
 *
 */
class Cache implements \MOC\Binding\Core\Cache {
	/** @var \MOC\Core\Drive\Directory $CacheDirectory */
	private $CacheDirectory = null;

	/**
	 *
	 */
	final function __construct() {
		/** @var \MOC\Core\Drive $Drive */
		$Drive = Api::Factory()->CreateSingleton( '\MOC\Core\Drive' );
		$this->CacheDirectory = $Drive->FetchDirectory()->ExecuteOpen( $Drive->FetchDataDirectory()->GetLocation().DIRECTORY_SEPARATOR.'Cache' );
		if( !$this->CacheDirectory->CheckExists() ) {
			$this->CacheDirectory->ExecuteCreate();
		}
	}

	/** @var int $CacheTimeout */
	private $CacheTimeout = 60;
	/** @var string $CacheIdentifier */
	private $CacheIdentifier = '';
	/** @var string $CacheGroup */
	private $CacheGroup = '';
	/** @var string $CacheExtension */
	private $CacheExtension = 'cache';

	/**
	 * @param int $Seconds
	 *
	 * @return Cache
	 */
	final public function SetCacheTimeout( $Seconds ) {
		$this->CacheTimeout = time() + $Seconds;
		return $this;
	}
	/**
	 * @param mixed $Name
	 *
	 * @return Cache
	 */
	final public function SetCacheGroup( $Name ) {
		$this->CacheGroup = sha1( serialize( $Name ) );
		return $this;
	}
	/**
	 * @param string $Extension
	 *
	 * @return Cache
	 */
	final public function SetCacheExtension( $Extension ) {
		$this->CacheExtension = $Extension;
		return $this;
	}
	/**
	 * @param mixed $Data
	 *
	 * @return string|Cache
	 */
	final public function SetCacheIdentifier( $Data ) {
		$this->CacheIdentifier = sha1( serialize( $Data ) );
		return $this;
	}

	/**
	 * @param null|mixed $Data
	 *
	 * @return Cache
	 */
	final public function SetCacheData( $Data = null ) {
		if( null === $Data ) {
			$this->SetCacheFile( '' );
		} else {
			$this->SetCacheFile( serialize( $Data ) );
		}
		return $this;
	}

	/**
	 * @return bool|mixed
	 */
	final public function GetCacheData() {
		if( false == ( $File = $this->GetCacheFile() ) ) {
			return false;
		}
		$Data = $File->GetContent();
		if( strlen( $Data ) > 0 ) {
			return unserialize( $Data );
		} else {
			return null;
		}
	}

	/**
	 * @return bool|\MOC\Core\Drive\File
	 */
	final private function GetCacheFile() {
		$CacheList = $this->GetCacheLocation()->GetFileList();
		/** @var \MOC\Core\Drive\File $Cache */
		foreach( (array)$CacheList as $Cache ) {
			if( $this->GetCacheIdentifier( $Cache ) == $this->CacheIdentifier ) {
				if( $this->GetCacheTimestamp( $Cache ) > time() ) {
					if( $this->GetCacheExtension( $Cache ) == $this->CacheExtension ) {
						return $Cache;
					}
				} else {
					$this->ExecutePurge();
				}
			}
		}
		return false;
	}

	/**
	 * @param mixed $Data
	 *
	 * @return \MOC\Core\Drive\File
	 */
	final private function SetCacheFile( $Data ) {

		/** @var \MOC\Core\Drive $Drive */
		$Drive = Api::Factory()->CreateSingleton( '\MOC\Core\Drive' );

		$Cache = $Drive->FetchFile()->ExecuteOpen(
			$this->GetCacheLocation()->GetLocation().DIRECTORY_SEPARATOR.
			$this->CacheIdentifier.'.'.$this->CacheTimeout.'.'.$this->CacheExtension
		)->SetContent( $Data )->ExecuteClose();

		/**
		 * Bug: Instant Cache-Timeout on No-Cache-File-Syntax named files
		 * Fix: Set File-Time to Cache-Timeout
		 */
		touch( $Cache->GetLocation(), $this->CacheTimeout );

		return $Cache;
	}

	/**
	 * @return mixed|void
	 */
	final public function ExecutePurge() {

		/** @var \MOC\Core\Drive $Drive */
		$Drive = Api::Factory()->CreateSingleton( '\MOC\Core\Drive' );

		$CacheList = $this->CacheDirectory->GetFileList( true );
		$Directory = null;
		/** @var Drive\File $Cache */
		foreach( (array)$CacheList as $Cache ) {
			// Get Cache Location
			if( $Directory === null ) {
				$Directory = $Drive->FetchDirectory()->ExecuteOpen( $Cache->GetPath() );
			}
			if( $Directory->GetLocation() != $Cache->GetPath() ) {
				if( $Directory->CheckIsEmpty() ) {
					$Directory->ExecuteRemove();
				}
				$Directory = $Drive->FetchDirectory()->ExecuteOpen( $Cache->GetPath() );
			}
			// Remove Cache
			if( time() > $this->GetCacheTimestamp( $Cache ) ) {
				$Cache->ExecuteRemove();
			}
		}
	}

	/**
	 * Cache-File Name-Convention
	 * [Identifier].[Timestamp].[Extension]
	 */

	/**
	 * @param Drive\File $File
	 *
	 * @return int
	 */
	final private function GetCacheExtension( Drive\File $File ) {
		return $File->GetExtension();
	}
	/**
	 * @param Drive\File $File
	 *
	 * @return int
	 */
	final private function GetCacheTimestamp( Drive\File $File ) {
		$Name = explode( '.', $File->GetName() );
		if( isset( $Name[1] ) ) {
			return $Name[1];
		}
		return $File->GetTime();
	}
	/**
	 * @param Drive\File $File
	 *
	 * @return int
	 */
	final private function GetCacheIdentifier( Drive\File $File ) {
		$Name = explode( '.', $File->GetName() );
		return $Name[0];
	}
	/**
	 * @return Drive\Directory
	 */
	final private function GetCacheLocation() {
		/** @var \MOC\Core\Drive $Drive */
		$Drive = Api::Factory()->CreateSingleton( '\MOC\Core\Drive' );
		return $Drive->FetchDirectory()->ExecuteOpen( $this->CacheDirectory->GetLocation().DIRECTORY_SEPARATOR.$this->CacheGroup, true );
	}

}
