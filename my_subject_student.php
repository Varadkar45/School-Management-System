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
                                <h1 class="m-0 text-dark">Subject</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Subject</li>
                                    <li class="breadcrumb-item active">My Subject</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- My Subject Table-->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row" id="table1">
                            <div class="col-7">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">My Subject</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="dTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Subject</th>
                                                    <th>Teacher</th>
                                                    <th>Fee($)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                
                                                $student_id = $_SESSION['id'];
                                                $current_year = date('Y');

                                                $sql = "SELECT subject_routing.fee as sr_fee, subject.name as s_name,teacher.name as t_name 
                                                        FROM student_subject 
                                                        INNER JOIN subject_routing
                                                        ON student_subject.sr_id=subject_routing.id
                                                        INNER JOIN subject
                                                        ON subject_routing.subject_id=subject.id
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
                                                            <td><?php echo $row['s_name']; ?></td>
                                                            <td><?php echo $row['t_name']; ?></td>
                                                            <td><?php echo $row['sr_fee']; ?></td>
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
    
            </div>
            <!-- /.content-wrapper -->

            <?php include_once './admin/layouts/footer.php'; ?>
            
        </div>
        <!-- ./wrapper -->

        <?php include_once './admin/layouts/import_js.php'; ?>
        
    </body>

</html>