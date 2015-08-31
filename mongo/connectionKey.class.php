<?php

/**
* Chaves de conexao
*/
class ConnectionKey
{
	private $user;
	private $pass;
	private $host;
	private $port;
	
	function __construct() {
		self::setUser('jean');
		self::setPass('123');
		self::setHost('localhost');
		self::setPort('27017');
	}

	private function setUser( $user ) { //Set
		$this->user = $user;
	}

	public function getUser() { //Get
		return $this->user;
	}

	private function setPass( $pass ) { //Set
		$this->pass = $pass;
	}

	public function getPass() { //Get
		return $this->pass;
	}

	private function setHost( $host ) { //Set
		$this->host = $host;
	}

	public function getHost() { //Get
		return $this->host;
	}

	private function setPort( $port ) { //Set
		$this->port = $port;
	}

	public function getPort() { //Get
		return $this->port;
	}
}