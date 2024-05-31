<?php
   include "action/databaseconn.php";
   include "header.php";
?>

<?php
   $sql = "select * from report where appointment_id = '".$_GET['appointment_id']."'";
   $result = $conn->query($sql);
   $arr_appointment = [];
?>

<div class="container-fluid chatbox chat">
    <?php 
    if($result->num_rows > 0)
        {
            $arr_appointment = $result->fetch_all(MYSQLI_ASSOC);
        }
    ?>
    <div>
        <?php if(!empty($arr_appointment)) { ?>
            <?php foreach($arr_appointment as $r) { ?>
                <?php if ($r['is_patient_share'] == '1') 
                {?>
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                        <?php
                        $sql1 = "select * from user where id = '".$r['patient_id']."'";
                        $result1 = $conn->query($sql1);
                        $arr_user = [];
                        ?>
                        <?php 
                        if($result1->num_rows > 0)
                            {
                                $arr_user = $result1->fetch_all(MYSQLI_ASSOC);
                            }
                        ?>
                        <?php if(!empty($arr_user)) { ?>
                        <?php foreach($arr_user as $r1) { ?>
                            <img src=<?php echo "image/".$r1['profile_photo'] ?> class="rounded-circle user_img_msg" alt=""/>
                        <?php }} ?>
                        </div>
                        <div class="msg_cotainer" style="padding: 7px 7px;">
                        <?php
                            $str = $r['file'];
                            $newstring = substr($str, -4);
                            if($newstring == ".pdf")
                            {
                                ?>
                                <a target="_blank" href="<?php echo "report/".$r['file'] ?>"><img src="icons/3143500.png" style="width: 45px; height: 45px;" alt=""><br></a>
                                <?php
                                echo $r['file'];
                            }
                            else {
                                ?>
                                    <a target="_blank" href="<?php echo "report/".$r['file'] ?>"><img class="rounded" width="130" src=<?php echo "report/".$r['file'] ?>></a>
                                <?php
                            }
                        ?>
                        <br><?php echo $r['report_description'] ?>
                        </div>
                    </div>
                <?php 
                }
                else 
                {?>
                <div class="d-flex justify-content-end mb-4">
                    <div class="msg_cotainer_send">
                    <?php
                        $str = $r['file'];
                        $newstring = substr($str, -4);
                        if($newstring == ".pdf")
                        {
                            ?>
                            <a target="_blank" href="<?php echo "report/".$r['file'] ?>"><img src="icons/3143500.png" style="width: 45px; height: 45px;" alt=""><br></a>
                                <?php
                                echo $r['file'];
                        }
                        else {
                            ?>
                                <a target="_blank" href="<?php echo "report/".$r['file'] ?>"><img class="rounded" width="130" src=<?php echo "report/".$r['file'] ?>></a>
                                <?php
                        }
                    ?>
                    <br><?php echo $r['report_description'] ?>
                    </div>
                    <div class="img_cont_msg">
                        <?php
                        $sql1 = "select * from user where id = '".$_SESSION['id']."'";
                        $result1 = $conn->query($sql1);
                        $arr_user = [];
                        ?>
                        <?php 
                        if($result1->num_rows > 0)
                            {
                                $arr_user = $result1->fetch_all(MYSQLI_ASSOC);
                            }
                        ?>
                        <?php if(!empty($arr_user)) { ?>
                        <?php foreach($arr_user as $r1) { ?>
                            <img src=<?php echo "image/".$r1['profile_photo'] ?> class="rounded-circle user_img_msg" alt=""/>
                        <?php }} ?>
                    </div>
                </div>
            <?php } ?>
            <?php }}
            else { ?>
        <div class="container h-100">
            <div style="margin-left:31%;" class="row h-100 align-items-center">
                <div class="col-md-5">
                    <div class="form-input-content text-center error-page">
                        <h3 style="margin-top: 41px;"><i class="fa fa-exclamation-triangle text-warning"></i> No Data found!</h3>
						<div>
                            <a class="btn btn-primary" href="doctor_appointment.php">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<div class="modal fade" id="addModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="report-form" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Add Report Detalis</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <?php
                    $sql = "select * from appointment where appointment_id = '".$_GET['appointment_id']."'";
                    $result = $conn->query($sql);
                    $arr_appointment = [];
                ?>
                <?php 
                if($result->num_rows > 0)
                    {
                        $arr_appointment = $result->fetch_all(MYSQLI_ASSOC);
                    }
                ?>
                <?php if(!empty($arr_appointment)) { ?>
                <?php foreach($arr_appointment as $r) { ?>
                    <input type="hidden" name="doc_id" id="doc_id" value="<?php echo $_SESSION['id'] ?>">
                    <input type="hidden" name="appointment_id" id="appointment_id" value="<?php echo $r['appointment_id'] ?>">
                    <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $r['patient_id'] ?>">
                <?php }} ?>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="val-file">Attach File
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group col-lg-6" style="flex: 0 0 65%; max-width: 65%;">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" onchange="loadFile1(event)" id="file" name="file">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="input-group col-lg-6">
                            <img id="output" style="margin-top: 15px;" width="130" class="rounded"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="val-report_description">Report Description
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <textarea style="width:132%;" class="form-control" id="report_description" name="report_description" rows="4" cols="50" placeholder="Enter report description..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="btn-icon-left text-primary">
                            <i class="fa fa-upload color-primary"></i>
                        </span>Upload
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
   include "footer.php";
?>


<script>
var table = $('#example3').DataTable({order:[[2,"asc"]]});

var loadFile1 = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
};

$("#report-form").validate({
    rules: {
        "file": {
            required: true,
        },
    },
    messages: {
        "file": {
            required: "Please choose file.",
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
        var patient_id = $("#patient_id").val();
        var appointment_id = $("#appointment_id").val();
        var report_description = $("#report_description").val();

$("#report-form").on('submit',(function(e) {
    e.preventDefault();
    var appointment_id = $("#appointment_id").val();
    $.ajax({
        url: "action/doctor_report_upload.php",
        type: "POST",
        data:   new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(data)
        {
            if(data)
            {
            $('#addModal').hide();
                toastr.success("Report Added", "", {
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
                window.location.href = "doctor_report.php?appointment_id="+appointment_id;
                }, 1000);
            }
            else
            {
            $('#addModal').hide();
                toastr.error("Report Not Added", "", {
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
                    window.location.href = "doctor_report.php?appointment_id="+appointment_id;
                }, 1000);
            }
        }        
    });
})
)
} 
});
</script>