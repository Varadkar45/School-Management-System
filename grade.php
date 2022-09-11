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
                                <h1 class="m-0 text-dark">Grade</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Grade</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Add Grade Form -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Add Grade</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form role="form" action="index.php" method="POST" autocomplete="off">
                                        <div class="card-body">
                                            <div class="form-group has-error" id="divName">
                                                <label for="name">Grade</label>
                                                <input type="text" class="form-control" placeholder="Enter grade" name="name" id="name">
                                            </div>
                                            <div class="form-group" id="divAdmissionFee">
                                                <label for="admission_fee">Admission Fee($)</label>
                                                <input type="text" class="form-control" placeholder="Enter admission fee" name="admision_fee" id="admission_fee">
                                            </div>
                                            <div class="form-group" id="divInstituteFee">
                                                <label for="hall_charge">Institute Fee(%)</label>
                                                <input type="text" class="form-control" placeholder="Enter institute fee" name="institute_fee" id="institute_fee">
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <input type="hidden" name="do" value="add_grade">
                                            <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </div>
                </section>

                <!-- All Grade Table -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row" id="table1">
                            <div class="col-8">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">All Grade</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Grade</th>
                                                    <th>Admission Fee</th>
                                                    <th>Institute Fee(%)</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                               
                                                $sql = "SELECT * FROM grade";
                                                $result = mysqli_query($conn, $sql);
                                                $count = 0;
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $count++;

                                                ?>
                                                        <tr>
                                                            <td><?php echo $count; ?></td>
                                                            <td id="td1_<?php echo $row['id']; ?>"><?php echo $row['name']; ?></td>
                                                            <td id="td2_<?php echo $row['id']; ?>"><?php echo $row['admission_fee']; ?></td>
                                                            <td id="td3_<?php echo $row['id']; ?>"><?php echo $row['institute_fee']; ?></td>
                                                            <td>
                                                                <a href="#modalUpdateForm" onClick="updateRecord(this);" class="btn btn-primary btn-xs " data-id="<?php echo $row['id']; ?>" data-toggle="modal">Edit</a>
                                                                <a href="#" onClick="deleteRecord(this);" class="btn btn-danger btn-xs " data-id="<?php echo $row['id']; ?>" data-toggle="modal">Delete</a>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- Edit Grade - Modal-->
                <div class="modal fade" id="modalUpdateForm" tabindex="-1" role="dialog">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title">Edit Grade</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group has-error" id="divNameUpdate">
                                    <label for="name1">Grade</label>
                                    <input type="text" class="form-control" placeholder="Enter grade" id="name1">
                                </div>
                                <div class="form-group" id="divAFeeUpdate">
                                    <label for="admission_fee1">Admission Fee($)</label>
                                    <input type="text" class="form-control" placeholder="Enter admission fee" id="admission_fee1">
                                </div>
                                <div class="form-group" id="divIFeeUpdate">
                                    <label for="hall_charge1">Institute Fee(%)</label>
                                    <input type="text" class="form-control" placeholder="Enter institute fee" id="institute_fee1">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="id1">
                                <button type="button" class="btn bg-primary" id="btnUpdate" style="width:100%;" onClick="updateRecord1();">Update</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Record Modal-->
                <?php include_once 'delete_record_modal.php'; ?>

            </div>
            <!-- /.content-wrapper -->

            <?php include_once './admin/layouts/footer.php'; ?>
            
        </div>
        <!-- ./wrapper -->

        <?php include_once './admin/layouts/import_js.php'; ?>

        <!-- This Page JS File-->
        <script src="./js/grade.js"></script>

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
    
                    toastr["warning"]("This grade already has in our Database.", "Warning!");
    
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
    
                    toastr["success"]("Your information has been successfully inserted in our database.", "Success!");
    
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
    
                    toastr["info"]("Check your internet connection and try again.", "Something is wrong!");
    
                });
                
                </script>
            ';
            }
        }
        ?>
        
    </body>

</html>