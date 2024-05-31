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
                                <li class="nav-item"><a href="#subscription-form" data-toggle="tab" class="nav-link">Subscription</a>
                                </li>
                                <li class="nav-item"><a href="#venue-form" data-toggle="tab" class="nav-link">Venue</a>
                                </li>
                                <li class="nav-item"><a href="#password-form" data-toggle="tab" class="nav-link">Change Password</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="edit-form" class="tab-pane fade active show">
                                    <form action="action/basic_profile_add.php" id="basic-profile-form" method="POST" enctype="multipart/form-data">
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
                                                    <label class="custom-file-label">Choose Profile file</label>
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
                                            <label class="col-lg-4 col-form-label" for="val-speciality">Speciality
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <?php 
                                                    $query = "select * from doc_speciality";
                                                    $result = $conn->query($query);
                                                    $arr_speciality = [];
                                                    if($result->num_rows > 0)
                                                    {
                                                        $arr_speciality = $result->fetch_all(MYSQLI_ASSOC);
                                                    }
                                                ?>
                                                <select class="form-control" name="doc_seciality" id="speciality_id">
                                                    <option>Select Speciality</option>
                                                    <?php if(!empty($arr_speciality)) { ?>
                                                        <?php foreach($arr_speciality as $r) { ?>
                                                            <option value="<?php echo $r['id'] ?>"><?php echo $r['name'] ?></option>
                                                    <?php }} ?>
                                                </select>
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
                                            <label class="col-lg-4 col-form-label" for="val-bio">Bio
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <textarea name="bio" class="form-control" id="bio" rows="4" cols="50" placeholder="Enter a bio.."></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-education">Education
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="education" name="education" placeholder="Enter an education..">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-awards">Awards
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="award" name="award" placeholder="Enter an award..">
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
                                            <label class="col-lg-4 col-form-label" for="val-phoneus">Physical Service Charge
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="physical_service_charge" name="physical_service_charge" placeholder="Enter Amount...">
                                                    <div class="input-group-append">
                                                        <span style="background: #656C73; color: #fff;" class="input-group-text">₹</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-phoneus">Telemedicine Service Charge
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="telemedicine_service_charge" name="telemedicine_service_charge" placeholder="Enter Amount...">
                                                    <div class="input-group-append">
                                                        <span style="background: #656C73; color: #fff;" class="input-group-text">₹</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <button type="submit" class="btn btn-primary mb-2">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <div id="venue-form" class="tab-pane fade">
                                    <form action="action/venue_add.php" id="venue-add" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="user_id2" id="user_id2" value="<?php echo $_SESSION['id'];?>">
                                        <div class="form-group row" style="margin = '10px'"></div>
                                        <h4 class="card-title">Venue</h4>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-venue1name">Venue Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="venue_1_name" name="venue_1_name" placeholder="Enter a venue name..">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-venue1address">Venue Address
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="venue_1_address" name="venue_1_address" placeholder="Enter a venue address..">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-venue1starttime">Venue Start Time
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="time" class="form-control" id="venue_1_start_time" name="venue_1_start_time" placeholder="Enter a venue address..">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-venue1endtime">Venue End Time
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="time" class="form-control" id="venue_1_end_time" name="venue_1_end_time" placeholder="Enter a venue address..">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-venue1image">Venue Photo
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group col-lg-6">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" onchange="loadFile2(event)" accept="image/*" id="venue_1_image" name="venue_1_image">
                                                    <label class="custom-file-label">Choose Venue File</label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                            $query = "select venue_1_image from doc_venue where doc_id =". $_SESSION['id'];
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
                                                <img id="venue_1_output"  src=<?php echo "venue-image/".$r['venue_1_image'] ?> style="margin-bottom: 15px;" width="130" class="rounded"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <button type="submit" class="btn btn-primary mb-2">Save Venue</button>
                                        </div>
                                    </form>
                                </div>
                                <div id="subscription-form" class="tab-pane fade">
                                    <form action="action/subscription_doctor.php" id="subscription-add" method="POST">
                                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['id'];?>">
                                        <div class="form-group row" style="margin = '10px'"></div>
                                        <h4 class="card-title">Subscription</h4><br>
                                        <div class="col-sm-9">
                                            <?php 
                                                $query = "select prize from subscription where type = 'fix'";
                                                $result = $conn->query($query);
                                                $arr_speciality = [];
                                                if($result->num_rows > 0)
                                                {
                                                    $arr_speciality = $result->fetch_all(MYSQLI_ASSOC);
                                                }
                                            ?>
                                            <?php 
                                                $query = "select prize from subscription where type = 'percentage'";
                                                $result = $conn->query($query);
                                                $arr1_speciality = [];
                                                if($result->num_rows > 0)
                                                {
                                                    $arr1_speciality = $result->fetch_all(MYSQLI_ASSOC);
                                                }
                                            ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="subscription" value="Fix" id="fix" checked>
                                                <label class="form-check-label">
                                                <?php if(!empty($arr_speciality)) { ?>
                                                <?php foreach($arr_speciality as $r) { ?>
                                                    Fix <?php echo $r['prize'] ?>
                                                <?php }} ?>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="subscription" value="Percentage" id="percentage">
                                                <label class="form-check-label">
                                                <?php if(!empty($arr1_speciality)) { ?>
                                                <?php foreach($arr1_speciality as $r) { ?>
                                                    Percentage <?php echo $r['prize'] ?>%
                                                <?php }} ?>
                                                </label>
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="form-group row">
                                            <button type="submit" class="btn btn-primary mb-2">Submit</button>
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
});

