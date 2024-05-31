<?php
include("databaseconn.php");
$query1 = "select * from user where otp = '".$_POST['otp']."'";
$exe1 = mysqli_query($conn,$query1);
$result = mysqli_fetch_assoc($exe1);

if($result){
$query = "update user set password = '".$_POST['password']."' where otp = '".$_POST['otp']."'";

    $exe = mysqli_query($conn,$query);
    if($exe)
    {
        echo "1";
    }
    else
    {
       echo "0";
    }
}
else{
    echo "2";
}
?>  