<?php
   include "action/databaseconn.php";
?>
<?php
   include "header.php";
?>
<?php
   $sql = "select * from appointment where patient_id = '".$_SESSION['id']."'";
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
                                <tr>
                                    <th>Appointment Id</th>
                                    <th>Doctor</th>
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
                                        $query1 = "select * from user where id = '".$r['doc_id']."'";
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
                                        if( $r['status'] == "Upcoming" or $r['status'] == "Resheduled")
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
                                        <a class="dropdown-item" data-id="<?= $r['appointment_id'] ?>" href=<?php echo "patient_appointment_detail.php?appointment_id=".$r['appointment_id'] ?>>View Appointment</a>   
                                            <a class="dropdown-item cursor-pointer edit-modal-1" data-toggle="modal" id="abc<?= $r['appointment_id'] ?>" data-id="<?= $r['appointment_id'] ?>" data-target="#editModal">Edit Appointment</a>
                                            <a class="dropdown-item cursor-pointer text-danger" onClick="acceptRejectDoctor('Canceled','<?= $r['appointment_id'] ?>')">Cancel Appointment</a>
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
                                            <a class="dropdown-item cursor-pointer" href=<?php echo "patient_appointment_detail.php?appointment_id=".$r['appointment_id'] ?>>View Appointment</a>
                                            <a class="dropdown-item cursor-pointer" href=<?php echo "report.php?appointment_id=".$r['appointment_id'] ?>>View Report</a>
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
                                            <a class="dropdown-item cursor-pointer" href=<?php echo "patient_appointment_detail.php?appointment_id=".$r['appointment_id'] ?>>View Appointment</a>
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
                                            <a class="dropdown-item cursor-pointer" href=<?php echo "patient_appointment_detail.php?appointment_id=".$r['appointment_id'] ?>>View Appointment</a>
                                            <a class="dropdown-item cursor-pointer" href=<?php echo "report.php?appointment_id=".$r['appointment_id'] ?>>View Report</a>
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

<div class="modal fade" id="editModal">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <form id="edit-form" method="POST">
            <div class="modal-header">
               <h5 class="modal-title">Edit Appointment Details</h5>
               <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <input type="hidden" name="appointment_id" id="appointment_id">
               <input type="hidden" name="status" id="status">
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="val-appointment_type">Appointment Type
                  <span class="text-danger">*</span>
                  </label>
                <div class="col-lg-7">
                    <select class="form-control" name="appointment_type" id="appointment_type">
                        <option value="Physical">Physical</option>
                        <option value="Telemedicine">Telemedicine</option>
                    </select>
                </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="val-dieseas">Dieseas
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-7">
                  <textarea type="text" name="dieseas" id="dieseas" class="form-control" rows="4" cols="50" placeholder="Enter a dieseas.."></textarea>                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="val-appointment_time">Appointment Time
                    <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-7">
                    <input type="text" class="form-control" placeholder="set appointment time" id="appointment_time">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
               <button type="submit" type="button" class="btn btn-primary">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>

<?php
   include "footer.php";
?>
<script>
    var table = $('#example3').DataTable();
   
// $('#appointment_time').bootstrapMaterialDatePicker({
//     format: 'DD/MM/YYYY hh:mm A',
//     minDate: new Date()
// });

$(document).on('click', "a.edit-modal-1", function() {
    var appointment_id=$(this).attr('data-id');
    // var liId = $(this).parent("li").attr("id");
    // alert(liId);     
    $.ajax({
           type: "GET",
           url: "action/appointment_fetch_by_id.php",
           dataType: "json",
           data: {appointment_id:appointment_id},
           success : function(data){
               if (data) {
                $('#appointment_id').val(data.appointment_id);
                $('#status').val(data.status);
                $('#doc_id').val(data.doc_id);
                $('#appointment_type').val(data.appointment_type);
                $('#dieseas').val(data.dieseas);
                $('#appointment_time').bootstrapMaterialDatePicker({
                    format: 'DD/MM/YYYY hh:mm A',
                    minDate: new Date(),
                    currentDate: new Date(data.appointment_time)
                });
                // let date = new Date(data.appointment_time);
                // var tzoffset = date.getTimezoneOffset() * 60000;
                // var localISOTime = (new Date(date - tzoffset)).toISOString().slice(0, -1);
                // $('#appointment_time').val(localISOTime.slice(0,16));               
               } else {
                   swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
               }
           }
       });   
});


    $(".edit-modal-1").click(function(){
       var appointment_id=$(this).attr('data-id');      
   });

   $("#edit-form").validate({
   rules: {
       "appointment_type": {
           required: true,
       },
       "dieseas": {
           required: true,
       },
       "appointment_time": {
           required: true, 
       },
   },
   messages: {
       "appointment_type": {
           required: "Please select an appointment-type",
       },
       "dieseas": {
           required: "Please enter a dieseas",
       },
       "appointment_time":{
           required: "Please select appointment-time!",
       } 
   },
   ignore: [],
   errorClass: "invalid-feedback animated fadeInUp",
   errorElement: "div",
   errorPlacement: function(e, a) {
       jQuery(a).parents(".form-group > div").append(e)
   },
   highlight: function(e) {
       jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
   },
   success: function(e) {
       jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
   },  
   submitHandler: function(form,e){
       e.preventDefault();
       
       var appointment_id = $("#appointment_id").val();
       var status = $("#status").val();
       var appointment_type = $("#appointment_type").val();
       var dieseas = $("#dieseas").val();
       var appointment_time = $("#appointment_time").val();
       
   
       $.ajax({
            type: "POST",
            url: "action/appointment_edit.php",
            dataType: "json",
            data: {appointment_id:appointment_id, status:status, appointment_type:appointment_type, dieseas:dieseas, appointment_time:appointment_time},                
            success : function(data){
            if (data){
                $('#editModal').hide();
                toastr.success("Appointment Details Updated", "",
                        {
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
                            window.location.href = "patient_appointment.php";
                        }, 1900);
                    } else {
                        toastr.error("Appointment Details Not Updated", "",
                        {
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
                            window.location.href = "patient_appointment.php";
                        }, 1900);
                    }
            }
       }); 
    } 
   });

   function acceptRejectDoctor(status,appointment_id)
   {
       $.ajax({
               type: "POST",
               url: "action/appointment_status.php",
               dataType: "json",
               data: {appointment_id:appointment_id,status:status},                
               success : function(data){
               if (data){
                   if( status == "Canceled")
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
                            window.location.href = "patient_appointment.php";
                        }, 1000);
                   }
               }
           }
       });
   }
</script>