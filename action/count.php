<?php
include("databaseconn.php");
  
   
    date_default_timezone_set("Asia/Kolkata");
     $datee= date('Y-m-d'); //Returns IST
 	$timee=date('H:i:s'); 
 	$browser=$_SERVER['HTTP_USER_AGENT'];

  // gets the user IP Address
  $user_ip=$_SERVER['REMOTE_ADDR'];

   $check_ip ="select userip from views where  userip='".$user_ip."'";
  $query= mysqli_query($conn,$check_ip);
  
 
  $cc=mysqli_num_rows($query);
 
  if($cc<1)
  {
       $ss="insert into views(userip,datee,timee,browser) values('".$user_ip."','".$datee."','".$timee."','".$browser."')";
       $insertview = mysqli_query($conn,$ss);
       $msg="New visitor have visited having Ip address".$user_ip;
   
 
  }   
?>

<?php

    $stmt = mysqli_query($conn,"select * from views");
  ?>
<h4 class="mb-0"><?php echo mysqli_num_rows($stmt);?>
  </h4>
  <?php
 
  ?>