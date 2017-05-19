<?php

if(isset($_POST['username'])) {
	extract($_POST);
	$username  = htmlspecialchars(trim($username));
	$userpass1 = trim($userpass1);
	$userpass2 = trim($userpass2);
	$useremail = strtolower(trim($useremail));
	
	// validate input
	$error = array();
	if(strlen($username) < 4) $error[] = 'User Name too short';
	if(preg_match('/^[^a-z]/i', $username)) $error[] = 'User Name must start with A-Z, a-z';
	if(!preg_match('/^[a-z0-9-_ ]+$/i', $username)) $error[] = 'You have forbidden char in User Name';
	if(strlen($userpass1) < 6) $error[] = 'Password too short';
	if($userpass1 != $userpass2) $error[] = 'Passwords don\'t match';
	if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) $error[] = 'Invalid email format';
	if(preg_match('/@gmail/', $useremail)) $useremail = preg_replace('/\.(?=.*@)/', '', $useremail);
	// echo errors
	if(!empty($error)) {
		$message = '';
		foreach($error as $msg) $message .= '			- '.$msg."<br />\n";
		include('includes/msghead.php');
		echo $message;
?>
			<br />
			Go back and try again!<br />
			<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="POST">
				<input type="hidden" name="step" value="2">
				<input type="submit" value="Try Again">&nbsp;&nbsp;&nbsp;<a href='index.php'>Cancel</a>
			</form>
<?php
		include('includes/msgfoot.php');
	}
	// check username and email in database
	$user = $db->nameCheck($username);
	if($user) {
		$message = '			User Name already in use.<br />';
	}else{
		$mail = $db->emailCheck($useremail);
		if($mail) {
			$message = '			Email already in use.<br />';
		}else{
			// insert user
			$userhash = sha1($userpass1);
			$usercode = sha1($username . time());
			$usertype = 'activate';
			$userid = $db->insertUser($username, $userhash, $useremail, $usertype, $usercode);
			// send mail
			$host = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
			$subject  = 'Activation of account at '.$_SERVER['SERVER_NAME'];
			$body = 'Activation of your account at '.$_SERVER['SERVER_NAME'].'.<br />'.
					'To activate your account<br />'.
					'Please click the link here below!<br /><br />'.
					'<a href="'.$host.'?act=activation&ucode='.$usercode.'">Activate your account</a>';
			require('includes/gmailsend.php');
		}
	}
	include('includes/msghead.php');
	echo $message;
	include('includes/msgfoot.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
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
	<span id="headtext">Sign Up</span>
</fieldset>

<fieldset>
<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="POST">
<table>
	<tr><td>&nbsp;</td><td></td></tr>
	<tr>
		<td class="adj"><label>User Name</label></td>
		<td><input type="text" name="username" size="25" maxlength="20" required> 4-20 chars</td></tr>
	<tr><td>&nbsp;</td><td></td></tr>
	<tr>
		<td class="adj"><label>Password</label></td>
		<td><input type="password" name="userpass1" size="25" maxlength="12" required> 6-12 chars</td></tr>
	<tr>
		<td class="adj"><label>Password Again</label></td>
		<td><input type="password" name="userpass2" size="25" maxlength="12" required> 6-12 chars</td></tr>
	<tr><td>&nbsp;</td><td></td></tr>
	<tr>
		<td class="adj"><label>User Email</label></td>
		<td><input type="text" name="useremail" size="55" required></td></tr>
	<tr><td>&nbsp;</td><td></td></tr>
	<tr>
		<td class="adj"></td>
		<td><input type="submit" value="SUBMIT">&nbsp;&nbsp;&nbsp;<a href="index.php">Cancel</a></td></tr>
</table>
</form>
</fieldset>

</body>
</html>