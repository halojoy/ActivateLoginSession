<?php $sess->isLogged(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Member Page</title>
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
			This is Memberpage 1
		</div>
		
		<div id="footer">
		</div>
	</body>
</html>