<?php

include ("databaseconn.php");

// echo json_encode($_POST);
$img = $_FILES["venue_1_image"]["name"];
$tmp = $_FILES["venue_1_image"]["tmp_name"];
$errorimg = $_FILES["venue_1_image"]["error"];

$valid_extensions = array('jpeg', 'jpg','png');
$path = '../venue-image/';

if($_FILES['venue_1_image'])
{
    $img = $_FILES['venue_1_image']['name'];
    $tmp = $_FILES['venue_1_image']['tmp_name'];

    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

    $final_image = rand(1000,1000000).$img;

    if(in_array($ext, $valid_extensions)) 
    { 
        $path = $path.strtolower($final_image); 

        if(move_uploaded_file($tmp,$path)) 
        {
            // echo "<img src='$path' />";
            $sql = "update doc_venue set venue_1_image = '".$final_image."' where doc_id ='".$_POST['user_id2']."' ";
            $insert = $conn->query($sql);   
            echo true;     
        }
    } 
}
?>