<?php
    include "databaseconn.php";
    $query = 'select * from doc_speciality where name="'.$_POST['name'].'"';
    $exe = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($exe);
    if ($result)
    {
        echo "false";
    }
    else {
        $query1 = "insert into doc_speciality (name) values('".$_POST['name']."')";
        $result1 = mysqli_query($conn, $query1);
        if($result1){
            echo true;
        }
        else{
            echo false;
        }
    }
?>  