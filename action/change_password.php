<?php
include("databaseconn.php");

session_start();

$query1 = "select password from user where id = '".$_SESSION['id']."'";
$exe = mysqli_query($conn, $query1);
$result = mysqli_fetch_assoc($exe);
if($result['password'] == $_POST['old_password'])
{
    $query2 = "update user set password = '".$_POST['new_password']."' where id = '".$_SESSION['id']."'";
    $exe1 = mysqli_query($conn, $query2);
    echo "true";
}
else
{
    echo "false";
}
?>