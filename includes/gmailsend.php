<?php

$gmailaccount  = 'yourgmailaccount';
$gmailpassword = 'yourgmailpass';
$from   = 'Administrator <'.$gmailaccount.'>';
$mailto = $useremail;
$subject  = 'Activation of account at '.$_SERVER['SERVER_NAME'];
$host = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
$body = 'Activation of your account at '.$_SERVER['SERVER_NAME'].'.<br />'.
		'To activate your account<br />'.
		'Please click the link here below!<br /><br />'.
		'<a href="'.$host.'?act=activation&ucode='.$usercode.'">Activate your account</a>';

require ('class.KMMailer.php');
/* $mail = new KMMailer(server, port, username, password, secure); */
/* secure can be: null, tls or ssl */
$mail = new KMMailer("smtp.gmail.com", "587", $gmailaccount, $gmailpassword, "tls");
if (!$mail->isLogin) {
	$message = '			SMTP Mail server login failed.<br />';
} else {
	/* $mail->send(from, to, subject, body, headers = optional) */
	if (!$mail->send($from, $mailto, $subject, $body)){
		$message = '			Failed to send email.<br />';
	}
}
