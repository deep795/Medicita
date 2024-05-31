<?php
include "databaseconn.php";

$dd = DateTime::createFromFormat('d/m/Y H:i a', $_POST['appointment_time']);
$start_time = $dd->format('Y-m-d H:i:s');

if ($_POST['status'] = "Resheduled")
{
    $sql = "UPDATE appointment SET appointment_type = '".$_POST['appointment_type']."', dieseas='".$_POST['dieseas']."', appointment_time='".$start_time."', status = 'Upcoming' WHERE appointment_id = '".$_POST['appointment_id']."'";
    $exe = mysqli_query($conn, $sql);
    if ($exe)
    {
        echo true;
    }
    else
    {
        echo false;
    }
}
else
{
    $sql = "UPDATE appointment SET appointment_type = '".$_POST['appointment_type']."', dieseas='".$_POST['dieseas']."', appointment_time='".$start_time."' WHERE appointment_id = '".$_POST['appointment_id']."'";
    $exe = mysqli_query($conn, $sql);
    if ($exe)
    {
        echo true;
    }
    else
    {
        echo false;
    }
}
?>