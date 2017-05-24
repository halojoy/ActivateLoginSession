<?php

if ($sess->logged) {
	header('location:index.php');
	exit();
}

if (isset($_POST['username'])) {
	$username = htmlspecialchars(trim($_POST['username']));
	$password = trim($_POST['password']);
	$passhash = sha1($password);
	if (empty($username) || empty($password)) {
		header('location:index.php');
		exit();
	}
	$error = '';
	$user = $db->nameCheck($username);
	$db = null;
	if (!$user) {
		$error = '			Not a valid log in.<br />
			You should check your username and password.<br />';
	} elseif ($user->uhash != $passhash) {
		$error = '			Not a valid log in.<br />
			You should check your username and password.<br />';
	} elseif ($user->utype == 'activate') {
		$error = '			You can not log in now.<br />
			Please activate your account.<br />';
	}
	if (!empty($error)) {
		include ('themes/'.$theme.'/templates/message.head.php');
		echo $error;
		include ('themes/'.$theme.'/templates/message.foot.php');
	}
	// Everything is good!
	$sess->Login($user);
	header('location:index.php');
	exit();
}

include ('themes/'.$theme.'/templates/login.template.php');

?>
