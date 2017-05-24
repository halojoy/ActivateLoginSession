<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Index Page</title>
		<link rel="stylesheet" type="text/css" href="themes/default/style/index.css">
	</head>
	<body>

<?php include('themes/default/templates/header.php'); ?>

		<div id="contents">
			<p class="headline">Index Page</p>
<?php if($sess->logged) { ?>
			<p><img src="images/cerro-chato.jpg" title="Cerro Chato" alt="Cerro Chato" border="1"></p>
			<p><a href='index.php?act=memberpage1'>Member Page 1</a></p>
			<p><a href='index.php?act=memberpage2'>Member Page 2</a></p>
			<p><a href='index.php?act=memberpage3'>Member Page 3</a></p>
			<p>You can only read this page<br />
			if you are logged in.</p>
<?php }else{ ?>
			<p><img src="images/chimpanzee-face.jpg" title="Chimpanzee" alt="Chimpanzee" border="1"></p>
<?php } ?>
			<p>This is a part of '<b>ActivateLogin</b>' which is a software<br />
			designed by 'halojoy.'<br />
			You can use it for free and get the source code at:
			<a href="https://github.com/halojoy/ActivateLogin" target="_blank">Github.com</a></p>
		</div>
		
<?php include('themes/default/templates/footer.php'); ?>

	</body>
</html>