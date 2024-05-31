<?php
   include "action/databaseconn.php";
   ?>
<?php
   include "header.php";
   ?>
<?php
   $sql = "SELECT * FROM user where user_type = 'doctor'";
   $result = $conn->query($sql);
   $arr_users = [];
   ?>
<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <h4 class="card-title">Manage Doctor</h4>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="example3" class="display" style="min-width: 845px">
                     <?php 
                        if($result->num_rows > 0)
                           {
                              $arr_users = $result->fetch_all(MYSQLI_ASSOC);
                           }
                        ?>
                     <thead>
                        <tr>
                           <th>Image</th>
                           <th>First name</th>
                           <th>Last name</th>
                           <th>Email</th>
                           <th>Mobile</th>
                           <th>Status</th>
                           <th>Action</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if(!empty($arr_users)) { ?>
                        <?php foreach($arr_users as $r) { ?>
                        <tr>
                           <td><img class="rounded-circle" width="35" src="images/avatar/1.png" alt=""></td>
                           <td><?php echo $r['first_name'] ?></td>
                           <td><?php echo $r['last_name'] ?></td>
                           <td><?php echo $r['email'] ?></td>
                           <td><?php echo $r['mobile_number'] ?></td>
                           <?php
                              if( $r['status'] == "Approved")
                              {
                                 ?>
                                 <td><span class="badge light badge-success"><?php echo $r['status'] ?></span></td>
                                 <?php
                              }
                              elseif($r['status']=="Rejected")
                              {
                                 ?>
                                 <td><span class="badge light badge-danger"><?php echo $r['status'] ?></span></td>
                                 <?php
                              }else{
                                 ?>
                                 <td><span class="badge light badge-warning"><?php echo $r['status'] ?></span></td>
                                 <?php
                              }
                           ?>
                           <td>
                              <div class="d-flex">
                                 <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1 edit-modal" data-toggle="modal" data-id="<?= $r['id'] ?>" data-target="#editModal"><i class="fa fa-pencil"></i></button>
                                 <button type="button" class="btn btn-danger shadow btn-xs sharp mr-1 delete-modal" data-toggle="modal" data-id="<?= $r['id'] ?>" data-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                 <a href=<?php echo "admin_doctor_detail.php?id=".$r['id'] ?>><button type="button" class="btn btn-info shadow btn-xs sharp mr-1 view-modal" data-toggle="modal" data-id="<?= $r['id'] ?>" data-target="#viewModal"><i class="fa fa-eye"></i></button></a>
                              </div>
                           </td>
                           <td>
                              <div class="dropdown ml-auto text-right">
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
                                    <a class="dropdown-item" href="#" onClick="acceptRejectDoctor('Approved','<?= $r['id'] ?>')">Accept Doctor</a>
                                    <a class="dropdown-item" href="#" onClick="acceptRejectDoctor('Rejected','<?= $r['id'] ?>')">Reject Doctor</a>
                                 </div>
                              </div>
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
<div class="modal fade" id="deleteModal">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Delete Doctor Details</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <input type="hidden" name="id" id="id">
            <center>Are you sure ?</center>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger light delete-data">Delete</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="editModal">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <form id="edit-form" method="POST">
            <div class="modal-header">
               <h5 class="modal-title">Edit Doctor Details</h5>
               <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <input type="hidden" name="id" id="id">
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="val-firstname">First Name
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter a firstname..">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="val-lastname">Last Name
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter a lastname..">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="val-email">Email <span
                     class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="email" name="email" placeholder="Your valid email..">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-lg-4 col-form-label" for="val-phoneus">Mobile No
                  <span class="text-danger">*</span>
                  </label>
                  <div class="col-lg-6">
                     <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="212-999-0000">
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
   
   $('.edit-modal').click(function(){
       var id=$(this).attr('data-id');
       $.ajax({
           type: "GET",
           url: "action/user_fetch_by_id.php",
           dataType: "json",
           data: {id:id},
           success : function(data){
               if (data){
                   $('#id').val(data.id);
                   $('#first_name').val(data.first_name);
                   $('#last_name').val(data.last_name);
                   $('#email').val(data.email);
                   $('#mobile_number').val(data.mobile_number);               
               } else {
                   swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
               }
           }
       });
   });
   
   $("#edit-form").validate({
   rules: {
       "first_name": {
           required: true,
       },
       "last_name": {
           required: true,
       },
       "email": {
           required: true,
           email: true
       },
       "mobile_number": {
           required: true, 
       },
   },
   messages: {
       "first_name": {
           required: "Please enter a firstname",
       },
       "last_name": {
           required: "Please enter a lastname",
       },
       "email": {
           required: "Please enter a email",
           email: "Please enter valid email"
       },
       "mobile_number":{
           required: "Please enter a mobile number!",
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
   submitHandler: function(form,e) {
       e.preventDefault();
       
       var id = $("#id").val();
       var first_name = $("#first_name").val();
       var last_name = $("#last_name").val();
       var email = $("#email").val();
       var mobile_number = $("#mobile_number").val();
       
   
       $.ajax({
               type: "POST",
               url: "action/user_edit.php",
               dataType: "json",
           data: {id:id, first_name:first_name, last_name:last_name, email:email, mobile_number:mobile_number},                
           success : function(data){
               if (data){
                   $('#editModal').hide();
                   swal("Good job!", "Details updated successfully", "success");
                       setTimeout(function(){ 
                       window.location.href = "manage_doctor.php";
                   }, 2000);
               
               } else {
                   swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                       setTimeout(function(){ 
                       window.location.href = "manage_doctor.php";
                   }, 2000);
               }
           }
       }); 
   } 
   });
   
   $('.delete-modal').click(function(){
       var id=$(this).attr('data-id');
       $.ajax({
           type: "GET",
           url: "action/user_fetch_by_id.php",
           dataType: "json",
           data: {id:id},
           success : function(data){
               if (data){
                   $('#id').val(data.id);               
               } else {
                   swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
               }
           }
       });
   });
   $( ".delete-data" ).click(function() {
       var id = $("#id").val();
       $.ajax({
               type: "POST",
               url: "action/user_delete.php",
               dataType: "json",   
           data: {id:id},                
           success : function(data){
               if (data){
                   $('#deleteModal').hide();
                   swal("Good job!", "Details updated successfully", "success");
                       setTimeout(function(){ 
                       window.location.href = "manage_doctor.php";
                   }, 2000);
               
               } else {
                   swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                       setTimeout(function(){ 
                       window.location.href = "manage_doctor.php";
                   }, 2000);
               }
           }
       });
   });
   
   function acceptRejectDoctor(status,id)
   {
       $.ajax({
               type: "POST",
               url: "action/doctor_status.php",
               dataType: "json",
               data: {id:id,status:status},                
               success : function(data){
               if (data){
                   
                   if( status == "Approved")
                   {
                       
                           toastr.success("Doctor Approved", "", {
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
                   }
                   else
                   {
                     toastr.error("Doctor Rejected", "", {
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
                       
                   }
               } else {
                   toastr.error("Something went wrong", "", {
                   positionClass: "toast-top-right",
                   timeOut: 5e3,
                   closeButton: !0,
                   debug: !1,
                   newestOnTop: !0,
                   progressBar: !0,
                   preventDuplicates: !0,
                   onclick: null,
                   showDuration: "300",
                   hideDuration: "1000",
                   extendedTimeOut: "1000",
                   showEasing: "swing",
                   hideEasing: "linear",
                   showMethod: "fadeIn",
                   hideMethod: "fadeOut",
                   tapToDismiss: !1
               })
               }
           setTimeout(function(){ 
                   window.location.href = "manage_doctor.php";
               }, 1000);
           }
       });
   }
</script>