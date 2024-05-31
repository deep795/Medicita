<?php
include "databaseconn.php";

$sql = "UPDATE subscription SET prize = '".$_POST['prize']."' where id = '".$_POST['id']."'";
if ($conn->query($sql) === TRUE)
{
    echo true;
}
else
{
    echo false;
}
?>