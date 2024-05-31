<?php
    include("databaseconn.php");
    session_start();

    $query = "select MONTH(appointment_time) as month, SUM(charge) as total_revenue from appointment where doc_id = '".$_SESSION['id']."' and YEAR(appointment_time) = 2022 group by YEAR(appointment_time), MONTH(appointment_time) order by month";    
    $exe = mysqli_query($conn,$query);
    $result = $exe->fetch_all(MYSQLI_ASSOC);
    echo json_encode($result);
?>