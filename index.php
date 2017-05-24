<?php

require ('includes/init.php');

//action
$action = isset($_GET['act']) ? $_GET['act'] : 'index';
switch ($action) {

	case 'login':
	case 'signup':
	case 'logout':
	case 'activation':
	case 'admin':
		require ('includes/'.$action.'.php');
		exit();
		break;

	case 'memberpage1':
	case 'memberpage2':
	case 'memberpage3':
		require ('mypages/'.$action.'.php');
		exit();
		break;

	case 'index':
	default:
}

include ('themes/'.$theme.'/templates/index.template.php');

?>
