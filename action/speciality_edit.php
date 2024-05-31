<?php
include "databaseconn.php";

$sql = "update doc_speciality set name='".$_POST['name']."' WHERE id = '".$_POST['id']."'";
if ($conn->query($sql) === TRUE)
{
    echo true;
}
else
{
    echo false;
}
?>