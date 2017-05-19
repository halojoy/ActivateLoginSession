<?php
require('includes/init.php');
//action
$action = isset($_GET['act']) ? $_GET['act'] : 'index';
switch ($action) {
	case 'login':
	case 'signup':
	case 'logout':
	case 'activation':
		require('includes/'.$action.'.php');
		exit();
		break;

	case 'memberpage':
		require('mypages/'.$action.'.php');
		exit();
		break;

	case 'index':
	default:
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Index Page</title>
		<style>
			#loginmenu {border-bottom:1px solid black}
			#loginmenu a:link,a:visited {color:blue; text-decoration:none}
			#loginmenu a:hover {color:red; text-decoration:underline}
			#menuitems {margin-left:240px}
		</style>
	</head>
	<body>
		<div id="header">
			<div id="loginmenu">
				<span id="menuitems"><?php echo $loginmenu; ?></span>
			</div>
		</div>
		
		<div id="contents">
			<?php
			if($sess->logged) {
			?>
				<a href='index.php?act=memberpage'>Memberpage</a><br />

			<?php
			}
			?>
		</div>
		
		<div id="footer">
		</div>
	</body>
</html>
