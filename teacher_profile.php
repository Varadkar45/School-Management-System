<?php
session_start();
include_once './config/config.php';

if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

    <?php include_once './admin/layouts/header.php'; ?>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <?php include_once './admin/layouts/top_nav.php'; ?>
            <?php include_once './admin/layouts/sidebar_teacher.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">My Profile</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">My Profile</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- User Details -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-7">
                                <!-- general form elements -->

                                <div class="card card-outline card-primary" id="my_profile">
                                    <div class="card-header">
                                        <h3 class="card-title">User Details</h3>
                                    </div>
                                    <!-- /.card-header -->

                                    <div class="card-body">
                                        <div class="row">
                                            <?php
  
                                            $teacher_id = $_SESSION["id"];

                                            $sql = "SELECT * FROM teacher WHERE id='$teacher_id'";
                                            $result = mysqli_query($conn, $sql);
                                            $row = mysqli_fetch_assoc($result);

                                            ?>
                                            <div class="col-md-3">
                                                <img style="width: 130px; height:130px;" src="<?php echo $row['image']; ?>" class="img-circle">
                                            </div>
                                            <div class="col-md-9">
                                                <table class="table table-bordered table-striped">
                                                    <tbody>

                                                        <tr>
                                                            <td style="width: 30%">Index</td>
                                                            <td><?php echo $row['index_number']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td><?php echo $row['name']; ?></td>
                                                        </tr>

                                                        <tr>
                                                            <td>Address</td>
                                                            <td><?php echo $row['address']; ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Gender</td>
                                                            <td><?php echo $row['gender']; ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td><?php echo $row['email']; ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone</td>
                                                            <td><?php echo $row['phone']; ?> </td>
                                                        </tr>

                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>
                                        <p class="alert-primary" id="note1">Note: We get the email address for the user name.</p>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer text-right">

                                        <a href="#" onClick="editMyProfile(this);" class="btn btn-sm btn-primary" data-id="<?php echo $teacher_id; ?>"><i class="fas fa-user-edit"></i></a>
                                    </div>

                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Login Details -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-5">
                                <!-- general form elements -->

                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Login Details</h3>
                                    </div>
                                    <!-- /.card-header -->

                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <tbody>

                                                <tr>
                                                    <td style="width: 30%">User Name</td>
                                                    <td><?php echo $row['email']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Password</td>
                                                    <td>******</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer text-right">
                                        <a href="#"  onClick="editPassword(this);" class="btn btn-sm btn-primary" data-id="<?php echo $row["email"]; ?>"><i class="fas fa-edit"></i></a>
                                    </div>

                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Edit Password - Modal -->
                <div class="modal fade" id="modalEditPassword" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title">Edit Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="current_password" class="col-sm-4 col-form-label ">Current Password</label>
                                    <div class="col-sm-8" >
                                        <input type="password" class="form-control " placeholder="Enter current password" id="current_password" >

                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="new_password" class="col-sm-4 col-form-label ">New Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control " placeholder="Enter new password" id="new_password" >

                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="confirm_password" class="col-sm-4 col-form-label ">Confirm Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control " placeholder="Enter confirm password" id="confirm_password" >

                                    </div>

                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="id1">
                                <button type="button" class="btn bg-primary" id="btnUpdate" style="width:100%;" onClick="updatePassword();">Update</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.content-wrapper -->

            <?php include_once './admin/layouts/footer.php'; ?>
            
        </div>
        <!-- ./wrapper -->

        <?php include_once './admin/layouts/import_js.php'; ?>

        <!-- This Page JS File-->
        <script src="./js/teacher_profile.js"></script>

        <!--  Alerts - Toastr -->
        <?php
        if (isset($_GET["do"]) && ($_GET["do"] == "alert_from_update")) {

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
    
                    toastr["success"]("Your information has been successfully updated in our database.", "Success!");
                    
                    
                
    
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

                    toastr["info"]("Check your internet connection and try again.", "Something is wrong!");
    
                    
    
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
    
                    toastr["error"]("Sorry, there was an error uploading your file.", "Something is wrong!");

                    
    
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
    
                    toastr["warning"]("This email address already has in our Database.", "Warning!");
    
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
    
                    toastr["warning"]("This index number already has in our Database.", "Warning!");
    
                });
                
                </script>
            ';
            }
            
        
        }
        ?>
        
    </body>

</html>