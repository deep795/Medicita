<?php
   include "action/databaseconn.php";
   include "header.php";
?>
<?php
   $sql = "select * from appointment where doc_id = '".$_SESSION['id']."'";
   $result = $conn->query($sql);
   $arr_appointment = [];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">My Appointment</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm" id="example3" class="display" style="min-width: 845px">
                            <?php 
                            if($result->num_rows > 0)
                                {
                                    $arr_appointment = $result->fetch_all(MYSQLI_ASSOC);
                                }
                            ?>
                            <thead>
                                <tr><th>Appointment Id</th>
                                    <th>Patient</th>
                                    <th>Appointment Type</th>
                                    <th>Dieseas</th>
                                    <th>Appointment Time</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($arr_appointment)) { ?>
                                <?php foreach($arr_appointment as $r) { ?>
                                <tr>
                                    <?php 
                                        $query1 = "select * from user where id = '".$r['patient_id']."'";
                                        $result = mysqli_query($conn, $query1);
                                        $arr_doc = [];
                                        if($result->num_rows > 0)
                                        {
                                            $arr_doc = $result->fetch_all(MYSQLI_ASSOC);
                                        }
                                    ?>
                                    <?php if(!empty($arr_doc)) { ?>
                                        <?php foreach($arr_doc as $r2) { ?>
                                            <td><?php echo $r['appointment_id'] ?></td>
                                            <td><?php echo $r2['first_name'] ?> <?php echo $r2['last_name'] ?></td>
                                    <?php }} ?>
                                    <td><?php echo $r['appointment_type'] ?></td>
                                    <td><?php echo $r['dieseas'] ?></td>
                                    <td><?php $date = new DateTime($r['appointment_time']); echo $date->format('d-m-Y H:i:s');?></td>
                                    <?php
                                        if( $r['status'] == "Upcoming")
                                        {
                                            ?>
                                            <td><span class="badge light badge-primary"><?php echo $r['status'] ?></span></td>
                                            <?php
                                        }
                                        elseif($r['status']=="Completed")
                                        {
                                            ?>
                                            <td><span class="badge light badge-success"><?php echo $r['status'] ?></span></td>
                                            <?php
                                        }
                                        elseif($r['status']=="Canceled")
                                        {
                                            ?>
                                            <td><span class="badge light badge-danger"><?php echo $r['status'] ?></span></td>
                                            <?php
                                        }
                                        elseif($r['status']=="Resheduled")
                                        {
                                            ?>
                                            <td><span class="badge light badge-info"><?php echo $r['status'] ?></span></td>
                                            <?php
                                        }else{
                                            ?>
                                            <td><span class="badge light badge-warning"><?php echo $r['status'] ?></span></td>
                                            <?php
                                        }
                                    ?>
                                    <td>
                                    <?php
                                        if( $r['status'] == "Upcoming")
                                        {
                                    ?>
                                    <div class="dropdown ml-auto text-center">
                                        <div class="btn-link" data-toggle="dropdown">
                                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" style="cursor: pointer;">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                            </g>
                                            </svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">    
                                            <a class="dropdown-item" data-id="<?= $r['appointment_id'] ?>" href=<?php echo "appointment_detail.php?appointment_id=".$r['appointment_id'] ?>>View Appointment</a>
                                            <a class="dropdown-item" href="#" onClick="appointment('Inprogress','<?= $r['appointment_id'] ?>')">Start Appointment</a>
                                            <a class="dropdown-item" href="#" onClick="appointment('Canceled','<?= $r['appointment_id'] ?>')">Cancel Appointment</a>
                                        </div>
                                    </div>
                                    <?php 
                                        }
                                    ?>
                                    <?php
                                        if( $r['status'] == "Canceled")
                                        {
                                    ?>
                                    <div class="dropdown ml-auto text-center">
                                        <div class="btn-link" data-toggle="dropdown">
                                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" style="cursor: pointer;">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                            </g>
                                            </svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">    
                                            <a class="dropdown-item" data-id="<?= $r['appointment_id'] ?>" href=<?php echo "appointment_detail.php?appointment_id=".$r['appointment_id'] ?>>View Appointment</a>
                                        </div>
                                    </div>
                                    <?php 
                                        }
                                    ?>
                                    <?php
                                        if( $r['status'] == "Completed")
                                        {
                                    ?>
                                    <div class="dropdown ml-auto text-center">
                                        <div class="btn-link" data-toggle="dropdown">
                                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" style="cursor: pointer;">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                            </g>
                                            </svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">    
                                            <a class="dropdown-item" data-id="<?= $r['appointment_id'] ?>" href=<?php echo "appointment_detail.php?appointment_id=".$r['appointment_id'] ?>>View Appointment</a>
                                            <a class="dropdown-item" data-id="<?= $r['appointment_id'] ?>" href=<?php echo "doctor_report.php?appointment_id=".$r['appointment_id'] ?>>View Report</a>
                                        </div>
                                    </div>
                                    <?php 
                                        }
                                    ?>
                                    <?php
                                        if( $r['status'] == "Inprogress")
                                        {
                                    ?>
                                    <div class="dropdown ml-auto text-center">
                                        <div class="btn-link" data-toggle="dropdown">
                                            <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" style="cursor: pointer;">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                            </g>
                                            </svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" data-id="<?= $r['appointment_id'] ?>" href=<?php echo "appointment_detail.php?appointment_id=".$r['appointment_id'] ?>>View Appointment</a>
                                            <a class="dropdown-item" href="#" onClick="appointment('Completed','<?= $r['appointment_id'] ?>')">Complete Appointment</a>
                                        </div>
                                    </div>
                                    <?php 
                                        }
                                    ?>
                                    </td>
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
   include "footer.php";
?>
<script>
    var table = $('#example3').DataTable();

    function appointment(status,appointment_id)
   {
       $.ajax({
               type: "POST",
               url: "action/appointment_status.php",
               dataType: "json",
               data: {appointment_id:appointment_id,status:status},                
               success : function(data){
               if (data){
                   if( status == "Inprogress")
                   {
                     toastr.success("Appointment Started", "", {
                        timeOut: 2000,
                        closeButton: !0,
                        debug: !1,
                        newestOnTop: !0,
                        progressBar: !0,
                        positionClass: "toast-top-right",
                        preventDuplicates: !0,
                        onclick: null,
                        showDuration: "300",
                        hideDuration: "1000",
                        extendedTimeOut: "1000",
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut",
                        tapToDismiss: !1,
                       })
                        setTimeout(function(){ 
                            window.location.href = "doctor_appointment.php";
                        }, 1000);
                   }
                   else if( status == "Canceled")
                   {
                     toastr.error("Appointment Canceled", "", {
                        timeOut: 2000,
                        closeButton: !0,
                        debug: !1,
                        newestOnTop: !0,
                        progressBar: !0,
                        positionClass: "toast-top-right",
                        preventDuplicates: !0,
                        onclick: null,
                        showDuration: "300",
                        hideDuration: "1000",
                        extendedTimeOut: "1000",
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut",
                        tapToDismiss: !1,
                       })
                        setTimeout(function(){ 
                            window.location.href = "doctor_appointment.php";
                        }, 1000);
                   }
                   else
                   {
                     toastr.success("Appointment Completed", "", {
                        timeOut: 2000,
                        closeButton: !0,
                        debug: !1,
                        newestOnTop: !0,
                        progressBar: !0,
                        positionClass: "toast-top-right",
                        preventDuplicates: !0,
                        onclick: null,
                        showDuration: "300",
                        hideDuration: "1000",
                        extendedTimeOut: "1000",
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut",
                        tapToDismiss: !1,
                       })
                        setTimeout(function(){ 
                            window.location.href = "doctor_appointment.php";
                        }, 1000);
                   }
               }
           }
       });
   }

   $('.view-modal').click(function(){
        var appointment_id=$(this).attr('data-id');
        $.ajax({
            type: "GET",
            url: "action/appointment_fetch_by_id.php",
            dataType: "json",
            data: {appointment_id:appointment_id},
            success : function(data){
                if (data){
                    $('#appointment_id').val(data.appointment_id);               
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                }
            }
        });
    });
</script>