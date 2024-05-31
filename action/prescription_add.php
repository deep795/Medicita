<?php 
    include ("databaseconn.php");
  
    $sql = "UPDATE appointment SET prescription = '".$_POST['prescription']."' WHERE appointment_id = '".$_POST['appointment_id']."'";
    if ($conn->query($sql) === TRUE)
    {
        echo "true";
    }
    else
    {
        echo "false";
    }
?>