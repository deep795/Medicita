<?php
include "action/databaseconn.php";

   session_start();
   if(!isset($_SESSION["login"]))
   {
   	header("location:index.php");
   }
   else
   {
   	$email = $_SESSION['email'];
      $user_type = $_SESSION['user_type'];
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>Medicita</title>
      <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
      <link href="vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="vendor/chartist/css/chartist.min.css">
      <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
      <link rel="stylesheet" href="vendor/toastr/css/toastr.min.css">
      <!-- Material color picker -->
    <link href="vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
      <link href="css/custom.css" rel="stylesheet">
   </head>
   <body>
      <div id="preloader">
         <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
         </div>
      </div>
      <div id="main-wrapper">
      <div class="nav-header">
         <a href="index.php" class="brand-logo">
            <img class="logo-abbr" src="images/logo.png" alt="">
            <img class="logo-compact" src="images/logo-text.png" alt="">
            <img class="brand-title" src="images/logo-text.png" alt="">
         </a>
         <div class="nav-control">
            <div class="hamburger">
               <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
         </div>
      </div>
      <div class="header">
         <div class="header-content">
            <nav class="navbar navbar-expand">
               <div class="collapse navbar-collapse justify-content-between">
                  <div class="header-left">
                     <div class="dashboard_bar">

                     </div>
                  </div>
                  <ul class="navbar-nav header-right">
                     <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                           <div class="header-info">
                              <span><?php echo $_SESSION['first_name']." ".$_SESSION['last_name'] ?></span>
                              <small><?php echo $user_type?></small>
                           </div>
                           <?php 
                              $query1 = "select * from user where id = '".$_SESSION['id']."'";
                              $result = mysqli_query($conn, $query1);
                              $arr_doc = [];
                              if($result->num_rows > 0)
                              {
                                 $arr_doc = $result->fetch_all(MYSQLI_ASSOC);
                              }
                           ?>
                           <?php if(!empty($arr_doc)) { ?>
                                 <?php foreach($arr_doc as $r2) { 
                                    if ($r2['profile_photo'] > 0) {
                                       ?>
                                       <img src=<?php echo "image/".$r2['profile_photo'] ?> width="20" alt=""/>
                                 <?php
                                    }
                                    else {
                                       ?>
                                       <img src="images/avatar/727399.png" width="20" alt=""/>
                                 <?php
                                    }
                                    ?>
                           <?php }} ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <?php
                           if($_SESSION['user_type'] == "Doctor")
                           {
                           ?>
                           <a href="doctor_profile.php" class="dropdown-item ai-icon">
                              <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                 <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                 <circle cx="12" cy="7" r="4"></circle>
                              </svg>
                              <span class="ml-2">Profile </span>
                           </a>
                        <?php   
                           }
                           elseif($_SESSION['user_type'] == "Patient")
                           {
                           ?>
                           <a href="patient_profile.php" class="dropdown-item ai-icon">
                              <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                 <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                 <circle cx="12" cy="7" r="4"></circle>
                              </svg>
                              <span class="ml-2">Profile </span>
                           </a>
                        <?php
                           }
                           elseif($_SESSION['user_type'] == "Assistant")
                           {
                        ?>
                           <a href="assistant_profile.php" class="dropdown-item ai-icon">
                              <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                 <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                 <circle cx="12" cy="7" r="4"></circle>
                              </svg>
                              <span class="ml-2">Profile </span>
                           </a>
                        <?php
                           }
                        ?>
                           <a onclick="logoutfunction()" class="dropdown-item ai-icon cursor-pointer">
                              <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                 <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                 <polyline points="16 17 21 12 16 7"></polyline>
                                 <line x1="21" y1="12" x2="9" y2="12"></line>
                              </svg>
                              <span class="ml-2">Logout</span>
                           </a>
                        </div>
                     </li>
                  </ul>
               </div>
            </nav>
         </div>
      </div>
      <div class="deznav">
         <div class="deznav-scroll">
            <?php
               if($_SESSION['user_type'] == "Doctor")
               {
                  include ("doctor_sidebar.php");
               }
               elseif($_SESSION['user_type'] == "Patient")
               {
                  include ("patient_sidebar.php");
               }
               elseif($_SESSION['user_type'] == "Admin")
               {
                  include ("admin_sidebar.php");
               }
               elseif($_SESSION['user_type'] == "Assistant")
               {
                  include ("assistant_sidebar.php");
               }
            ?>
         </div>
      </div>
      <div class="content-body">
      <script>
         function logoutfunction() {
         	$.ajax({
            	type: 'POST',
            	url: 'action/logout_process.php',
            	success: function(msg) 
               { 	
                  window.location.href = 'index.php';
               },
            });
         };
      </script>