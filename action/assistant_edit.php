<?php
include "databaseconn.php";

$sql = "UPDATE user SET first_name='".$_POST['first_name']."', last_name='".$_POST['last_name']."', email='".$_POST['email']."' , mobile_number='".$_POST['mobile_number']."', password='".$_POST['password']."' WHERE id = '".$_POST['id']."'";
if ($conn->query($sql) === TRUE)
{
    echo true;
}
else
{
    echo false;
}
?>