<?php
include "databaseconn.php";

$sql = "delete from doc_speciality where id = '".$_POST['id']."'";
if ($conn->query($sql) === TRUE)
{
    echo true;
}
else
{
    echo false;
}
?>