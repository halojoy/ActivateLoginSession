<?php

class Session
{

	public $logged;
	public $userid = '';
	public $username = '';
	public $usertype = '';

	public function __construct()
	{
		session_start();
		if (isset($_SESSION['userid'])) {
			$this->userid   = $_SESSION['userid'];
			$this->username = $_SESSION['username'];
			$this->usertype = $_SESSION['usertype'];
			$this->logged = true;
		} else {
			$this->logged = false;
		}
	}

	public function Login($user)
	{
		$_SESSION['userid']   = $user->id;
		$_SESSION['username'] = $user->uname;
		$_SESSION['usertype'] = $user->utype;
	}

	public function Logout()
	{
		$_SESSION = array();
		session_destroy();
		$this->logged = false;
	}

	public function	isAdmin()
	{
		if ($this->usertype != 'admin') {
			header('location:index.php');
			exit();
		}
	}

	public function	isLogged()
	{
		if (!$this->logged) {
			header('location:index.php');
			exit();
		}
	}
}

?>
