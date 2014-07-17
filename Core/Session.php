<?php
namespace MOC\IV\Core;

interface ISession {
	public function openSession();
	public function closeSession();

	public function setSessionId( $SessionId );
	public function regenerateSessionId();
	public function getSessionId();

	public function readFromSession( $Key = null );
	public function writeToSession( $Key, $Value );
}

class Session implements ISession {

	private $SessionIdentifier = __CLASS__;

	public function openSession() {
		if( !strlen( session_id() ) > 0 ) {
			session_start();
			if( !isset( $_SESSION[$this->SessionIdentifier] ) ) {
				$_SESSION[$this->SessionIdentifier] = array();
			}
		}
		return $this;
	}

	public function closeSession() {
		session_write_close();
		return $this;
	}

	public function setSessionId( $SessionId ) {
		$this->openSession();
		session_id( $SessionId );
		return $this;
	}

	public function regenerateSessionId() {
		session_regenerate_id();
		return $this;
	}

	public function getSessionId() {
		$this->openSession();
		return session_id();
	}

	public function writeToSession( $Key, $Value ) {
		$this->openSession();
		$_SESSION[$this->SessionIdentifier][$Key] = $Value;
		return $this;
	}

	public function readFromSession( $Key = null ) {
		$this->openSession();
		if( $Key !== null ) {
			if( isset( $_SESSION[$this->SessionIdentifier][$Key] ) ) {
				return $_SESSION[$this->SessionIdentifier][$Key];
			} else {
				return null;
			}
		} return $_SESSION[$this->SessionIdentifier];
	}
}
