<?php
	include "header.php";
    include "action/databaseconn.php";
?>
<div class="col-xl-12">
    <div class="card">
        <div class="card-body">
            <div class="profile-tab">
                <div class="custom-tab-1">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a href="#edit-form" data-toggle="tab" class="nav-link active show">Basic Profile</a>
                        </li>
                        <li class="nav-item"><a href="#password-form" data-toggle="tab" class="nav-link">Change Password</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="edit-form" class="tab-pane fade active show">
                            <form action="action/patient_profile_add.php" id="basic-profile-form" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id'];?>">
                                <div class="form-group row" style="margin = '10px'"></div>
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
                                    <label class="col-lg-4 col-form-label" for="val-phoneus">Mobile No
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="212-999-0000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-photo">Profile Photo
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group col-lg-6">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" onchange="loadFile1(event)" accept="image/*" id="profile_photo" name="profile_photo">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    $query = "select profile_photo from user where id =". $_SESSION['id'];
                                    $result = $conn->query($query);
                                    $arr_doctor = [];
                                    if($result->num_rows > 0)
                                    {
                                        $arr_doctor = $result->fetch_all(MYSQLI_ASSOC);
                                    }
                                ?>
                                <?php if(!empty($arr_doctor)) { ?>
                                <?php foreach($arr_doctor as $r) { ?>
                                <?php }} ?>
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-6">
                                        <img id="output"  src=<?php echo "image/".$r['profile_photo'] ?> style="margin-bottom: 15px;" width="130" class="rounded"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-gender">Gender
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <div>
                                            <input class="radio-inline mr-2" type="radio" id="male_gender" name="gender" value="Male">Male
                                        </div>
                                        <div>
                                            <input class="radio-inline mr-2" type="radio" id="female_gender" name="gender" value="Female">Female
                                        </div>
                                        <div>
                                            <input class="radio-inline mr-2" type="radio" id="other_gender" name="gender" value="Other">Other
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-birth-date">Birth date
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" id="birth_date" name="birth_date"  placeholder="Enter a birth-date..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-health-issue">Health Issue
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="health_issue" name="health_issue"  placeholder="Enter a health-issue..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-bio">Bio
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <textarea name="bio" class="form-control" id="bio" rows="4" cols="50" placeholder="Enter a bio.."></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-address">Address(House No, Building, Street, Area)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="address" name="address"  placeholder="Enter an address..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-state">State
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="state" name="state"  placeholder="Enter a state..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-city">City
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter a city..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-zipcode">Zip-code
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter a zip-code..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button type="submit" class="btn btn-primary mb-2">Save</button>
                                </div>
                            </form>
                        </div>
                        <div id="password-form" class="tab-pane fade">
                            <form action="action/change_password.php" id="password_change" method="POST">
                                <div class="form-group row" style="margin = '10px'"></div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-oldpassword">Old Password
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control" id="old_password" name="old_password" autocomplete="off" placeholder="Enter an old password..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-newpassword">New Password
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control" id="new_password" name="new_password" autocomplete="off" placeholder="Enter a new password..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-confirmnewpassword">Confirm New Password <span
                                        class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" autocomplete="off" placeholder="..and confirm it!">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <button type="submit" class="btn btn-primary mb-2">Save</button>
                                </div>
                            </form>
                        </div>
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
$(document).ready(function(){
var id=$("#user_id").val();
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
            $('#mobile_number').val(data.mobile_number);
            $('#birth_date').val(data.birth_date);
            $('#health_issue').val(data.health_issue);
            $('#bio').val(data.bio);
            $('#address').val(data.address);
            $('#state').val(data.state);
            $('#city').val(data.city);
            $('#zip_code').val(data.zip_code);
            $('#gender').val(data.gender);
            {
                if(data.gender === "Male")
                {
                    $('#male_gender').prop('checked',true);
                }
                else if(data.gender === "Female")
                {
                    $('#female_gender').prop('checked',true);
                }
                else if(data.gender === "Other")
                {
                    $('#other_gender').prop('checked',true);
                }
            }
        } else {    
            swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
        }
    }
});

$.ajax({
    type: "GET",
    url: "action/patient_profile_fetch_by_id.php",
    dataType: "json",
    data: {id:id},
    success : function(data){
        if (data){
            $('#id').val(data.id);
            $('#health_issue').val(data.health_issue);
        } else {    
            swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
        }
    }
});

