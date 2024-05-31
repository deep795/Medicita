<?php 
    include ("databaseconn.php");
    $sql = "insert into user(sub_type) values ('".$_POST['sub_type']."')";
    if ($conn->query($sql) === TRUE)
    {
        echo "true";
    }
    else
    {
        echo "false";
    }
?>