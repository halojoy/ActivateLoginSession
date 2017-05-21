<?php

$gmailaccount  = 'halojoy@gmail.com';
$gmailpassword = '14shabboy';
$from   = 'Administrator <'.$gmailaccount.'>';
$mailto = $useremail;

require('class.KMMailer.php');
/* $mail = new KMMailer(server, port, username, password, secure); */
/* secure can be: null, tls or ssl */
$mail = new KMMailer("smtp.gmail.com", "587", $gmailaccount, $gmailpassword, "tls");
if($mail->isLogin) {
	$mail->contentType = 'text/html';
	/* $mail->send(from, to, subject, body, headers = optional) */
	if(!$mail->send($from, $mailto, $subject, $body)){
		$message = '			Failed to send email.<br />';
		$db->exec("DELETE FROM users WHERE id = ".$userid);
	}else{
		$message = '			Email sent successfully.<br />
			Thank you for registering!<br />
			Check your mailbox to activate your account!<br />
			If you do not see the activation mail<br />
			Please look in your junk mail!<br />';
	}
}else{
	$message = '			SMTP Mail server login failed.<br />';
	$db->exec("DELETE FROM users WHERE id = ".$userid);
}
