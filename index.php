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

	case 'memberpage1':
	case 'memberpage2':
	case 'memberpage3':
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
			body		{width:1000px; margin-left:200px; border:1px solid black}
			a:link,a:visited {color:blue; text-decoration:none}
			a:hover 	{color:red; text-decoration:underline}
			#header    	{padding-left:8px; background:#f0f0f0}
			#homelink	{font-weight:bold; margin-right:40px}
			#menuitems 	{}
			#contents 	{text-align:center; background:#ffffe7;
						 border-top:2px solid black; border-bottom:2px solid black}
			.headline  	{font-size:120%; font-weight:bold}
			#footer    	{text-align:center; background:#f0f0f0;
						 font-size:90%; font-style:italic}
		</style>
	</head>
	<body>
		<div id="header">
			<span id="homelink">
				<a href="index.php">Home</a>
			</span>
			<span id="menuitems">
				<?php echo $loginmenu."\n"; ?>
			</span>
		</div>
		
		<div id="contents">
			<p class="headline">Index Page</p>
<?php if($sess->logged) { ?>
			<p><img src="images/cerro-chato.jpg" title="Cerro Chato" alt="Cerro Chato" border="1"></p>
			<p><a href='index.php?act=memberpage1'>Member Page 1</p>
			<p><a href='index.php?act=memberpage2'>Member Page 2</p>
			<p><a href='index.php?act=memberpage3'>Member Page 3</p>
<?php }else{ ?>
			<p><img src="images/chimpanzee-face.jpg" title="Chimpanzee" alt="Chimpanzee" border="1"></p>
<?php } ?>
		</div>
		
		<div id="footer">
			<a href="https://github.com/halojoy/ActivateLogin" 
			target="_blank">ActivateLogin</a>&nbsp;-&nbsp;halojoy &copy; 2017
		</div>
	</body>
</html>