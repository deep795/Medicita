<?php
include "databaseconn.php";
$sql =  ("UPDATE appointment SET status = '".$_POST['status']."' where appointment_id = '".$_POST['appointment_id']."'");
if ($conn->query($sql) === TRUE)
{
    echo true;
}
else
{
    echo false;
}
?>