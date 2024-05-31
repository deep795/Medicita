<?php
include "databaseconn.php";

$sql = "update doc_basic_profile set sub_type='".$_POST['subscription']."'  WHERE user_id = '".$_POST['user_id']."'";
if ($conn->query($sql) === TRUE)
{
    echo true;
}
else
{
    echo false;
}
?>