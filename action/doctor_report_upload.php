<?php

include ("databaseconn.php");


$sql1 = "insert into report(patient_id, appointment_id, report_description, doc_id, is_patient_share) values ('".$_POST['patient_id']."', '".$_POST['appointment_id']."', '".$_POST['report_description']."', '".$_POST['doc_id']."', '0    ')";

if ($conn->query($sql1) === TRUE)
{
    $img = $_FILES["file"]["name"];
    $tmp = $_FILES["file"]["tmp_name"];
    $errorimg = $_FILES["file"]["error"];
    
    $valid_extensions = array('jpeg', 'jpg','png', 'pdf');
    $path = '../report/';
    
    if($_FILES['file'])
    {
        $img = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
    
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    
        $final_file = rand(1000,1000000).$img;
    
        if(in_array($ext, $valid_extensions)) 
        { 
            $path = $path.strtolower($final_file); 
    
            if(move_uploaded_file($tmp,$path)) 
            {
                // echo "<img src='$path' />";
                $sql = "update report set file = '".$final_file."' where report_id = '".$conn->insert_id."'";
                $insert = $conn->query($sql);
                if($insert == true){
                    echo "true";
                }
            }
        }
        else 
        {
            echo "false";
        }
    }
}
else
{
    echo "false";
}

?>