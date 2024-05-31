<?php
include("databaseconn.php");
include("sendmail.php");

$query = 'select * from user where email="'.$_POST['email'].'"';    
$email = $_POST['email'];
$exe = mysqli_query($conn,$query);

$rndno=rand(1000, 9999);
$sql = "update user set otp = '".$rndno."' where email = '".$_POST['email']."'";
$exl = mysqli_query($conn,$sql);

    $result = mysqli_fetch_assoc($exe);
    if($result)
    {          
        $message = urlencode($rndno);
        sendMail("$email","Your One-Time Password from Medicita","$message - is your one-time password (OTP) to reset your Medicita password.");
        echo "true";
    }
    else
    {
       echo "false";
    }
?>