<?php 
    include ("databaseconn.php");
        
    $sql = "update user set first_name='".$_POST['first_name']."', last_name='".$_POST['last_name']."', birth_date='".$_POST['birth_date']."', mobile_number='".$_POST['mobile_number']."', bio='".$_POST['bio']."', address='".$_POST['address']."', state='".$_POST['state']."', city='".$_POST['city']."', zip_code='".$_POST['zip_code']."', gender='".$_POST['gender']."' WHERE id = '".$_POST['id']."'";
    $exe = mysqli_query($conn, $sql);
    if ($exe)
    {  
        $sql1 = "select * from assistant_basic_profile WHERE assistant_id='".$_POST['id']."'";
        $exe1 = mysqli_query($conn, $sql1);
        if (mysqli_fetch_assoc($exe1))
        {
            $sql2 = "update assistant_basic_profile set education  ='".$_POST['education']."', salary = '".$_POST['salary']."' WHERE assistant_id = '".$_POST['id']."'";
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
            $sql3 = "insert into assistant_basic_profile (assistant_id, education, salary) values ('".$_POST['assistant_id']."', '".$_POST['education']."', '".$_POST['salary']."')";
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
    }
    else{
        return "false";
    }
?>