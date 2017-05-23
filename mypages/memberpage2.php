<?php $sess->isLogged(); ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Member Page 2</title>
		<style>
			body 		{width:1000px; margin-left:200px; border:1px solid}
			a:link, a:visited {color:blue; text-decoration:none}
			a:hover           {color:red; text-decoration:underline}
			#header    	{padding-left:8px; background:#f0f0f0}
			#homelink	{font-weight:bold; margin-right:40px}
			#menuitems 	{}
			#contents  	{padding:0px 20px 0px 100px; background:#ffffe7;
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
			<p class="headline">This is Member Page 2</p>
			<img src="images/programmer.jpg" title="Programmer" alt="Programmer" border="1">
			<p>You can only read this page<br />
			if you are logged in.</p>
			<p>This is a part of '<b>ActivateLogin</b>' which is a software<br />
			designed by 'halojoy.'<br />
			You can use it for free and get the source code at:
			<a href="https://github.com/halojoy/ActivateLogin" target="_blank">Github.com</a></p>
		</div>
		
		<div id="footer">
			<a href="https://github.com/halojoy/ActivateLogin" 
			target="_blank">ActivateLogin</a>&nbsp;-&nbsp;halojoy &copy; 2017
		</div>
	</body>
</html>