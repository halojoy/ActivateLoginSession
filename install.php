<?php

$step = isset($_POST['step'])? $_POST['step'] : '1';

switch($step) {
	
	case '1':
	
		include('themes/default/templates/install1.template.php');

	break;

	case '2':

		if(isset($_POST['dbfile'])) {

			// create database
			$dbname = $_POST['dbfile'];
			$before = file_get_contents('includes/class.Database.php');
			$after = str_replace('datafilename', $dbname, $before);
			file_put_contents('includes/class.Database.php', $after);
			require('includes/class.Database.php');
			$db = new Database();
			// create table users
			$db->createTableUsers();

			// setup activation mailer
			$gmail = trim($_POST['gmailaccount']);
			$gpass = $_POST['gmailpass'];
			$before = file_get_contents('includes/gmailsend.php');
			$after = str_replace(array('yourgmailaccount','yourgmailpass'), array($gmail, $gpass), $before);
			file_put_contents('includes/gmailsend.php', $after);

			// setup Cookie encrypt
			$chars = 'ABCDEF01234567890123456789';
			$key = substr(str_shuffle($chars), 0, 16);
			$iv  = substr(str_shuffle($chars), 0, 8);
			$before = file_get_contents('includes/class.Session.php');
			$after = str_replace(array('privatekey','privateiv'), array($key, $iv), $before);
			file_put_contents('includes/class.Session.php', $after);

		}

		include('themes/default/templates/install2.template.php');

	break;
	
	case '3':

		// insert admin user
		extract($_POST);
		$adminname  = trim($adminname); //4-20
		$adminname  = str_replace(array('  ','__','--'), array(' ','_','-'), $adminname);
		$adminpass1 = trim($adminpass1);//6-12
		$adminpass2 = trim($adminpass2);//6-12
		$adminemail = trim($adminemail);//9-
		// validate
		$error = array();
		if(strlen($adminname) < 4) $error[] = '			- Admin Name too short';
		if(preg_match('/^[^a-z]/i', $adminname)) $error[] = '			- Admin Name must start with A-Z, a-z';
		if(!preg_match('/^[a-z0-9-_ ]+$/i', $adminname)) $error[] = '			- These chars in Admin Name: A-Z a-z _- space';
		if(strlen($adminpass1) < 6) $error[] = '			- Password too short';
		if($adminpass1 != $adminpass2) $error[] = '			- Passwords don\'t match';
		if (!filter_var($adminemail, FILTER_VALIDATE_EMAIL)) $error[] = '			- Invalid email format';
		if(preg_match('/@gmail/', $adminemail)) $adminemail = preg_replace('/\.(?=.*@)/', '', $adminemail);

		// echo errors
		if(!empty($error)) {
			$message = '';
			foreach($error as $msg) $message .= '			- '.$msg."<br />\n";
			include('themes/default/templates/message.head.php');
			echo $message;
?>
			<br />
			Go back and try again!<br />
			<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="POST">
				<input type="hidden" name="step" value="2">
				<input type="submit" value="Try Again">&nbsp;&nbsp;&nbsp;<a href='index.php'>Cancel</a>
			</form>
<?php
			include('themes/default/templates/message.foot.php');
		}

		//insert admin
		require ('includes/class.Database.php');
		$db = new Database();
		$db->insertAdmin($adminname, sha1($adminpass1), $adminemail);
		$db = null;
		unlink('install.php');
		include('themes/default/templates/message.head.php');
?>
			Your install is now completed.<br />
			The install.php has been deleted.<br />
			You may go to the index page and login:<br />
			Your Admin name is: <b><?php echo $adminname; ?></b><br />
<?php
		include('themes/default/templates/message.foot.php');

	break;
}

exit();

?>
