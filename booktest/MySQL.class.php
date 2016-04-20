<?php
class MySQL extends Database {
	protected $dbh;
	protected $query;

	public function connect($server, $username, $password, $database) {
		$this->dbh = new PDO("mysql:host=$server;dbname=$database;charset=utf8;port=3306",$username,$password);
	}
	public function query($sql) {
		$this->query = $this->dbh->query($sql);
	}
	public function fetch() {
		return $this->query->fetchAll();
	}
	public function close() {
		$this->dbh = null;
	}
}