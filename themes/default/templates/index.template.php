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
			<p><a href='index.php?act=memberpage1'>Member Page 1</p>
			<p><a href='index.php?act=memberpage2'>Member Page 2</p>
			<p><a href='index.php?act=memberpage3'>Member Page 3</p>
<?php }else{ ?>
			<p><img src="images/chimpanzee-face.jpg" title="Chimpanzee" alt="Chimpanzee" border="1"></p>
<?php } ?>
		</div>
		
<?php include('themes/default/templates/footer.php'); ?>

	</body>
</html>