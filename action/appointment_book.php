<?php 
    include ("databaseconn.php");
    session_start();
    $sql = "select * from doc_basic_profile where user_id = '".$_POST['doctor_id']."'";
    $exe = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($exe);

    // $sql5 = "select * from doc_venue where doc_id = '".$_POST['doctor_id']."'";
    // $exe5 = mysqli_query($conn, $sql5);
    // $result5 = mysqli_fetch_assoc($exe5);

    
    $addingMinutes= strtotime(DateTime::createFromFormat('d/m/Y H:i a', $_POST['appointment_time'])->format('Y-m-d H:i:s')."+ 30 minute");
    $end_time = date('Y-m-d H:i:s', $addingMinutes);
    // $start_time = date('Y-m-d H:i:s', $_POST['appointment_time']);
    $dd = DateTime::createFromFormat('d/m/Y H:i a', $_POST['appointment_time']);
    $start_time = $dd->format('Y-m-d H:i:s');


    $sql6 = "select * from doc_venue where doc_id = '".$_POST['doctor_id']."' 
    and ((venue_1_start_time <= '".$start_time."' and venue_1_end_time >= '".$start_time."') 
    or (venue_1_start_time <= '".$end_time."' and venue_1_end_time >= '".$end_time."')
    )";
    
    $exe6 = mysqli_query($conn, $sql6);
    $result6 = mysqli_fetch_assoc($exe6);
    if($result6)
    {
        $sql3 = "select * from appointment where doc_id = '".$_POST['doctor_id']."' 
        and ((appointment_time <= '".$start_time."' and appointment_end_time >= '".$start_time."') 
        or (appointment_time <= '".$end_time."' and appointment_end_time >= '".$end_time."')
        )";
    
        $exe3 = mysqli_query($conn, $sql3);
        $result1 = mysqli_fetch_assoc($exe3);
    
        $sql4 = "select * from appointment where patient_id = '".$_SESSION['id']."' 
        and ((appointment_time <= '".$start_time."' and appointment_end_time >= '".$start_time."') 
        or (appointment_time <= '".$end_time."' and appointment_end_time >= '".$end_time."')
        )";
        $exe4 = mysqli_query($conn, $sql4);
        $result4 = mysqli_fetch_assoc($exe4);
    
        if ($result1 || $result4)
         {
            echo "2";
         }
         else {
            if ($_POST['appointment_type'] == 'Physical')
            {
                $charge = $result['physical_service_charge'];
            }
            else
            {
                $charge = $result['telemedicine_service_charge'];
            }
            $sql1 = "insert into appointment (patient_id, doc_id, appointment_type, dieseas, appointment_time, charge,appointment_end_time) values ('".$_POST['patient_id']."', '".$_POST['doctor_id']."', '".$_POST['appointment_type']."', '".$_POST['dieseas']."', '".$start_time."', '".$charge."','".$end_time."')";
            $exe1 = mysqli_query($conn, $sql1);
            if($exe1)
            {
                echo "3";
            }
            else {
                echo "4";
            }
        }
      
    }else{
        echo "1";
    }
?>