$("#basic-profile-form").validate({
    rules: {
        "first_name": {
            required: !0,
        },
        "last_name": {
            required: !0,
        },
        "mobile_number": {
            required: !0,
        },
        "birth_date": {
            required: !0,
        },
        "profile-photo": {
            required: !0,
        },
        "bio": {
            required: !0,
        },
        "address": {
            required: !0,
        },
        "state": {
            required: !0,
        },
        "city": {
            required: !0,
        },
        "zip_code": {
            required: !0,
            minlength: 6
        },
        "gender": {
            required: !0,
        },
    },
    messages: {
        "first_name": {
            required: "Please enter a firstname",
        },
        "last_name": {
            required: "Please enter a lastname",
        },
        "mobile_number": {
            required: "Please enter a mobile number!",
        },
        "birth_date": {
            required: "Please enter a birth-date!",
        },
        "profile-photo": {
            required: "Please upload prfile-photo!",
        },
        "speciality_id": {
            required: "Please select a speciality!",
        },
        "bio": {
            required: "Please enter a bio!",
        },
        "address": {
            required: "Please enter an address!",
        },
        "state": {
            required: "Please enter a state!",
        },
        "city": {
            required: "Please enter a city!",
        },
        "zip_code": {
            required: "Please enter a zip-code!",
            minlength: "Your zip-code must be at least 6 characters long"
        },
        "gender": {
            required: "Please select gender!",
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
    submitHandler: function(form,e) {
            e.preventDefault();

            var id = $("#user_id").val();
            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();
            var mobile_number = $("#mobile_number").val();
            var birth_date = $("#birth_date").val();
            var health_issue = $("#health_issue").val();
            var bio = $("#bio").val();
            var address = $("#address").val();
            var state = $("#state").val();
            var city = $("#city").val();
            var zip_code = $("#zip_code").val();
            var gender = $('input[name="gender"]:checked').val();
            
            $.ajax({
                type: "POST",
                url: "action/patient_profile_add.php",
                dataType: "json",
                data: {id:id, first_name:first_name, last_name:last_name, mobile_number:mobile_number, birth_date:birth_date, health_issue:health_issue, bio:bio, address:address, state:state, city:city, zip_code:zip_code, gender:gender},
                success : function(data){
                    if (data){
                        toastr.success("Basic Profile Changed", "",
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
                            window.location.href = "patient_profile.php";
                        }, 1900);
                    } else {
                        toastr.error("Basic Profile Not Changed", "",
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
                            window.location.href = "patient_profile.php";
                        }, 1900);
                    }
                }
            });
        } 
    });
});

var loadFile1 = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
};

$("#basic-profile-form").on('submit',(function(e) {
    e.preventDefault();
    $.ajax({
        url: "action/image_upload.php",
        type: "POST",
        data:   new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(data)
        {
            if(data)
            {
                return true;
            }
            else
            {
                return false;
            }
        }        
    });
})
)

$(document).ready(function(){
$("#password_change").validate({
    rules: {
        "old_password": {
            required: !0,
            minlength: 5
        },
        "new_password": {
            required: !0,
            minlength: 5
        },
        "confirm_new_password": {
            required: !0,
            equalTo: "#new_password"
        },
    },
    messages: {
        "old_password": {
            required: "Please provide an old password",
            minlength: "Your password must be at least 5 characters long"
        },
        "new_password": {
            required: "Please provide a new password",
            minlength: "Your password must be at least 5 characters long"
        },
        "confirm_new_password": {
            required: "Please confirm a new password",
            minlength: "Your password must be at least 5 characters long",
            equalTo: "Please enter the same password as above"
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
    submitHandler: function(form,e) {
            e.preventDefault();
            
            var old_password = $("#old_password").val();
            var new_password = $("#new_password").val();
            $.ajax({
                type: "POST",
                url: "action/change_password.php",
                dataType: "json",
                data: {old_password:old_password, new_password:new_password},
                success : function(data){
                    if (data){
                        toastr.success("Password Changed", "",
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
                            window.location.href = "patient_profile.php";
                        }, 1000);
                    } else {
                        toastr.error("Password Not Changed", "",
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
                            window.location.href = "patient_profile.php";
                        }, 1000);
                    }
                }
            });
            return false;
        } 
    });
});
</script>