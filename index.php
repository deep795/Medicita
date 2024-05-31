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
										<a href="index.php"><img src="images/logo-full.png" style="width: 57%;" alt="" ></a>
									</div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form id="login-form" autocomplete="on" method="POST">
                                    <div class="form-group">
                                            <label class="text-label"><strong>Email</strong></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                                </div>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-label"><strong>Password</strong></label>
                                            <div class="input-group transparent-append">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                                </div>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                                
                                            </div>
                                        </div>                              
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                               
                                            </div>
                                            <div class="form-group">
                                                <a href="forgot_password.php">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" id="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="register.php">Sign up</a></p>
                                    </div>
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
        },
        "password": {
            required: !0,
            minlength: 5
        }
    },
    messages: {
        "email": {
            required: "Please enter a email",
            email: "Please enter valid email"
        },
        "password": {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
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
            var password = $("#password").val();
            
            $.ajax({
                type: "POST",
                url: "action/login_process.php",
                dataType: "json",
                data: {email:email, password:password},
                success : function(data){
                    if (data == 1){
                        swal("Good job!", "Login successfully", "success");
                        setTimeout(function(){ 
                            window.location.href = "doctor_dashboard.php";
                        }, 2000);
                    
                    } else if (data == 2){
                        swal("Good job!", "Login successfully", "success");
                        setTimeout(function(){ 
                            window.location.href = "patient_dashboard.php";
                        }, 2000);
                    }
                    else if (data == 3){
                        swal("Good job!", "Login successfully", "success");
                        setTimeout(function(){ 
                            window.location.href = "dashboard.php";
                        }, 2000);
                    }
                    else if (data == 4){
                        swal("Good job!", "Login successfully", "success");
                        setTimeout(function(){ 
                            window.location.href = "assistant_dashboard.php";
                        }, 2000);
                    }
                    else
                    {
                        swal("Bad Luck!", "Please enter valid email and password", "error");
                        setTimeout(function(){ 
                            window.location.href = "index.php";
                        }, 2000);
                    }
                }
            });
            return false;
        } 
    });
});
</script>
</html>