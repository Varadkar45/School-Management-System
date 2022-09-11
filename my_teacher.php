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
            <?php include_once './admin/layouts/sidebar_student.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">My Teacher</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Teacher</li>
                                    <li class="breadcrumb-item active">My Teacher</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- My Teacher Table -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row" id="table1">
                            <div class="col-6">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">My Teacher</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Teacher</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                
                                                $student_id = $_SESSION['id'];
                                                $current_year = date('Y');

                                                $sql = "SELECT teacher.id as t_id, teacher.name as t_name
                                                        FROM student_subject
                                                        INNER JOIN subject_routing
                                                        ON student_subject.sr_id=subject_routing.id
                                                        INNER JOIN teacher
                                                        ON subject_routing.teacher_id=teacher.id 
                                                        WHERE student_subject.student_id='$student_id' AND student_subject.year='$current_year'";

                                                $result = mysqli_query($conn, $sql);
                                                $count = 0;

                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $count++;

                                                ?>
                                                        <tr>
                                                            <td><?php echo $count; ?></td>
                                                            <td><?php echo $row['t_name']; ?></td>
                                                            <td>
                                                                <a href="#teacherDetails" data-toggle="modal" onClick="teacherDetails(this);" class="btn btn-success btn-xs " data-id="<?php echo $row['t_id']; ?>">View Profile</a>
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

                <!-- Teacher Details - Modal -->
                <div class="modal fade" id="teacherDetails" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-green">
                                <h5 class="modal-title" id="tName"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img id="tImage" class="img-circle" style="width: 120px; height: 120px;">	
                                    </div>
                                    <div class="col-sm-9">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Index Number</td>
                                                    <td id="tIndex"></td>
                                                </tr>
                                                <tr>
                                                    <td>Name</td>
                                                    <td id="tName1"></td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td id="tAddress"></td>
                                                </tr>
                                                <tr>
                                                    <td>Gender</td>
                                                    <td id="tGender"></td>
                                                </tr>
                                                <tr>
                                                    <td>Phone</td>
                                                    <td id="tPhone"></td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td id="tEmail"></td>
                                                </tr>
                                                <tr>
                                                    <td>Register Date</td>
                                                    <td id="tRegDate"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
        <script src="./js/my_teacher.js"></script>
        
    </body>

</html>