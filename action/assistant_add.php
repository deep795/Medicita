<?php
include "databaseconn.php";
$query = "insert into user (user_type, first_name, last_name, email, mobile_number, password) values ('Assistant','".$_POST['add_fname']."','".$_POST['add_lname']."','".$_POST['add_email']."','".$_POST['add_number']."','".$_POST['add_password']."')";
$result = mysqli_query($conn, $query);
if($result)
{
    $sql = "select * from user WHERE email = '".$_POST['add_email']."'";
    $exe = mysqli_query($conn, $sql);
    $result2 = mysqli_fetch_assoc($exe);

    $sql1 = "insert into assistant_basic_profile (assistant_id, doc_id) values ('".$result2['id']."', '".$_POST['doc_id']."')";
    $exe1 = mysqli_query($conn, $sql1);
    if ($exe1)
    {
        echo "true";
    }
    else
    {
        echo "false";
    }
}
else
{
    echo "false";
}
?>