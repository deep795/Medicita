<?php 
    include ("databaseconn.php");
        
        $sql1 = "select * from doc_venue WHERE doc_id='".$_POST['user_id']."'";
        $exe1 = mysqli_query($conn, $sql1);
        if (mysqli_fetch_assoc($exe1))
        {
            $sql2 = "update doc_venue set venue_1_name='".$_POST['venue_1_name']."', venue_1_address='".$_POST['venue_1_address']."', venue_1_start_time='".$_POST['venue_1_start_time']."', venue_1_end_time='".$_POST['venue_1_end_time']."' WHERE doc_id = '".$_POST['user_id']."'";
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
            $sql3 = "insert into doc_venue(doc_id, 
            venue_1_name, venue_1_address, venue_1_start_time, venue_1_end_time) values 
            ('".$_POST['user_id']."', '".$_POST['venue_1_name']."', '".$_POST['venue_1_address']."', '".$_POST['venue_1_start_time']."', '".$_POST['venue_1_end_time']."')";
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
?>