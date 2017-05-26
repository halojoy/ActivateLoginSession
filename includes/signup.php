<?php

if (isset($_POST['username'])) {
	extract($_POST);
	$username  = htmlspecialchars(trim($username));
	$username  = str_replace(array('  ','__','--'), array(' ','_','-'), $username);
	$userpass1 = trim($userpass1);
	$userpass2 = trim($userpass2);
	$useremail = strtolower(trim($useremail));
	
	// validate input
	$error = array();
	if (strlen($username) < 4) $error[] = '			- User Name too short';
	if (preg_match('/^[^a-z]/i', $username)) $error[] = '			- User Name must start with A-Z, a-z';
	if (!preg_match('/^[a-z0-9-_ ]+$/i', $username)) $error[] = '			- These chars in User Name: A-Z a-z _- space';
	if (strlen($userpass1) < 6) $error[] = '			- Password too short';
	if ($userpass1 != $userpass2) $error[] = '			- Passwords don\'t match';
	if (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) $error[] = '			- Invalid email format';
	if (preg_match('/@gmail/', $useremail)) $useremail = preg_replace('/\.(?=.*@)/', '', $useremail);
	// echo errors
	if (!empty($error)) {
		$message = '';
		foreach ($error as $msg) $message .= '			- '.$msg."<br />\n";
		include ('themes/'.$theme.'/templates/message.head.php');
		echo $message;
?>
			<br />
			Go back and try again!<br />
			<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="POST">
				<input type="submit" value="Try Again">&nbsp;&nbsp;&nbsp;<a href='index.php'>Cancel</a>
			</form>
<?php
		include ('themes/'.$theme.'/templates/message.foot.php');
	}

	// check username and email in database
	$user = $db->nameCheck($username);
	if ($user) {
		$message = '			User Name already in use.<br />';
	} else {
		$mail = $db->emailCheck($useremail);
		if ($mail) {
			$message = '			Email already in use.<br />';
		} else {
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
			require ('includes/gmailsend.php');
		}
	}
	$db = null;

	include ('themes/'.$theme.'/templates/message.head.php');
	echo $message;
	include ('themes/'.$theme.'/templates/message.foot.php');
}

include ('themes/'.$theme.'/templates/signup.template.php');

?>
