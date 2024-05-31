<?php
include "databaseconn.php";

$sql1 = "select * from rating WHERE appointment_id='".$_POST['appointment_id']."'";
$exe1 = mysqli_query($conn, $sql1);
if (mysqli_fetch_assoc($exe1))
{
    $sql2 = "update rating set rating = '".$_POST['rating']."', review = '".$_POST['review']."' WHERE rating_id = '".$_POST['rating_id']."'";
    $exe2 = mysqli_query($conn, $sql2);
    if ($exe2)
    {
        echo "true";
    }
    else{
        echo "false";
    }
}
else
{            
    $sql3 = "insert into rating (patient_id, doc_id, appointment_id, rating, review) values ('".$_POST['patient_id']."', '".$_POST['doc_id']."', '".$_POST['appointment_id']."', '".$_POST['rating']."', '".$_POST['review']."')";
    $exe3 = mysqli_query($conn, $sql3);
    if ($exe3)
    {
        echo "true";
    }
    else
    {
        echo "false";
    }
}
?>