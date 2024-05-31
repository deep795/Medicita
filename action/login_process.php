<?php
include("databaseconn.php");

    $query = 'select * from user where email="'.$_POST['email'].'" and password="'.$_POST['password'].'"';    
    
    $exe = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($exe);
    if($result)
    {
        session_start();
        $_SESSION['id'] = $result['id'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['login'] = 1;

            if($result['user_type'] == "Doctor")
            {
                $_SESSION['user_type'] = $result['user_type'];
                $_SESSION['first_name'] = $result['first_name'];
                $_SESSION['last_name'] = $result['last_name'];
                echo 1;
            }
            elseif($result['user_type'] == "Patient")
            {
                $_SESSION['user_type'] = $result['user_type'];
                $_SESSION['first_name'] = $result['first_name'];
                $_SESSION['last_name'] = $result['last_name'];
                echo 2;
            }
            elseif($result['user_type'] == "Admin")
            {
                $_SESSION['user_type'] = $result['user_type'];
                $_SESSION['first_name'] = $result['first_name'];
                $_SESSION['last_name'] = $result['last_name'];
                echo 3;
            }
            elseif($result['user_type'] == "Assistant")
            {
                $q1 = 'select * from assistant_basic_profile where assistant_id = "'.$result['id'].'"';
                $exe1 = mysqli_query($conn,$q1);
                $result1 = mysqli_fetch_assoc($exe1);
                $_SESSION['doc_id'] = $result1['doc_id'];
                $_SESSION['user_type'] = $result['user_type'];
                $_SESSION['first_name'] = $result['first_name'];
                $_SESSION['last_name'] = $result['last_name'];
                echo 4;
            }
    }
    else
    { 
       echo "false";
    }
?>