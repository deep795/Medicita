<?php
include_once '../config.php';
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
$email=$_POST['email'];
$result=mysql_query("select * from adduser where email='".$email."'");
$data=mysql_fetch_array($result);
$pass=$data['password'];

date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.yahoo.com';
$mail->Host = 'smtp.mail.yahoo.com';
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "suru30141023";

//Password to use for SMTP authentication
$mail->Password = "SURUPRINCE11";

//Set who the message is to be sent from
$mail->setFrom('suru30141023@yahoo.in', 'Suresh Prajapati');

//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to
$mail->addAddress($email);

//Set the subject line
$mail->Subject = 'Password Recovery';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('mail2.php'), dirname(__FILE__));

//Replace the plain text body with one created manually
$mail->Body = "Hello ".$data['fname']."<br/> Your Password is: ".$pass;

//Attach an image file
//$mail->addAttachment('phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    header("location:../forgot-password.php");
}

?>