<?php 
    include ("databaseconn.php");
    $query = 'select * from user where email="'.$_POST['email'].'"';
    $exe = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($exe);
    if ($result)
    {
        echo "false";
    }
    else {
        $sql = "insert into user(user_type, first_name, last_name, email, password,  mobile_number) values ('".$_POST['user_type']."', '".$_POST['first_name']."', '".$_POST['last_name']."', '".$_POST['email']."', '".$_POST['password']."', '".$_POST['mobile_number']."')";
        if ($conn->query($sql) === TRUE)
        {
            echo "true";
        }
        else
        {
            echo "false";
        }
    }
?>