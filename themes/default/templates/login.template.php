<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
<link rel="stylesheet" type="text/css" href="themes/default/style/login.css">
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