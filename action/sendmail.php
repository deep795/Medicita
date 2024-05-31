<?php
function sendMail($to,$subject,$msg)
{
include_once('../mail/PHPMailerAutoload.php');
$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->Host = 'smtp.gmail.com';  
	$mail->Port = 587;
	$mail->SMTPSecure = "tls";
	$mail->SMTPAutoTLS = True;
	$mail->SMTPAuth = true;
	$mail->Username = "medicitaa@gmail.com";
	$mail->Password = "medicita@admin";
	$mail->setFrom('medicitaa@gmail.com', "Medicita");
	$mail->addAddress($to);
	$mail->Subject = $subject;
	$mail->Body = $msg;
	$mail->send();
}      
?>