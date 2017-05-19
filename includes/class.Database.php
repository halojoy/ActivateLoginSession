<?php

class Database extends PDO
{
	public $dsn = "sqlite:includes/datafilename.db3";

	public function __construct()
	{
		$options = array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
		);
		parent::__construct($this->dsn, NULL, NULL, $options);
	}

	public function createTableUsers()
	{
		$sth = $this->prepare(
			"CREATE TABLE IF NOT EXISTS users (
			id INTEGER  PRIMARY KEY,
			uname TEXT  NOT NULL  UNIQUE,
			uhash TEXT  NOT NULL,
			umail TEXT  NOT NULL,
			utype TEXT  NOT NULL,
			ucode TEXT)");
		$sth->execute();
		return;
	}
	
	public function insertAdmin($name, $hash, $mail, $type='admin', $code='')
	{
		$sth = $this->prepare("INSERT INTO users VALUES (?,?,?,?,?,?)");
		$sth->execute(array(null, $name, $hash, $mail, $type, $code));
		return;
	}
	
	public function insertUser($name, $hash, $mail, $type, $code)
	{
		$sth = $this->prepare("INSERT INTO users VALUES (?,?,?,?,?,?)");
		$sth->execute(array(null, $name, $hash, $mail, $type, $code));
		return $this->lastInsertId();
	}

	public function nameCheck($username)
	{
		$sth = $this->prepare("SELECT * FROM users WHERE LOWER(uname)=? LIMIT 1");
		$sth->execute(array(strtolower($username)));
		return $sth->fetch();
	}

	public function emailCheck($useremail)
	{
		$sth = $this->prepare("SELECT umail FROM users WHERE utype<>? AND umail=? LIMIT 1");
		$sth->execute(array('admin', $useremail));
		return $sth->fetch();
	}

	public function getActivate($ucode)
	{
		$sth = $this->prepare("SELECT id FROM users WHERE utype='activate' AND ucode=? LIMIT 1");
		$sth->execute(array($ucode));
		return $sth->fetch();
	}

	public function setActivate($uid)
	{
		$sth = $this->prepare("UPDATE users SET utype=?,ucode=? WHERE id=?");
		$sth->execute(array('member', '', $uid));
		return;
	}

	public function getUsers()
	{
		$sth = $this->prepare("SELECT * FROM users ORDER BY utype, LOWER(uname)");
		$sth->execute();
		return $sth->fetchAll();
	}

	public function setUtype($uid, $usertype)
	{
		$sth = $this->prepare("UPDATE users SET utype=? WHERE id=?");
		$sth->execute(array($usertype, $uid));
		return;
	}
	
	public function deleteUser($uid)
	{
		$sth = $this->prepare("DELETE FROM users WHERE id=?");
		$sth->execute(array($uid));
		return;
	}
}
