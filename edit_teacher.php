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
            <?php include_once './admin/layouts/sidebar.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Edit Teacher</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Teacher</li>
                                    <li class="breadcrumb-item active">All Teacher</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Edit Teacher Form -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- Horizontal Form -->
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit Teacher</h3>
                                    </div>
                                    <!-- /.card-header -->

                                    <?php
                                    
                                    $id = $_GET["id"];

                                    $sql = "SELECT * FROM teacher WHERE id='$id'";
                                    $result = mysqli_query($conn,$sql);
                                    $row = mysqli_fetch_assoc($result);

                                    ?>
                                    <!-- form start -->
                                    <form action="index.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        <div class="card-body">
                                            <div class="form-group row " >
                                                <label for="index_number" class="col-sm-2 col-form-label ">Index</label>
                                                <div class="col-sm-10" id="divIndexNumber">
                                                    <input type="text" class="form-control "  placeholder="Enter index number" id="index_number" name="index_number" value="<?php echo $row["index_number"];?>">
                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="form-group row" >
                                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10" id="divName">
                                                    <input type="text" class="form-control" placeholder="Enter teacher name" id="name" name="name" value="<?php echo $row["name"];?>">
                                                
                                                </div>
                                            </div>
                                            <div class="form-group row" >
                                                <label for="address" class="col-sm-2 col-form-label">Address</label>
                                                <div class="col-sm-10" id="divAddress">
                                                    <input type="text" class="form-control" placeholder="Enter address" id="address" name="address" value="<?php echo $row["address"];?>">
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group row" >
                                                <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                                <div class="col-sm-4" id="divGender">
                                                    <select class="form-control" id="gender" name="gender">
                                                        <option value="Male"<?=$row['gender'] == 'Male' ? ' selected="selected"' : '';?>>Male</option>
                                                        <option value="Female"<?=$row['gender'] == 'Female' ? ' selected="selected"' : '';?>>Female</option>
                                                    </select>
                                                
                                                </div>
                                            </div>
                                            <div class="form-group row" >
                                                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                                <div class="col-sm-7" id="divPhone">
                                                    <input type="text" class="form-control " placeholder="Enter phone number" id="phone" name="phone" value="<?php echo $row["phone"];?>">
                                                </div>
                                            </div>
                                            <div class="form-group row" >
                                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-7" id="divEmail">
                                                    <input type="text" class="form-control" placeholder="Enter email address" id="email" name="email" value="<?php echo $row["email"];?>">
                                                </div>
                                            </div>
                                            <div class="form-group row" >
                                                <label for="image" class="col-sm-2 col-form-label">Photo</label>
                                                <div class="col-sm-10" id="divImage">
                                                    <img  id="profile_pic" src="./<?php echo $row["image"] ?>" style="width: 130px; height: 150px; margin-bottom:5px;"/>
                                                    <input type="file" class="form-control-file" id="image" name="image">
                                                
                                                </div>
                                            
                                            </div>
                                            
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <input type="hidden" name="do" value="update_teacher">
                                            <input type="hidden" name="user" value="Admin">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            
                                        </div>
                                        <!-- /.card-footer -->
                                    </form>
                                </div>
                                <!-- /.card -->

                            </div>
                        </div>
                    </div>
                </section>

            </div>
            <!-- /.content-wrapper -->

            <?php include_once './admin/layouts/footer.php'; ?>
            
        </div>
        <!-- ./wrapper -->

        <?php include_once './admin/layouts/import_js.php'; ?>

        <script src="./js/all_teacher.js"></script>

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
    
                    toastr["warning"]("This index number is already have in our Database.", "Warning!");
    
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
    
                    toastr["warning"]("This index number and email address are already have in our Database.", "Warning!");
    
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
    
                    toastr["warning"]("This index number is already have in our Database.", "Warning!");
    
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
        
    </body>

</html>