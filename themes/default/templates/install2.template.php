<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Install Step 2</title>
	<link rel="stylesheet" type="text/css" href="themes/default/style/install2.css">
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