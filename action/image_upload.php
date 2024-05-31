<?php

include ("databaseconn.php");

// echo json_encode($_POST);
$img = $_FILES["profile_photo"]["name"];
$tmp = $_FILES["profile_photo"]["tmp_name"];
$errorimg = $_FILES["profile_photo"]["error"];

$valid_extensions = array('jpeg', 'jpg','png');
$path = '../image/';

if($_FILES['profile_photo'])
{
    $img = $_FILES['profile_photo']['name'];
    $tmp = $_FILES['profile_photo']['tmp_name'];

    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

    $final_image = rand(1000,1000000).$img;

    if(in_array($ext, $valid_extensions)) 
    { 
        $path = $path.strtolower($final_image); 

        if(move_uploaded_file($tmp,$path)) 
        {
            // echo "<img src='$path' />";
            $sql = "update user set profile_photo = '".$final_image."' where id='".$_POST['user_id']."' ";
            $insert = $conn->query($sql);
            if($insert == true){
                echo true;
            }
        }
    }
    else 
    {
        return false;
    }
}
?>