$(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "action/speciality_fetch_by_id.php",
            dataType: "json",
            success : function(data){
                if (data){
                    $('#id').val(data.id);
                    $('#seciality').val(data.seciality);               
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                }
            }
        });
});

$(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "action/doctor_profile_fetch_by_id.php",
            dataType: "json",
            success : function(data){
                if (data){
                    $('#id').val(data.id);
                    $('#physical_service_charge').val(data.physical_service_charge);
                    $('#telemedicine_service_charge').val(data.telemedicine_service_charge);
                    $('#education').val(data.education);
                    $('#award').val(data.award);
                    $('#speciality_id').val(data.speciality_id);               
                } else {
                    swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                }
            }
        });
});


$(document).ready(function() {
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
        "profile-photo": {
            required: !0,
        },
        "birth_date": {
            required: !0,
        },
        "speciality_id": {
            required: !0,
        },
        "bio": {
            required: !0,
        },
        "education": {
            required: !0,
        },
        "award": {
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
        "profile-photo": {
            required: "Please upload prfile-photo!",
        },
        "birth_date": {
            required: "Please enter birth-date!",
        },
        "speciality_id": {
            required: "Please select a speciality!",
        },
        "bio": {
            required: "Please enter a bio!",
        },
        "education": {
            required: "Please enter an education!",
        },
        "award": {
            required: "Please enter an awards!",
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
            var doc_basic_profile_id = $("#doc_basic_profile_id").val();
            var first_name = $("#first_name").val();
            var last_name = $("#last_name").val();
            var mobile_number = $("#mobile_number").val();
            var birth_date = $("#birth_date").val();
            var bio = $("#bio").val();
            var education = $("#education").val();
            var awards = $("#award").val();
            var address = $("#address").val();
            var state = $("#state").val();
            var city = $("#city").val();
            var zip_code = $("#zip_code").val();
            var physical_service_charge = $("#physical_service_charge").val();
            var telemedicine_service_charge = $("#telemedicine_service_charge").val();
            var gender = $('input[name="gender"]:checked').val();
            var speciality_id = $("#speciality_id").val();
            
            $.ajax({
                type: "POST",
                url: "action/basic_profile_add.php",
                dataType: "json",
                data: {id:id, doc_basic_profile_id:doc_basic_profile_id, physical_service_charge:physical_service_charge, telemedicine_service_charge:telemedicine_service_charge, first_name:first_name, birth_date:birth_date, last_name:last_name, mobile_number:mobile_number, bio:bio, education:education, awards:awards, address:address, state:state, city:city, zip_code:zip_code, gender:gender, speciality_id:speciality_id},
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
                            window.location.href = "doctor_profile.php";
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
                            window.location.href = "doctor_profile.php";
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


$(document).ready(function() {
$("#venue-add").validate({
    rules: {
        "venue_1_name": {
            required: !0,
        },
        "venue_1_address": {
            required: !0,
        },
        "venue_1_start_time": {
            required: !0,
        },
        "venue_1_end_time": {
            required: !0,
        },
    },
    messages: {
        "venue_1_name": {
            required: "Please enter a venue name..",
        },
        "venue_1_address": {
            required: "Please enter a venue address..",
        },
        "venue_1_start_time": {
            required: "Please enter a venue 1 start time..",
        },
        "venue_1_end_time": {
            required: "Please enter a venue 1 end time..",
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
            
            var user_id = $("#user_id").val();
            var venue_1_name = $("#venue_1_name").val();
            var venue_1_address = $("#venue_1_address").val();
            var venue_1_start_time = $("#venue_1_start_time").val();
            var venue_1_end_time = $("#venue_1_end_time").val();
            $.ajax({
                type: "POST",
                url: "action/venue_add.php",
                dataType: "json",
                data: {user_id:user_id, venue_1_name:venue_1_name, venue_1_address:venue_1_address, venue_1_start_time:venue_1_start_time, venue_1_end_time:venue_1_end_time},
                success : function(data){
                    if (data){
                        toastr.success("Venue Added", "",
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
                            window.location.href = "doctor_profile.php";
                        }, 1000);
                    } else {
                        toastr.error("Venue not added", "",
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
                            window.location.href = "doctor_profile.php";
                        }, 1000);
                    }
                }
            });
            return false;
        } 
    });
});


var loadFile2 = function(event) {
    var venue_1_output = document.getElementById('venue_1_output');
    venue_1_output.src = URL.createObjectURL(event.target.files[0]);
    venue_1_output.onload = function() {
      URL.revokeObjectURL(venue_1_output.src)
    }
};

$("#venue-add").on('submit',(function(e) {
    e.preventDefault();
    $.ajax({
        url: "action/venue_image_upload.php",
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
    var id=$("#user_id").val();
    $.ajax({
        type: "GET",
        url: "action/venue_fetch_by_id.php",
        dataType: "json",
        data: {id:id},
        success : function(data){
            if (data){
                $('#id').val(data.id);
                $('#venue_1_name').val(data.venue_1_name);
                $('#venue_1_address').val(data.venue_1_address);
                $('#venue_1_start_time').val(data.venue_1_start_time);
                $('#venue_1_end_time').val(data.venue_1_end_time);
            } else {    
                swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
            }
        }
    });
});

$(document).ready(function() {
$("#subscription-form").validate({
    // rules: {
    //     "venue_1_name": {
    //         required: !0,
    //     },
    //     "venue_1_address": {
    //         required: !0,
    //     },
    //     "venue_1_image": {
    //         required: !0,
    //     },
    // },
    // messages: {
    //     "venue_1_name": {
    //         required: "Please enter a venue name..",
    //     },
    //     "venue_1_address": {
    //         required: "Please enter a venue address..",
    //     },
    //     "venue_1_image": {
    //         required: "Please enter a venue image..",
    //     },
    // },
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
            
            var user_id = $("#user_id").val();
            var subscription =  $('input[name="subscription"]:checked').val();
            $.ajax({
                type: "POST",
                url: "action/subscription_doctor.php",
                dataType: "json",
                data: {user_id:user_id,subscription:subscription},
                success : function(data){
                    if (data){
                        toastr.success("Subscription Added", "",
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
                            window.location.href = "doctor_profile.php";
                        }, 1000);
                    } else {
                        toastr.error("subscription not added", "",
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
                    }
                    setTimeout(function(){ 
                        window.location.href = "doctor_profile.php";
                    }, 1000);
                }
            });
            return false;
        } 
    });
});

$(document).ready(function() {
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
                            window.location.href = "doctor_profile.php";
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
                            window.location.href = "doctor_profile.php";
                        }, 1000);
                    }
                }
            });
            return false;
        } 
    });
});
</script>