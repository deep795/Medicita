<?php
include "databaseconn.php";
session_start();

$sql = "select * from assistant_basic_profile WHERE assistant_id = '".$_SESSION['id']."'";
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