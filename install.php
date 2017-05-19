<?php

$step = isset($_POST['step'])? $_POST['step'] : '1';

switch($step) {
	
	case '1':
?>
<!DOCTYPE html>
<html>
<head>
	<title>Install Step 1</title>
	<style type="text/css">
		fieldset{margin-left:20em; width:34em}
		#headline{text-align:center}
		#headtext{font-size:150%; font-weight:bold}
		.adj{width:9em; text-align:right}
		input{border:1px solid black}
	</style>
</head>
<body>

<fieldset id="headline">
	<span id="headtext">INSTALL Step 1</span>
</fieldset>

<fieldset>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES); ?>" method="POST">
<table>
	<tr><td>&nbsp;</td><td></td></tr>
	<tr>
		<td class="adj"><label>Databasefile</label></td>
		<td><input type="text" name="dbfile" size="30" maxlength="25" required>.db3</td></tr>
	<tr>
		<td></td><td>Add name of sqlite database file.<br />
					Can be 'mydata', 'database' or something like.<br />
					Do not add extension.<br />
					Extension '.db3' will be added automatically.</td></tr>
	<tr><td>&nbsp;</td><td></td></tr>
	<tr>
		<td class="adj"><label>Your Gmail Account</label></td>
		<td><input type="text" name="gmailaccount" size="45" required></td></tr>
	<tr>
		<td></td><td>Needed for to send activation emails.</td></tr>
	<tr><td>&nbsp;</td><td></td></tr>
	<tr>
		<td class="adj"><label>Your Gmail Password</label></td>
		<td><input type="password" name="gmailpass" size="30" required></td></tr>
	<tr>
		<td></td><td>Needed for to send activation emails.</td></tr>
	<tr><td>&nbsp;</td><td></td></tr>
	<tr>
		<td class="adj"></td>
		<td><input type="submit" value="SUBMIT"></td></tr>
</table>
<input type="hidden" name="step" value="2">
</form>
</fieldset>

</body>
</html>
<?php
	break;
	
	case '2':

if(isset($_POST['dbfile'])) {
	// create database
	$dbname = $_POST['dbfile'];
	$before = file_get_contents('includes/class.Database.php');
	$after = str_replace('datafilename', $dbname, $before);
	file_put_contents('includes/class.Database.php', $after);
	
	$gmail = trim($_POST['gmailaccount']);
	$gpass = $_POST['gmailpass'];
	$before = file_get_contents('includes/gmailsend.php');
	$after = str_replace(array('yourgmailaccount','yourgmailpass'), array($gmail, $gpass), $before);
	file_put_contents('includes/gmailsend.php', $after);
	
	require('includes/class.Database.php');
	$db = new Database();
	// create table users
	$db->createTableUsers();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Install Step 2</title>
	<style type="text/css">
		fieldset{margin-left:20em; width:34em}
		#headline{text-align:center}
		#headtext{font-size:150%; font-weight:bold}
		.adj{width:9em; text-align:right}
		input{border:1px solid black}
	</style>
</head>
<body>

<fieldset id="headline">
	<span id="headtext">Step 2 Add Admin</span>
</fieldset>

<fieldset>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES); ?>" method="POST">
<table>
	<tr><td>&nbsp;</td><td></td></tr>
	<tr>
		<td class="adj"><label>Admin Name</label></td>
		<td><input type="text" name="adminname" size="25" maxlength="20" required> 4-20 chars</td></tr>
	<tr><td>&nbsp;</td><td></td></tr>
	<tr>
		<td class="adj"><label>Password</label></td>
		<td><input type="password" name="adminpass1" size="25" maxlength="12" required> 6-12 chars</td></tr>
	<tr>
		<td class="adj"><label>Password Again</label></td>
		<td><input type="password" name="adminpass2" size="25" maxlength="12" required> 6-12 chars</td></tr>
	<tr><td>&nbsp;</td><td></td></tr>
	<tr>
		<td class="adj"><label>Admin Email</label></td>
		<td><input type="text" name="adminemail" size="45" required></td></tr>
	<tr><td>&nbsp;</td><td></td></tr>
	<tr>
		<td class="adj"></td>
		<td><input type="submit" value="SUBMIT"></td></tr>
</table>
<input type="hidden" name="step" value="3">
</form>
</fieldset>

</body>
</html>
<?php
	break;
	
	case '3':

// insert admin user
extract($_POST);
$adminname  = trim($adminname); //4-20
$adminname  = str_replace('  ', ' ', $adminname);
$adminpass1 = trim($adminpass1);//6-12
$adminpass2 = trim($adminpass2);//6-12
$adminemail = trim($adminemail);//9-
// validate
$error = array();
if(strlen($adminname) < 4) $error[] = '			- Admin Name too short';
if(preg_match('/^[^a-z]/i', $adminname)) $error[] = '			- Admin Name must start with A-Z, a-z';
if(!preg_match('/^[a-z0-9-_ ]+$/i', $adminname)) $error[] = '			- You have forbidden char in Admin Name';
if(strlen($adminpass1) < 6) $error[] = '			- Password too short';
if($adminpass1 != $adminpass2) $error[] = '			- Passwords don\'t match';
if (!filter_var($adminemail, FILTER_VALIDATE_EMAIL)) $error[] = '			- Invalid email format';
if(preg_match('/@gmail/', $adminemail)) $adminemail = preg_replace('/\.(?=.*@)/', '', $adminemail);
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
//insert admin
require ('includes/class.Database.php');
$db = new Database();
$db->insertAdmin($adminname, sha1($adminpass1), $adminemail);
$db = null;
unlink('install.php');
?>
Your install is now completed.<br />
The install.php has been deleted.<br />
You may go to the index page and login:<br />
Your Admin name is: <b><?php echo $adminname; ?></b><br />
<a href='index.php'>To Index Page</a>
<?php
	break;
}

exit();