<?php
	include "header.php";
    include "action/databaseconn.php";
?>
<div>
    <div class="container-fluid">
        <div class="form-head d-flex mb-3 mb-lg-5 align-items-start">
            <a href="javascript:void(0)" class="btn btn-success ml-auto px-5" data-toggle="modal" data-target="#addAppointmentModal">+ Book An Appointment</a>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex doctor-info-details mb-5">
                                    <?php 
                                        $query = "SELECT * FROM user INNER JOIN doc_basic_profile ON doc_basic_profile.user_id = user.id WHERE id = '".$_GET['id']."'";
                                        $result = mysqli_query($conn, $query);
                                        $arr_doctor = [];
                                        if($result->num_rows > 0)
                                        {
                                            $arr_doctor = $result->fetch_all(MYSQLI_ASSOC);
                                        }
                                    ?>
                                    <?php if(!empty($arr_doctor)) { ?>
                                    <?php foreach($arr_doctor as $r) { ?>
                                    <div class="media align-self-start">
                                    <?php    
                                        if ($r['profile_photo'] > 0) {
                                        ?>
                                        <img class="rounded" width="130" src=<?php echo "image/".$r['profile_photo'] ?> alt="">
                                    <?php
                                    }
                                    else {
                                        ?>
                                        <img class="rounded" src="images/avatar/727399.png" width="130" alt=""/>
                                    <?php
                                    }
                                    ?>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="mb-2"><?=$r['first_name']?> <?=$r['last_name']?></h2>
                                    <?php }} ?>    
                                        <p class="mb-md-2 mb-sm-4 mb-2"><?=$r['bio']?></p>
                                    </div>
                                    <div class="text-md-right mt-4 mt-md-0">
                                        <?php
                                    $sql = "SELECT * FROM rating where doc_id = '".$_GET['id']."'";
                                    if ($result=mysqli_query($conn,$sql)) {
                                       $rowcount=mysqli_num_rows($result); 
                                    }
                                    ?>
                                    <?php 
                                        $query2 = "SELECT AVG(rating) AS averagerating FROM rating where doc_id = '".$_GET['id']."'";
                                        $result2 = $conn->query($query2);
                                        $arr_rating = [];
                                        if($result2->num_rows > 0)
                                        {  
                                        $arr_rating = $result2->fetch_all(MYSQLI_ASSOC);
                                        }
                                    ?>
                                    <?php if(!empty($arr_rating)) { ?>
                                    <?php foreach($arr_rating as $r2) { ?>
                                        <?php if ($r2['averagerating'] > "4" or $r2['averagerating'] == "5") { ?>
                                        <div class="star-review">
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <span class="ml-3"><?php echo $rowcount ?> reviews</span>
                                        </div>
                                        <?php }elseif ($r2['averagerating'] < "4" && $r2['averagerating'] > "3" or $r2['averagerating'] == "4") { ?>
                                        <div class="star-review">
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <span class="ml-3"><?php echo $rowcount ?> reviews</span>
                                        </div>
                                        <?php }elseif ($r2['averagerating'] < "3" && $r2['averagerating'] > "2" or $r2['averagerating'] == "3") { ?>
                                        <div class="star-review">
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <span class="ml-3"><?php echo $rowcount ?> reviews</span>
                                        </div>
                                        <?php }elseif ($r2['averagerating'] < "2" && $r2['averagerating'] > "1" or $r2['averagerating'] == "2") { ?>
                                        <div class="star-review">
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <span class="ml-3"><?php echo $rowcount ?> reviews</span>
                                        </div>
                                        <?php }elseif ($r2['averagerating'] < "1" && $r2['averagerating'] > "0" or $r2['averagerating'] == "1") { ?>
                                        <div class="star-review">
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <span class="ml-3"><?php echo $rowcount ?> reviews</span>
                                        </div>
                                        <?php } else { ?>
                                        <div class="star-review">
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <span class="ml-3"><?php echo $rowcount ?> reviews</span>
                                        </div>
                                        <?php }?>
                                    <?php }} ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="doctor-info-content col-md-6">
                                        <h3 class="text-black mb-3">Education</h3>
                                        <p class="mb-3"><?=$r['education']?></p>
                                    </div>
                                    <div class="doctor-info-content col-md-6">
                                        <h3 class="text-black mb-3">Award</h3>
                                        <p class="mb-3"><?=$r['award']?></p>
                                    </div>
                                    <div class="doctor-info-content col-md-6">
                                        <h3 class="text-black mb-3">Physical Service Charge</h3>
                                        <p class="mb-3"><?=$r['physical_service_charge']." ₹"?></p>
                                    </div>
                                    <div class="doctor-info-content col-md-6">
                                        <h3 class="text-black mb-3">Telemedicine Service Charge</h3>
                                        <p class="mb-3"><?=$r['telemedicine_service_charge']." ₹"?></p>
                                    </div>
                                    <div class="doctor-info-content col-md-6">
                                        <h3 class="text-black mb-3">Speciality</h3>
                                        <p>
                                        <?php 
                                            $query = "select * from doc_speciality where id = '".$r['speciality_id']."'";
                                            $result = $conn->query($query);
                                            $arr_speciality = [];
                                            if($result->num_rows > 0)
                                            {
                                                $arr_speciality = $result->fetch_all(MYSQLI_ASSOC);
                                            }
                                        ?>
                                        <?php if(!empty($arr_speciality)) { ?>
                                            <?php foreach($arr_speciality as $r) { ?>
                                                <p value="<?php echo $r['id'] ?>"><?php echo $r['name'] ?></p>
                                        <?php }} ?>
                                        </p>
                                    </div>
                                    <div class="doctor-info-content col-md-6">
                                        <p>
                                            <?php 
                                                $query = "select * from doc_venue where doc_id = '".$_GET['id']."'";
                                                $result = mysqli_query($conn, $query);
                                                $arr_venue = [];
                                                if($result->num_rows > 0)
                                                {
                                                    $arr_venue = $result->fetch_all(MYSQLI_ASSOC);
                                                }
                                            ?>
                                            <?php if(!empty($arr_venue)) { ?>
                                            <?php foreach($arr_venue as $r1) { ?>
                                            <h3 class="text-black mb-3">Venue Name</h3>
                                            <p class="mb-3"><?=$r1['venue_1_name']?></p>
                                        </p>
                                    </div>
                                    <div class="doctor-info-content col-md-6">
                                        <h3 class="text-black mb-3">Venue Address</h3>
                                        <p class="mb-3"><?=$r1['venue_1_address']?></p>
                                    </div>
                                    <div class="doctor-info-content col-md-6">
                                        <h3 class="text-black mb-3">Venue Image</h3>
                                        <img alt="image" class="rounded" width="130" src=<?php echo "venue-image/".$r1['venue_1_image'] ?>>
                                    </div>
                                </div>
                                <?php }} ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <h4 class="card-title">Recent Review</h4>
                            </div>
                            <div class="card-body pt-0 pb-0 loadmore-content height600 dz-scroll" id="recentReviewsContent">
                                <?php 
                                    $query = "select * from rating where doc_id = '".$_GET['id']."'";
                                    $result = $conn->query($query);
                                    $arr_speciality = [];
                                    if($result->num_rows > 0)
                                    {
                                        $arr_speciality = $result->fetch_all(MYSQLI_ASSOC);
                                    }
                                ?>
                                <?php if(!empty($arr_speciality)) { ?>
                                    <?php foreach($arr_speciality as $r) { ?>
                                <div class="media review-box mb-4">
                                    <?php 
                                        $query = "select * from user where id = '".$r['patient_id']."'";
                                        $result1 = $conn->query($query);
                                        $arr_doc = [];
                                        if($result1->num_rows > 0)
                                        {
                                            $arr_doc = $result1->fetch_all(MYSQLI_ASSOC);
                                        }
                                    ?>
                                    <?php if(!empty($arr_doc)) { ?>
                                    <?php foreach($arr_doc as $r1) { ?>
                                    <img class="mr-3 img-fluid rounded" width="105" src=<?php echo "image/".$r1['profile_photo'] ?> alt="DexignZone">
                                    <div class="media-body">
                                        <h4 class="mt-0 mb-3"><a href="doctors-review.html" class="text-black">
                                            <?php echo $r1['first_name'] ?> <?php echo $r1['last_name'] ?></a>
                                        <?php }} ?>
                                        </h4>
                                        <p class="mb-3"><?php echo $r['review'] ?></p>
                                        <?php if ($r['rating'] > "4" or $r['rating'] == "5") { ?>
                                            <span class="btn btn-xs light btn-success btn-rounded mb-1">EXCELENT</span>
                                        <?php }elseif ($r['rating'] < "4" && $r['rating'] > "3" or $r['rating'] == "4") { ?>
                                            <span class="btn btn-xs light btn-success btn-rounded mb-1">GOOD</span>
                                        <?php }elseif ($r['rating'] < "3" && $r['rating'] > "2" or $r['rating'] == "3") { ?>
                                            <span class="btn btn-xs light btn-warning btn-rounded mb-1">AVERAGE</span>
                                        <?php }elseif ($r['rating'] < "2" && $r['rating'] > "1" or $r['rating'] == "2") { ?>
                                            <span class="btn btn-xs light btn-warning btn-rounded mb-1">POOR</span>
                                        <?php }elseif ($r['rating'] < "1" && $r['rating'] > "0" or $r['rating'] == "1") { ?>
                                            <span class="btn btn-xs light btn-danger btn-rounded mb-1">VERY POOR</span>
                                        <?php } else { ?>
                                            <span class="btn btn-xs light btn-danger btn-rounded mb-1">EXTREMELY POOR</span>
                                        <?php } ?>
                                    </div>
                                    <div class="media-footer">
                                        <?php if ($r['rating'] > "4" or $r['rating'] == "5") { ?>
                                        <div class="star-review text-md-center">
                                            <span class="text-primary"><?php echo $r['rating'] ?>.0</span>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                        </div>
                                        <?php }elseif ($r['rating'] < "4" && $r['rating'] > "3" or $r['rating'] == "4") { ?>
                                        <div class="star-review text-md-center">
                                            <span class="text-primary"><?php echo $r['rating'] ?>.0</span>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-gray"></i>
                                        </div>
                                        <?php }elseif ($r['rating'] < "3" && $r['rating'] > "2" or $r['rating'] == "3") { ?>
                                        <div class="star-review text-md-center">
                                            <span class="text-primary"><?php echo $r['rating'] ?>.0</span>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                        </div>
                                        <?php }elseif ($r['rating'] < "2" && $r['rating'] > "1" or $r['rating'] == "2") { ?>
                                        <div class="star-review text-md-center">
                                            <span class="text-primary"><?php echo $r['rating'] ?>.0</span>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                        </div>
                                        <?php }elseif ($r['rating'] < "1" && $r['rating'] > "0" or $r['rating'] == "1") { ?>
                                        <div class="star-review text-md-center">
                                            <span class="text-primary"><?php echo $r['rating'] ?>.0</span>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                        </div>
                                        <?php } else { ?>
                                        <div class="star-review text-md-center">
                                            <span class="text-primary"><?php echo $r['rating'] ?>.0</span>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                                <?php }} ?>
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
<div class="modal fade" id="addAppointmentModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="appointment-form" action="action/appointment_book.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Book Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $_SESSION['id'];?>">
                    <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $_GET['id'];?>">
                    <div class="form-group">
                    <?php 
                        $q = "SELECT * FROM doc_venue WHERE doc_id = '".$_GET['id']."'";
                        $re = mysqli_query($conn, $q);
                        $arr_time = [];
                        if($re->num_rows > 0)
                        {
                            $arr_time = $re->fetch_all(MYSQLI_ASSOC);
                        }
                    ?>
                    <?php if(!empty($arr_time)) { ?>
                    <?php foreach($arr_time as $r10) { ?>
                        <div class="timeline" style="background: #f2d5f8; padding: 15px 20px; border-radius: 0.75rem; color:#000;">
                            <span class="text-primary"><b>Doctor's Venue Timing :</b></span><br>   
                            <?php
                                $dateTime1 = date('h:i A', strtotime($r10['venue_1_start_time']));
                                $dateTime2 = date('h:i A', strtotime($r10['venue_1_end_time']));
                            ?> 
                            <span><?php echo $dateTime1." to ".$dateTime2 ?></span>
                        </div>
                        <?php }} ?>
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Appointment Type</label>
                        <select class="form-control" name="appointment_type" id="appointment_type">
                            <option value="">Select Type</option>    
                            <option value="Physical">Physical</option>
                            <option value="Telemedicine">Telemedicine</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Dieseas</label>
                        <textarea type="text" name="dieseas" id="dieseas" class="form-control" rows="4" cols="50" placeholder="Enter a dieseas.."></textarea>
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Appointment Date & Time</label>
                        <input type="text" class="form-control" placeholder="set appointment time" id="appointment_time">
                        <!-- <input type="datetime-local" name="appointment_time" id="appointment_time" class="form-control"> -->
                    </div>
                    <div class="form-group">
                        <div class="timeline" style="background: #fee6ea; padding: 15px 20px; border-radius: 0.75rem; color:#000;">
                            <span class="text-warning"><b>Note :</b></span>    
                            <span>Appointment duration is 30 Minutes.</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" type="button" class="btn btn-primary">CREATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

let date = new Date();
var tzoffset = date.getTimezoneOffset() * 60000;
var localISOTime = (new Date(date - tzoffset)).toISOString().slice(0, -1);
document.getElementById("appointment_time").min = localISOTime.slice(0,16);

$('#appointment_time').bootstrapMaterialDatePicker({
    format: 'DD/MM/YYYY hh:mm A',
    minDate: new Date()
});

$("#appointment-form").validate({
rules: {
    "appointment_type": {
        required: !0,
    },
    "dieseas": {
        required: !0,
    },
    "appointment_time": {
        required: !0,
    },
},
messages: {
    "appointment_type": {
        required: "Please choose an appointment-type!",
    },
    "dieseas": {
        required: "Please enter a dieseas!",
    },
    "appointment_time": {
        required: "Please enter a appointment_time!",
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
        
        var patient_id = $("#patient_id").val();
        var doctor_id = $("#doctor_id").val();
        var appointment_type = $("#appointment_type").val();
        var dieseas = $("#dieseas").val();
        var appointment_time = $("#appointment_time").val();
        $.ajax({
            type: "POST",
            url: "action/appointment_book.php",
            dataType: "json",
            data: {patient_id:patient_id, doctor_id:doctor_id, appointment_type:appointment_type, dieseas:dieseas, appointment_time:appointment_time},
            success : function(data){
                if (data == "3"){
                        toastr.success("Appointment Booked Successfully", "",
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
                            window.location.href = "doctor_detail.php?id="+doctor_id;
                        }, 1900);
                    } else if (data == "1") {
                        toastr.error("Doctor Is Not Available", "",
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
                            window.location.href = "doctor_detail.php?id="+doctor_id;
                        }, 1900);
                    } else if (data == "2") {
                        toastr.error("This Time Is Booked, Please Choose Another Time", "",
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
                            window.location.href = "doctor_detail.php?id="+doctor_id;
                        }, 1900);
                    }else {
                        toastr.error("Appointment Not Booked", "",
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
                            window.location.href = "doctor_detail.php?id="+doctor_id;
                        }, 1900);
                    }
            }
        });
        return false;
    } 
});
</script>