<?php

class Database {
	private $host;
	private $username;
	private $password;
	private $dbname;

	protected function connect() {
		$this->host = "localhost";
		$this->username = "root";
		$this->password = "";
		$this->dbname = "sms";

		$con = new mysqli($this->host, $this->username, $this->password, $this->dbname);
		return $con;

	}

}