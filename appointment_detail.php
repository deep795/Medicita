<?php
	include "header.php";
    include "action/databaseconn.php";
?>
<?php
if ($_SESSION['user_type'] == "Assistant") { ?>
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="height: auto;">
                            <div class="card-body">
                            <?php 
                                $query = "SELECT * FROM appointment WHERE appointment_id = '".$_GET['appointment_id']."'";
                                $result = mysqli_query($conn, $query);
                                $arr_doctor = [];
                                if($result->num_rows > 0)
                                {
                                    $arr_doctor = $result->fetch_all(MYSQLI_ASSOC);
                                }
                            ?>
                            <?php if(!empty($arr_doctor)) { ?>
                            <?php foreach($arr_doctor as $r) { ?>
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
                                            <div class="row">
                                                <div class="doctor-info-content col-sm-6">
                                                    <h3 class="text-black mb-3">Patient name</h3>
                                                    <p class="mb-3"><?=$r2['first_name']?> <?=$r2['last_name']?></p>
                                                </div>
                                                <div class="doctor-info-content col-sm-6">
                                                    <h3 class="text-black mb-3">Appointment Type</h3>
                                                    <p class="mb-3"><?=$r['appointment_type']?></p>
                                                </div>
                                                <div class="doctor-info-content col-sm-6">
                                                    <h3 class="text-black mb-3">Dieseas</h3>
                                                    <p class="mb-3"><?=$r['dieseas']?></p>
                                                </div>
                                                <div class="doctor-info-content col-sm-6">
                                                    <h3 class="text-black mb-3">Appointment Time</h3>
                                                    <p class="mb-3"><?php $date = new DateTime($r['appointment_time']); echo $date->format('d-m-Y H:i:s'); ?></p>
                                                </div>
                                                <div class="doctor-info-content col-sm-6">
                                                    <h3 class="text-black mb-3">Status</h3>
                                                    <?php
                                                        if( $r['status'] == "Upcoming")
                                                        {
                                                            ?>
                                                            <span class="badge light badge-primary" style="margin-bottom: 15px;"><?php echo $r['status'] ?></span>
                                                            <div class="doctor-info-content col-sm-6">
                                                                <form id="prescription-form" method="POST">
                                                                <input type="hidden" name="appointment_id" id="appointment_id" value = "<?php echo $_GET['appointment_id'] ?>">
                                                                    <div class="form-group row">
                                                                    <h3 class="text-black mb-3">Prescription</h3>
                                                                    </div>
                                                                    <textarea readonly name="prescription" style="width:200%; margin-left: -15px; margin-top: -18px;" class="form-control" id="prescription" rows="4" cols="50" placeholder="Enter a prescription..."></textarea>
                                                                    </div>
                                                                    <div>
                                                                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                                                                    </div>
                                                                </form>
                                                            <div>
                                                            <?php
                                                        }
                                                        elseif($r['status']=="Completed")
                                                        {
                                                            ?>
                                                            <span class="badge light badge-success" style="margin-bottom: 15px;"><?php echo $r['status'] ?></span>
                                                            <div class="doctor-info-content col-sm-6">
                                                                <form id="prescription-form" method="POST">
                                                                <input type="hidden" name="appointment_id" id="appointment_id" value = "<?php echo $_GET['appointment_id'] ?>">
                                                                    <div class="form-group row">
                                                                        <h3 class="text-black mb-3">Prescription</h3>
                                                                        </div>
                                                                        <textarea readonly name="prescription" style="width:200%; margin-left: -15px; margin-top: -18px;" class="form-control" id="prescription" rows="4" cols="50" placeholder="Enter a prescription..."></textarea>
                                                                        </div>
                                                                        <div>
                                                                    </div>
                                                                </form>
                                                            <div>
                                                            <?php
                                                        }
                                                        elseif($r['status']=="Canceled")
                                                        {
                                                            ?>
                                                            <span class="badge light badge-danger"><?php echo $r['status'] ?></span>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <span class="badge light badge-warning"><?php echo $r['status'] ?></span>
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }} ?>
                                <?php }} ?>
                            </div>
                        </div>
                        <?php
                            if($r['status']=="Completed")
                            {
                        ?>
                        <div class="card" style="height: auto;">
                            <div class="card-body">
                                <div class="row">
                                <div class="doctor-info-content col-sm-6">
                                <form id="rating-form" method="POST">
                                    <input type="hidden" name="appointment_id" id="appointment_id" value = "<?php echo $_GET['appointment_id'] ?>">
                                    <input type="hidden" name="patient_id" id="patient_id" value = "<?php echo $_SESSION['id'] ?>">
                                    <input type="hidden" name="doc_id" id="doc_id" value = "<?php echo $r['doc_id'] ?>">
                                    <input type="hidden" name="rating_id" id="rating_id">
                                    <div class="form-group row">
                                        <h3 class="text-black mb-3" >Rating & Review</h3>
                                    </div>
                                    <div class="rate" style="margin-left: -25px;margin-top: -32px;">
                                        <input type="radio" id="star5" name="rating" value="5" />
                                        <label for="star5">5 stars</label>
                                        <input type="radio" id="star4" name="rating" value="4" />
                                        <label for="star4">4 stars</label>
                                        <input type="radio" id="star3" name="rating" value="3" />
                                        <label for="star3">3 stars</label>
                                        <input type="radio" id="star2" name="rating" value="2" />
                                        <label for="star2">2 stars</label>
                                        <input type="radio" id="star1" name="rating" value="1" />
                                        <label for="star1">1 star</label>
                                    </div>
                                    <textarea name="review" style="width:200%; margin-left: -15px; margin-top: -18px;" class="form-control mb-3" id="review" rows="4" cols="50" placeholder="Enter a review..."></textarea>
                                </form>
                                </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }else{?>
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="height: auto;">
                            <div class="card-body">
                            <?php 
                                $query = "SELECT * FROM appointment WHERE appointment_id = '".$_GET['appointment_id']."'";
                                $result = mysqli_query($conn, $query);
                                $arr_doctor = [];
                                if($result->num_rows > 0)
                                {
                                    $arr_doctor = $result->fetch_all(MYSQLI_ASSOC);
                                }
                            ?>
                            <?php if(!empty($arr_doctor)) { ?>
                            <?php foreach($arr_doctor as $r) { ?>
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
                                            <div class="row">
                                                <div class="doctor-info-content col-sm-6">
                                                    <h3 class="text-black mb-3">Patient name</h3>
                                                    <p class="mb-3"><?=$r2['first_name']?> <?=$r2['last_name']?></p>
                                                </div>
                                                <div class="doctor-info-content col-sm-6">
                                                    <h3 class="text-black mb-3">Appointment Type</h3>
                                                    <p class="mb-3"><?=$r['appointment_type']?></p>
                                                </div>
                                                <div class="doctor-info-content col-sm-6">
                                                    <h3 class="text-black mb-3">Appointment Time</h3>
                                                    <p class="mb-3"><?php $date = new DateTime($r['appointment_time']); echo $date->format('d-m-Y H:i:s'); ?></p>
                                                </div>
                                                <div class="doctor-info-content col-sm-6">
                                                    <h3 class="text-black mb-3">Appointment End Time</h3>
                                                    <p class="mb-3"><?php $date = new DateTime($r['appointment_end_time']); echo $date->format('d-m-Y H:i:s'); ?></p>
                                                </div>
                                                <div class="doctor-info-content col-sm-6">
                                                    <h3 class="text-black mb-3">Dieseas</h3>
                                                    <p class="mb-3"><?=$r['dieseas']?></p>
                                                </div>
                                                <?php 
                                                if($r['appointment_type'] == "Telemedicine" && $r['status'] == "Inprogress")
                                                {
                                                    $url = "video_call.php?channel=appointment_".$r['appointment_id'];
                                                    ?>
                                                <div class="doctor-info-content col-sm-6">
                                                    <h3 class="text-black mb-3">Start Call</h3>
                                                    <a href="<?=$url?>"><h3 class="btn light btn-info"><i class="fa fa-phone"></i> Join Call</h3></a>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                                <div class="doctor-info-content col-sm-6">
                                                    <h3 class="text-black mb-3">Status</h3>
                                                    <?php
                                                        if( $r['status'] == "Upcoming")
                                                        {
                                                            ?>
                                                            <span class="badge light badge-primary" style="margin-bottom: 15px;"><?php echo $r['status'] ?></span>
                                                            <!-- <div class="doctor-info-content col-sm-6">
                                                                <form id="prescription-form" method="POST">
                                                                <input type="hidden" name="appointment_id" id="appointment_id" value = "<?php echo $_GET['appointment_id'] ?>">
                                                                    <div class="form-group row">
                                                                    <h3 class="text-black mb-3">Prescription</h3>
                                                                    </div>
                                                                    <textarea name="prescription" style="width:200%; margin-left: -15px; margin-top: -18px;" class="form-control" id="prescription" rows="4" cols="50" placeholder="Enter a prescription..."></textarea>
                                                                    </div>
                                                                    <div>
                                                                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                                                                    </div>
                                                                </form>
                                                            <div> -->
                                                            <?php
                                                        }
                                                        elseif($r['status']=="Completed")
                                                        {
                                                            ?>
                                                            <span class="badge light badge-success" style="margin-bottom: 15px;"><?php echo $r['status'] ?></span>
                                                            <div class="doctor-info-content col-sm-6">
                                                                <form id="prescription-form" method="POST">
                                                                <input type="hidden" name="appointment_id" id="appointment_id" value = "<?php echo $_GET['appointment_id'] ?>">
                                                                    <div class="form-group row">
                                                                    <h3 class="text-black mb-3">Prescription</h3>
                                                                    </div>
                                                                    <textarea name="prescription" style="width:200%; margin-left: -15px; margin-top: -18px;" class="form-control" id="prescription" rows="4" cols="50" placeholder="Enter a prescription..."></textarea>
                                                                    </div>
                                                                    <div>
                                                                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                                                                    </div>
                                                                </form>
                                                            <div>
                                                            <?php
                                                        }
                                                        elseif($r['status']=="Canceled")
                                                        {
                                                            ?>
                                                            <span class="badge light badge-danger" style="margin-bottom: 15px;"><?php echo $r['status'] ?></span>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <span class="badge light badge-warning" style="margin-bottom: 15px;"><?php echo $r['status'] ?></span>
                                                            <div class="doctor-info-content col-sm-6">
                                                                <form id="prescription-form" method="POST">
                                                                <input type="hidden" name="appointment_id" id="appointment_id" value = "<?php echo $_GET['appointment_id'] ?>">
                                                                    <div class="form-group row">
                                                                    <h3 class="text-black mb-3">Prescription</h3>
                                                                    </div>
                                                                    <textarea name="prescription" style="width:200%; margin-left: -15px; margin-top: -18px;" class="form-control" id="prescription" rows="4" cols="50" placeholder="Enter a prescription..."></textarea>
                                                                    </div>
                                                                    <div>
                                                                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                                                                    </div>
                                                                </form>
                                                            <div>
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }} ?>
                                <?php }} ?>
                            </div>
                        </div>
                        <?php
                            if($r['status']=="Completed")
                            {
                        ?>
                        <div class="card" style="height: auto;">
                            <div class="card-body">
                                <div class="row">
                                <div class="doctor-info-content col-sm-6">
                                <form id="rating-form" method="POST">
                                    <input type="hidden" name="appointment_id" id="appointment_id" value = "<?php echo $_GET['appointment_id'] ?>">
                                    <input type="hidden" name="patient_id" id="patient_id" value = "<?php echo $_SESSION['id'] ?>">
                                    <input type="hidden" name="doc_id" id="doc_id" value = "<?php echo $r['doc_id'] ?>">
                                    <input type="hidden" name="rating_id" id="rating_id">
                                    <div class="form-group row">
                                        <h3 class="text-black mb-3" >Rating & Review</h3>
                                    </div>
                                    <div class="rate" style="margin-left: -25px;margin-top: -32px;">
                                        <input type="radio" id="star5" name="rating" value="5" />
                                        <label for="star5">5 stars</label>
                                        <input type="radio" id="star4" name="rating" value="4" />
                                        <label for="star4">4 stars</label>
                                        <input type="radio" id="star3" name="rating" value="3" />
                                        <label for="star3">3 stars</label>
                                        <input type="radio" id="star2" name="rating" value="2" />
                                        <label for="star2">2 stars</label>
                                        <input type="radio" id="star1" name="rating" value="1" />
                                        <label for="star1">1 star</label>
                                    </div>
                                    <textarea name="review" style="width:200%; margin-left: -15px; margin-top: -18px;" class="form-control mb-3" id="review" rows="4" cols="50" placeholder="Enter a review..."></textarea>
                                </form>
                                </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php
    include "footer.php";
?>

<script>
$("#prescription-form").validate({
    rules: {
        "add_fname": {
            required: true,
        },
    },
    messages: {
        "add_fname": {
            required: "Please enter First Name",
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
        
        var appointment_id = $("#appointment_id").val();
        var prescription = $("#prescription").val();
        $.ajax({
            type: "POST",
            url: "action/prescription_add.php",
            dataType: "json",
            data: {appointment_id:appointment_id,prescription:prescription},                
            success : function(data){
                if (data){
                    toastr.success("Prescription Added", "", {
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
                     window.location.href = "appointment_detail.php?appointment_id="+appointment_id;
                    }, 1000);
                
                } else {
                    toastr.error("Prescription Not Added", "", {
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
                        window.location.href = "appointment_detail.php?appointment_id="+appointment_id;
                    }, 1000);
                }
            }
        });
    } 
});

$(document).ready(function(){
var appointment_id=$("#appointment_id").val();
$.ajax({
    type: "GET",
    url: "action/rating_fetch_by_id.php",
    dataType: "json",
    data: {appointment_id:appointment_id},
    success : function(data){
        if (data){
            $('#rating_id').val(data.rating_id);
            $('#review').val(data.review);
            $('#rating').val(data.rating);
            {
                if(data.rating === "5")
                {
                    $('#star5').prop('checked',true);
                }
                else if(data.rating === "4")
                {
                    $('#star4').prop('checked',true);
                }
                else if(data.rating === "3")
                {
                    $('#star3').prop('checked',true);
                }
                else if(data.rating === "2")
                {
                    $('#star2').prop('checked',true);
                }
                else if(data.rating === "1")
                {
                    $('#star1').prop('checked',true);
                }
            }
        } else {    
            swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
        }
    }
});
});

$(document).ready(function(){
    var appointment_id=$("#appointment_id").val();
    $.ajax({
        type: "GET",
        url: "action/prescription_fetch_by_id.php",
        dataType: "json",
        data: {appointment_id:appointment_id},
        success : function(data){
            if (data){
                $('#prescription').val(data.prescription);                
            } else {
                swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
            }
        }
    });
});
</script>