<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="themes/default/style/signup.css">
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