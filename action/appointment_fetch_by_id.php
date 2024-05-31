<?php
include "databaseconn.php";

$sql = "select * from appointment where appointment_id = '".$_GET['appointment_id']."'";
$exe = mysqli_query($conn,$sql);
$result = mysqli_fetch_assoc($exe);
if ($result)
{
    echo json_encode($result);
}
else
{
    echo "true";
}
?>