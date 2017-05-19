<?php

if($sess->logged) {
	header('location:index.php');
	exit();
}

if(isset($_POST['username'])) {
	$username = htmlspecialchars(trim($_POST['username']));
	$password = trim($_POST['password']);
	$passhash = sha1($password);
	if (empty($username) || empty($password)) {
		header('location:index.php');
		exit();
	}
	$error = '';
	$user = $db->nameCheck($username);
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
	if(!empty($error)) {
		include('includes/msghead.php');
		echo $error;
		include('includes/msgfoot.php');
	}
	// Everything is good!
	$sess->Login($user);
	header('location:index.php');
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<style type="text/css">
		fieldset{margin-left:20em; width:32em}
		#headline{text-align:center}
		#headtext{font-size:150%; font-weight:bold}
		.adj{width:8em; text-align:right}
		input{border:1px solid black}
	</style>
</head>
<body>

<fieldset id="headline">
	<span id="headtext">Login</span>
</fieldset>

<fieldset>
<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="POST">
<table>
	<tr><td>&nbsp;</td><td></td></tr>
	<tr>
		<td class="adj"><label>User Name</label></td>
		<td><input type="text" name="username" size="30" maxlength="20" required></td></tr>
	<tr>
		<td class="adj"><label>Password</label></td>
		<td><input type="password" name="password" size="30" maxlength="12" required></td></tr>
	<tr><td>&nbsp;</td><td></td></tr>
	<tr>
		<td class="adj"></td>
		<td><input type="submit" value="SUBMIT">&nbsp;&nbsp;&nbsp;<a href="index.php">Cancel</a></td></tr>
</table>
</form>
</fieldset>

</body>
</html>