<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Admin Users</title>
		<link rel="stylesheet" type="text/css" href="themes/default/style/admin.css">
	</head>
	<body>

<?php include('themes/default/templates/header.php'); ?>

		<div id="contents">
			<p class="headline">Admin Users</p>
			<p><table>
<?php
	// Admin Users
	$users = $db->getUsers();
	foreach ($users as $user) {
		echo '				<tr>'."\n";
		echo '				<td>' . $user->uname . '</td>' . "\n";
		echo '				<td><a href="mailto:' . $user->umail . '">' . $user->umail . '</a></td>' . "\n";
		echo '				<td>' . $user->utype . '</td>' . "\n";
?>
				<td class="button"><form action="?act=admin" method="post">
					<input type="hidden" name="adm_id" value="<?php echo $user->id ?>"/>
					<input class="admbutton" type="submit" value="Admin"></form></td>
				<td class="button"><form action="?act=admin" method="post">
					<input type="hidden" name="mem_id" value="<?php echo $user->id ?>"/>
					<input class="admbutton" type="submit" value="Member"></form></td>
				<td class="button"><form action="?act=admin" method="post">
					<input type="hidden" name="del_id" value="<?php echo $user->id ?>"/>
					<input class="admbutton" type="submit" value="Delete"></form></td>
				</tr>
<?php } ?>
			</table></p>
		</div>
		
<?php include('themes/default/templates/footer.php'); ?>

	</body>
</html>