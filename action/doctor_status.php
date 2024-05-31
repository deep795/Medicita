<?php
include "databaseconn.php";
$sql =  ("UPDATE user SET status = '".$_POST['status']."' where id = '".$_POST['id']."'");
if ($conn->query($sql) === TRUE)
{
    echo true;
}
else
{
    echo false;
}
?>