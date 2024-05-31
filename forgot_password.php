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
                                        <label class="text-label"><strong>Email</strong></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                            </div>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                        </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" id="submit" class="btn btn-primary btn-block">Reset</button>
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
        "email": {
            required: !0,
            email: 3
        }
    },
    messages: {
        "email": {
            required: "Please enter a email",
            email: "Please enter valid email"
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
           
            var email = $("#email").val();
           
            
            $.ajax({
                type: "POST",
                url: "action/forgot_process.php",
                dataType: "json",
                data: {email:email},
                success : function(data){
                    if (data){
                        swal("Good job!", "Email Verification", "success");
                        setTimeout(function(){ 
                            window.location.href = "otp.php";
                        }, 900);
                    
                    } else {
                        swal("Bad Luck!", "Something went Wrong", "error");
                    }
                }
            });
            return false;
        }
    
});
});
</script>
</html>