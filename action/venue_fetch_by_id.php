<?php
include "databaseconn.php";

$sql = "SELECT * FROM doc_venue WHERE doc_id = '".$_GET['id']."'";
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