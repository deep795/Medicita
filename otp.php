<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Medicita</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
	<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/deznav-init.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href=""><img src="images/logo-full.png" style="width: 57%;" alt="" ></a>
									</div>
                                    <h4 class="text-center mb-4">Forgot Password</h4>
                                    <form id="login-form" autocomplete="off" method="POST">
                                    <div class="form-group">
                                            <label class="text-label"><strong>Otp</strong></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                                </div>
                                                <input type="password" class="form-control" id="otp" name="otp" placeholder="otp">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-label"><strong>New Password</strong></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                                </div>
                                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-label"><strong>Confirm Password</strong></label>
                                            <div class="input-group transparent-append">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                                </div>
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                            </div>
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" id="submit" class="btn btn-primary btn-block">Sign Me In</button>
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
</body>
<script>
    
$(document).ready(function() {
$("#login-form").validate({
    rules: {
        "otp": {
            required: !0,
            minlength: 4
        },
        "new_password": {
            required: !0,
            minlength: 5
        },
        "confirm_password": {
            required: !0,
            equalTo: "#new_password"
        }
    },
    messages: {
        "otp": {
            required: "Please enter a otp",
            otp: "Please enter valid otp"
        },
        "new_password": {
            required: "Please provide a new password",
            minlength: "Your password must be at least 5 characters long"
        },
        "confirm_password": {
            required: "Please provide a confirm password",
            minlength: "Your password must be at least 5 characters long",
            equalTo: "Please enter the same password as above"
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
           
            var otp = $("#otp").val();
            var password = $("#new_password").val();
                $.ajax({
                type: "POST",
                url: "action/update_process.php",
                dataType: "json",
                data: {otp:otp, password:password},
                success : function(data){
                    if (data == "2"){
                        swal("Bad Luck", "Please enter valid OTP", "error");
                        setTimeout(function(){ 
                            window.location.href = "otp.php";
                        }, 1500);
                        
                    } else if (data == "1"){
                        swal("Good job!", "Password changed successfully", "success");
                        setTimeout(function(){ 
                            window.location.href = "index.php";
                        }, 1500);
                      
                    } else {
                        swal("Bad Luck!", "Something went wrong, Please try again later.", "error");
                    }
                }
            });
            return false;
        }
});
});
</script>
</html>