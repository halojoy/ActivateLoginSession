<?php

class Session
{
	public $logged;
	public $userid = '';
	public $username = '';
	public $usertype = '';
	public $lifetime = 3600*24*30; // Cookie for one month
	private $secret = '1B852E5F70414C66';
	private $iv     = '9D252E50';

	public function __construct($db)
	{
		if (isset($_COOKIE['userdata'])) {
			$cookiedata = openssl_decrypt($_COOKIE['userdata'], 'blowfish', $this->secret, 0, $this->iv);
			$userdata = explode('&', $cookiedata);
			if(count($userdata) != 3) {
				$this->Logout();
				return;
			}
			$this->userid   = $userdata[0];
			$this->username = $userdata[1];
			$this->usertype = $userdata[2];
			if(!$db->nameCheck($this->username)){
				$this->Logout();
				return;
			}
			$this->logged = true;
		} else {
			$this->logged = false;
		}
	}

	public function Login($user)
	{
		$ustring = implode('&', array($user->id, $user->uname, $user->utype));
		$encoded = openssl_encrypt($ustring, 'blowfish', $this->secret, 0, $this->iv);
		setcookie('userdata', $encoded, time()+$this->lifetime);
		$this->logged = true;
	}

	public function Logout()
	{
		setcookie('userdata', '', time()-10);
		$this->logged = false;
	}

	public function	isLogged()
	{
		if (!$this->logged) {
			header('location:index.php');
			exit();
		}
	}

	public function	isAdmin()
	{
		if ($this->usertype != 'admin') {
			header('location:index.php');
			exit();
		}
	}
}

?>
