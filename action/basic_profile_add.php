<?php 
    include ("databaseconn.php");
        
    $sql = "update user set first_name='".$_POST['first_name']."', last_name='".$_POST['last_name']."', birth_date='".$_POST['birth_date']."', mobile_number='".$_POST['mobile_number']."', gender='".$_POST['gender']."', address='".$_POST['address']."',bio='".$_POST['bio']."', state='".$_POST['state']."', city='".$_POST['city']."', zip_code='".$_POST['zip_code']."' WHERE id = '".$_POST['id']."'";
    $exe = mysqli_query($conn, $sql);
    if ($exe)
    {  
        $sql1 = "select * from doc_basic_profile WHERE user_id='".$_POST['id']."'";
        $exe1 = mysqli_query($conn, $sql1);
        if (mysqli_fetch_assoc($exe1))
        {
            $sql2 = "update doc_basic_profile set telemedicine_service_charge='".$_POST['telemedicine_service_charge']."', physical_service_charge='".$_POST['physical_service_charge']."', education='".$_POST['education']."', award='".$_POST['awards']."', speciality_id='".$_POST['speciality_id']."'  WHERE user_id = '".$_POST['id']."'";
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
            $sql3 = "insert into doc_basic_profile (user_id, education, award, speciality_id, physical_service_charge, telemedicine_service_charge) values ('".$_POST['id']."', '".$_POST['education']."', '".$_POST['awards']."', '".$_POST['speciality_id']."', '".$_POST['physical_service_charge']."', '".$_POST['telemedicine_service_charge']."')";
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