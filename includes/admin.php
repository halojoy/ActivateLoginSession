<?php

$sess->isAdmin();

if (isset($_POST['adm_id']))
	$db->setUtype($_POST['adm_id'], 'admin');
if (isset($_POST['mem_id']))
	$db->setUtype($_POST['mem_id'], 'member');
if (isset($_POST['del_id']))
	$db->deleteUser($_POST['del_id']);

include('themes/'.$theme.'/templates/admin.template.php');

?>
