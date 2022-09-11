<?php session_start(); ?>
<?php include_once './config/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once './admin/layouts/header.php'; ?>

<body class="hold-transition login-page login-body">
    <div class="login-box">

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">

                <div class="login-logo">
                    <h2 class="logo-text">INGENIOUS</h2>
                </div>

                <p class="login-box-msg">Sign in to start your session</p>

				<!-- login Form -->
                <form action="index.php" method="post" id="form2">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email1">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password1">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <input type="hidden" name="do" value="user_login">
                            <button type="submit" class="btn btn-primary btn-block signin-btn" id="btnSubmit1">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
				<!-- /.login Form -->
                <?php

                $sql = "SELECT * FROM admin";
                $result = mysqli_query($conn, $sql);
				
                if (mysqli_num_rows($result) == 0) {

                ?>
                    <p class="mb-0 pCreatAdmin">
                        <center><a href="#modalSignup" data-toggle="modal" class="text-center">Create admin account</a></center>
                    </p>

                <?php } ?>
            </div>
            <!-- /.login-card-body -->
        </div>

    </div>
    <!-- /.login-box -->

	<!-- Create Admin Account -->
    <div class="modal fade" id="modalSignup" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Create Admin Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="index.php" method="POST" enctype="multipart/form-data" id="form1" autocomplete="off">
                    <div class="modal-body">
                        <div class="form-group row ">
                            <label for="index_number" class="col-sm-2 col-form-label ">Index</label>
                            <div class="col-sm-10" id="divIndexNumber">
                                <input type="text" class="form-control " placeholder="Enter index number" id="index_number" name="index_number">

                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10" id="divName">
                                <input type="text" class="form-control" placeholder="Enter admin name" id="name" name="name">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10" id="divAddress">
                                <input type="text" class="form-control" placeholder="Enter address" id="address" name="address">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-4" id="divGender">
                                <select class="form-control" id="gender" name="gender">
                                    <option>Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-7" id="divPhone">
                                <input type="text" class="form-control " placeholder="Enter phone number" id="phone" name="phone">
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label for="image" class="col-sm-2 col-form-label">Photo</label>
                            <div class="col-sm-10" id="divImage">
                                <img id="profile_pic" style="width: 130px; height: 150px; margin-bottom:5px;" />
                                <input type="file" class="form-control-file" id="image" name="image">

                            </div>
                        </div>
                        <p class="alert-primary">Login Details</p>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-7" id="divEmail">
                                <input type="text" class="form-control" placeholder="Enter email address" id="email" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-7" id="divPassword">
                                <input type="password" class="form-control" placeholder="Enter password" id="password" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="do" value="add_admin">
                        <button type="submit" class="btn bg-primary" id="btnSubmit" style="width:100%;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

	<?php include_once './admin/layouts/import_js.php'; ?>

	<!-- This page js file -->
	<script src="./js/login.js"></script>
 
	 <!--  Alerts - Toastr -->
    <?php
	if (isset($_GET["do"]) && ($_GET["do"] == "alert_from_insert")) {

		$msg = $_GET['msg'];

		if ($msg == 1) {

			echo '
			<script>
			
			$(function() {
				toastr.options = {
				  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": false,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "5000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "show",
				  "hideMethod": "fadeOut"
				}
  
				toastr["warning"]("This index number already has in our Database.", "Warning!");
  
			  });
			
			</script>
		';
        }
        
        if ($msg == 2) {

			echo '
			<script>
			
			$(function() {
				toastr.options = {
				  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": false,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "5000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "show",
				  "hideMethod": "fadeOut"
				}
  
				toastr["warning"]("This index number and email address already have in our Database.", "Warning!");
  
			  });
			
			</script>
		';
        }
        
        if ($msg == 3) {

			echo '
			<script>
			
			$(function() {
				toastr.options = {
				  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": false,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "5000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "show",
				  "hideMethod": "fadeOut"
				}
  
				toastr["warning"]("This index number already has in our Database.", "Warning!");
  
			  });
			
			</script>
		';
        }

		if ($msg == 4) {

			echo '
			<script>
			
			$(function() {
				toastr.options = {
				  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": false,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "5000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "show",
				  "hideMethod": "fadeOut"
				}
  
				toastr["success"]("Your information has been successfully inserted in our database.", "Success!");
  
			  });
			
			</script>
		';
		}

		if ($msg == 5) {
			echo '
			<script>
			
			$(function() {
				toastr.options = {
				  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": false,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "5000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "show",
				  "hideMethod": "fadeOut"
				}
  
				toastr["info"]("Check your internet connection and try again.", "Something is wrong!");
  
			  });
			
			</script>
		';
        }
        
        if ($msg == 6) {
			echo '
			<script>
			
			$(function() {
				toastr.options = {
				  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": false,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "5000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "show",
				  "hideMethod": "fadeOut"
				}
  
				toastr["error"]("Sorry, there was an error uploading your file.", "Something is wrong!");
  
			  });
			
			</script>
		';
		}
	}
	?>
     
	<!--  Alerts - Toastr - login Error -->
    <?php
	if (isset($_GET["do"]) && ($_GET["do"] == "login_error")) {

		$msg = $_GET['msg'];

		if ($msg == 1) {

			echo '
			<script>
			
			$(function() {
				toastr.options = {
				  "closeButton": false,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": false,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": false,
				  "onclick": null,
				  "showDuration": "300",
				  "hideDuration": "1000",
				  "timeOut": "5000",
				  "extendedTimeOut": "1000",
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "show",
				  "hideMethod": "fadeOut"
				}
  
				toastr["error"]("Username or Password is Incorrect.", "Something is wrong!");
  
			  });
			
			</script>
		';
        }
        
     
	}
	?>

</body>

</html>