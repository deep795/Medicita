<?php
   include "action/databaseconn.php";
?>
<?php
   include "header.php";
?>
<?php
   $sql = "SELECT * FROM assistant_basic_profile where doc_id = '".$_SESSION['id']."'";
   $result = $conn->query($sql);
   $arr_users = [];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Manage assistant</h4>
                    <button type="button" class="btn btn-rounded btn-primary add-modal" data-target="#addModal" data-toggle="modal">
                        <span class="btn-icon-left text-primary">
                            <i class="fa fa-plus color-info"></i>
                        </span>Add
                    </button>
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
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php if(!empty($arr_users)) { ?>
                            <?php foreach($arr_users as $r) { ?>
                            <?php
                                $sql1 = "SELECT * FROM user where id = '".$r['assistant_id']."'";
                                $result1 = $conn->query($sql1);
                                $arr_users1 = [];
                            ?>
                            <?php 
                            if($result1->num_rows > 0)
                                {
                                    $arr_users1 = $result1->fetch_all(MYSQLI_ASSOC);
                                }
                            ?>
                            <tbody>
                            <?php if(!empty($arr_users1)) { ?>
                                <?php foreach($arr_users1 as $r1) { ?>
                                <tr>
                                    <td><?php echo $r1['first_name'] ?></td>
                                    <td><?php echo $r1['last_name'] ?></td>
                                    <td><?php echo $r1['email'] ?></td>
                                    <td><?php echo $r1['mobile_number'] ?></td>
                                    <td><?php echo $r1['password'] ?></td>
                                    <td>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1 edit-modal" data-toggle="modal" data-id="<?= $r1['id'] ?>" data-target="#editModal"><i class="fa fa-pencil"></i></button>
                                        <button type="button" class="btn btn-danger shadow btn-xs sharp mr-1 delete-modal" data-toggle="modal" data-id="<?= $r1['id'] ?>" data-target="#deleteModal"><i class="fa fa-trash"></i></button>
                                    </div>
                                    </td>
                                </tr>
                                <?php }} ?>
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
<div class="modal fade" id="addModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="add-form" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Add Assistant Detalis</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <input type="hidden" name="doc_id" id="doc_id" value="<?php echo $_SESSION['id'] ?>">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="fname">First Name
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="add_fname" name="add_fname" placeholder="Enter First Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="lname">Last Name
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="add_lname" name="add_lname" placeholder="Enter Last Name..">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="aemail">email
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="add_email" name="add_email" placeholder="Enter Email..">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="num">Mobile No
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="add_number" name="add_number" placeholder="212-999-0000">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="pass">Password
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="add_password" name="add_password" placeholder="Enter Password..">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete assistant Details</h5>
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
<div class="modal fade"  id="editModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <form id="edit-form" method="POST">
            <div class="modal-header">
                <h5 class="modal-title">Edit assistant Details</h5>
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
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="val-phoneus">Password
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" id="password" name="password" placeholder="Your Password">
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
<script>
    var table = $('#example3').DataTable();

    $("#add-form").validate({
    rules: {
        "add_fname": {
            required: true,
        },
        "add_lname": {
            required: true,
        },
        "add_email": {
            required: true,
        },
        "add_number": {
            required: true,
        },
        "add_password": {
            required: true,
        },
    },
    messages: {
        "add_fname": {
            required: "Please enter First Name",
        },
        "add_lname": {
            required: "Please enter Last Name",
        },
        "add_email": {
            required: "Please enter Email",
        },
        "add_number": {
            required: "Please enter a Mobile number",
        },
        "add_password": {
            required: "Please enter a Password",
        },
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
        
        var doc_id = $("#doc_id").val();
        var add_fname = $("#add_fname").val();
        var add_lname = $("#add_lname").val();
        var add_email = $("#add_email").val();
        var add_number = $("#add_number").val();
        var add_password = $("#add_password").val();
        
        $.ajax({
            type: "POST",
            url: "action/assistant_add.php",
            dataType: "json",
            data: {doc_id:doc_id, add_fname:add_fname, add_lname:add_lname, add_email:add_email, add_number:add_number, add_password:add_password},                
            success : function(data){
                if (data){
                    $('#addModal').hide();
                    swal("Good job!", "Details added successfully", "success");
                    setTimeout(function(){ 
                     window.location.href = "manage_assistant.php";
                    }, 2000);
                
                } else {
                    $('#addModal').hide();
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                     setTimeout(function(){ 
                        window.location.href = "manage_assistant.php";
                    }, 2000);
                }
            }
        }); 
    } 
});

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
                $('#password').val(data.password);               
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
        "password": {
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
        }, 
        "password":{
            required: "Please enter a Password!",
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
        var password = $("#password").val();

        $.ajax({
            type: "POST",
            url: "action/assistant_edit.php",
            dataType: "json",
            data: {id:id,first_name:first_name,last_name:last_name,email:email,mobile_number:mobile_number,password:password},                
            success : function(data){
                if (data){
                    $('#editModal').hide();
                    swal("Good job!", "Details updated successfully", "success");
                        setTimeout(function(){ 
                        window.location.href = "manage_assistant.php";
                    }, 2000);
                
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                        setTimeout(function(){ 
                        window.location.href = "manage_assistant.php";
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
                        window.location.href = "manage_assistant.php";
                    }, 2000);
                
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                        setTimeout(function(){ 
                        window.location.href = "manage_assistant.php";
                    }, 2000);
                }
            }
        });
    });
</script>