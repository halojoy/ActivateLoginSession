<?php

$databasefile = false;
foreach (scandir('includes') as $filename) {
	if (preg_match("/\.db3$/", $filename))
		$databasefile = $filename;
}
if (!$databasefile) {
	header('location:install.php');
	exit();
}
require ('includes/class.Database.php');
$db = new Database();

require ('includes/class.Session.php');
$sess = new Session($db);

if (!$sess->logged)
	$loginmenu = '<a href="index.php?act=login">Login</a>'.
			'&nbsp;&nbsp;&nbsp;<a href="index.php?act=signup">SignUp</a>';
else {
	$loginmenu = '<a href="index.php?act=logout">Logout</a> '.$sess->username;
	if($sess->usertype == 'admin')
		$loginmenu .= '&nbsp;&nbsp;&nbsp;<a href="?act=admin">AdminUsers</a>';
}

// CONFIG
$theme = 'default';
define('SENDMAIL', true); // true or 'false' if no email activation
