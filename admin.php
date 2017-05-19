<?php

require('includes/init.php');
$sess->isAdmin();

if (isset($_POST['adm_id']))
	$db->setUtype($_POST['adm_id'], 'admin');
if (isset($_POST['mem_id']))
	$db->setUtype($_POST['mem_id'], 'member');
if (isset($_POST['del_id']))
	$db->deleteUser($_POST['del_id']);
?>
<style>
table {border-collapse: collapse; margin: 0px auto 0px auto}
td {border: 1px solid black; padding: 0px 3px 0px 3px}
form {margin: 0px 5px 0px 5px}
</style>
&nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php'>Back to index</a><br /><br />
<table>
<?php
	// Admin Users
	$users = $db->getUsers();
	foreach ($users as $user) {
		echo '<tr>';
		echo '<td>' . $user->uname . '</td>' . "\n";
		echo '<td><a href="mailto:' . $user->umail . '">' . $user->umail . '</a></td>' . "\n";
		echo '<td>' . $user->utype . '</td>' . "\n";
?>
		<td><form action="admin.php?act=members" method="post">
			<input type="hidden" name="adm_id" value="<?php echo $user->id ?>"/>
			<input type="submit" value="Admin"></form></td>
		<td><form action="admin.php?act=members" method="post">
			<input type="hidden" name="mem_id" value="<?php echo $user->id ?>"/>
			<input type="submit" value="Member"></form></td>
		<td><form action="admin.php?act=members" method="post">
			<input type="hidden" name="del_id" value="<?php echo $user->id ?>"/>
			<input type="submit" value="Delete"></form></td>
		</tr>
<?php
	}
?>
</table>
