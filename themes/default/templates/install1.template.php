<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Install Step 1</title>
	<link rel="stylesheet" type="text/css" href="themes/default/style/install1.css">
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