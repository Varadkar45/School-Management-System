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
                                <h1 class="m-0 text-dark">Subject Routing</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Subject Routing</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Subject Routing Table -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row" id="table1">
                            <div class="col-10">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">

                                        <h3 class="card-title">Subject Routing</h3>
                                        <a href="#modalInsertForm" class="btn btn-success btn-sm float-right" data-toggle="modal">Add <i class="fas fa-plus"></i></a>

                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Grade</th>
                                                    <th>Subject</th>
                                                    <th>Teacher</th>
                                                    <th>Fee($)</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                               
                                                $sql = "SELECT subject_routing.id as sr_id, subject_routing.fee as sr_fee, grade.name as g_name, subject.name as s_name, teacher.name as t_name 
                                                        FROM subject_routing
                                                        INNER JOIN grade
                                                        ON subject_routing.grade_id=grade.id
                                                        INNER JOIN subject
                                                        ON subject_routing.subject_id=subject.id
                                                        INNER JOIN teacher
                                                        ON subject_routing.teacher_id=teacher.id";
                                                
                                                $result = mysqli_query($conn, $sql);
                                                $count = 0;
                                                
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $count++;

                                                ?>
                                                        <tr>
                                                            <td><?php echo $count; ?></td>
                                                            <td id="td1_<?php echo $row['sr_id']; ?>"><?php echo $row['g_name']; ?></td>
                                                            <td id="td2_<?php echo $row['sr_id']; ?>"><?php echo $row['s_name']; ?></td>
                                                            <td id="td3_<?php echo $row['sr_id']; ?>"><?php echo $row['t_name']; ?></td>
                                                            <td id="td4_<?php echo $row['sr_id']; ?>"><?php echo $row['sr_fee']; ?></td>
                                                            <td>
                                                                <a href="#modalUpdateForm" onClick="updateRecord(this);" class="btn btn-primary btn-xs " data-id="<?php echo $row['sr_id']; ?>" data-toggle="modal">Edit</a>
                                                                <a href="#" onClick="deleteRecord(this);" class="btn btn-danger btn-xs " data-id="<?php echo $row['sr_id']; ?>" data-toggle="modal">Delete</a>
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

                 <!-- Add Subject Routing Modal-->
                <div class="modal fade" id="modalInsertForm" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title">Add Subject Routing</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="index.php" method="POST" autocomplete="off">
                                <div class="modal-body">
                                    <div class="form-group" >
                                        <label for="grade_id">Grade</label>
                                        <select name="grade_id" id="grade_id" class="form-control">
                                            <option value="">Select Grade</option>
                                        <?php 
                                        
                                        $sql="SELECT * FROM grade";
                                        $result=mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row=mysqli_fetch_assoc($result)){
                                        
                                        ?>

                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>

                                        <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <label for="subject_id">Subject</label>
                                        <select name="subject_id" id="subject_id" class="form-control">
                                            <option value="">Select Subject</option>
                                        <?php 
                                        
                                        $sql="SELECT * FROM subject";
                                        $result=mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row=mysqli_fetch_assoc($result)){
                                        
                                        ?>

                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>

                                        <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <label for="grade_id">Teacher</label>
                                        <select name="teacher_id" id="teacher_id" class="form-control">
                                            <option value="">Select Teacher</option>
                                        <?php 
                                        
                                        $sql="SELECT * FROM teacher";
                                        $result=mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row=mysqli_fetch_assoc($result)){
                                        
                                        ?>

                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>

                                        <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="student_count1">Fee($)</label>
                                        <input type="text" class="form-control" placeholder="Enter subject fee" id="fee" name="fee">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="do" value="add_subject_routing">
                                    <button type="submit" class="btn bg-primary" id="btnSubmit" style="width:100%;">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                 <!-- Update Subject Routing Modal -->
                <div class="modal fade" id="modalUpdateForm" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title">Edit Subject Routing</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                    <div class="form-group" >
                                        <label for="grade_id1">Grade</label>
                                        <select id="grade_id1" class="form-control">
                                            
                                        <?php 

                                        $sql="SELECT * FROM grade";
                                        $result=mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row=mysqli_fetch_assoc($result)){
                                        
                                        ?>

                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>

                                        <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <label for="subject_id1">Subject</label>
                                        <select id="subject_id1" class="form-control">
                                            
                                        <?php 

                                        $sql="SELECT * FROM subject";
                                        $result=mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row=mysqli_fetch_assoc($result)){
                                        
                                        ?>

                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>

                                        <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <label for="teacher_id1">Teacher</label>
                                        <select id="teacher_id1" class="form-control">
                                            
                                        <?php 

                                        $sql="SELECT * FROM teacher";
                                        $result=mysqli_query($conn,$sql);
                                        if(mysqli_num_rows($result) > 0){
                                            while($row=mysqli_fetch_assoc($result)){
                                        
                                        ?>

                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>

                                        <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fee1">Fee($)</label>
                                        <input type="text" class="form-control" placeholder="Enter subject fee" id="fee1">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    
                                    <input type="hidden" id="id1">
                                    <button type="button" class="btn bg-primary" id="btnUpdate" onclick="updateRecord1();" style="width:100%;">Update</button>
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
        <script src="./js/subject_routing.js"></script>

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
    
                    toastr["warning"]("The record has been duplicated.", "Warning!");
    
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