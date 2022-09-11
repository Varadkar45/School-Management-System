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
                                <h1 class="m-0 text-dark">Dashboard</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">

                        <?php

                        $teacher_id = $_SESSION['id'];
                        $current_year = date('Y');

                        $my_student = 0;
                        $all_student = 0;
                        $monthly_salary = 0;
                        $total_earning = 0;

                        //MY Student
                        $sql = "SELECT * FROM subject_routing WHERE teacher_id='$teacher_id '";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {

                            $sr_id = $row['id'];

                            $sql1 = "SELECT count(id) FROM student_subject WHERE sr_id='$sr_id' AND year='$current_year'";
                            $result1 = mysqli_query($conn, $sql1);
                            $row1 = mysqli_fetch_assoc($result1);
                            $my_student += $row1['count(id)'];

                        }

                        //All Student 
                        $sql2 = "SELECT count(id) FROM student";
                        $result2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);
                        $all_student = $row2['count(id)'];

                        //Monthly Salary
                        $sql3 = "SELECT subject_routing.id as sr_id, subject_routing.fee as sr_fee, grade.name as g_name, subject.name as s_name, grade.institute_fee as g_i_fee 
                                FROM subject_routing
                                INNER JOIN grade
                                ON subject_routing.grade_id=grade.id
                                INNER JOIN subject
                                ON subject_routing.subject_id=subject.id
                                WHERE subject_routing.teacher_id='$teacher_id'";

                        $result3 = mysqli_query($conn, $sql3);

                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                
                                $sr_id = $row3['sr_id'];
                                $institute_fee = $row3['g_i_fee'];
                                $subject_fee = $row3['sr_fee'];

                                $sql4 = "SELECT COUNT(student_id) FROM student_subject WHERE sr_id='$sr_id' AND year='$current_year'";
                                $result4 = mysqli_query($conn, $sql4);
                                $row4 = mysqli_fetch_assoc($result4);

                                $student_count = $row4['COUNT(student_id)'];

                                $net_total_amount = $subject_fee * $student_count;

                                $sub_total = $net_total_amount - ($net_total_amount * $institute_fee / 100);

                                $monthly_salary += $sub_total;

                                $monthly_salary = number_format($monthly_salary, 2, '.', '');
                            }
                        }
                        //Total Earning
                        $sql5="SELECT SUM(paid) FROM teacher_salary WHERE teacher_id='$teacher_id'";
                        $result5=mysqli_query($conn,$sql5);
                        $row5=mysqli_fetch_assoc($result5);
                        $total_earning = $row5['SUM(paid)'];

                        //Teacher Name
                        $sql6="SELECT * FROM teacher WHERE id='$teacher_id'";
                        $result6=mysqli_query($conn,$sql6);
                        $row6=mysqli_fetch_assoc($result6);
                        $name = $row6['name'];
                                    
                        ?>
                        
                        <!-- Info boxes -->
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box">
                                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-graduate"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">My Student</span>
                                        <span class="info-box-number"><?php echo $my_student; ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">All Student</span>
                                        <span class="info-box-number"><?php echo $all_student; ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->

                            <!-- fix for small devices only -->
                            <div class="clearfix hidden-md-up"></div>

                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check-alt"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Monthly Salary</span>
                                        <span class="info-box-number">$<?php echo $monthly_salary; ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-dollar-sign"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Total EARNING</span>
                                        <span class="info-box-number">$<?php echo $total_earning; ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <h6><?php echo $name; ?>,<strong style="color:#cf4ed4;"> Welcome back!</strong></h6>
                        <br>
                    
                        <div class="row">
                            <div class="col-md-10">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Monthly Salary</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart">

                                            <canvas id="myChart1" width="800" height="438"></canvas>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Monthly Student Registration</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart">

                                            <canvas id="myChart2" width="800" height="438"></canvas>

                                        </div>
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

        <!-- This Page JS File-->
        <script src="./js/dashboard_teacher.js"></script>

        <?php

        $current_year=date("Y");

        $prefix="";
        $prefix1="";

        $monthly_salary1="";
        $monthly_std_reg="";

        $month=array("January","February","March","April","May","June","July","August","September","October","November","December");

        for($i=0; $i<count($month); $i++){
            
            $sql="SELECT SUM(paid) FROM teacher_salary WHERE teacher_id='$teacher_id' AND year='$current_year' AND month='$month[$i]'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $monthly_salary1.=$prefix.'"'.$row['SUM(paid)'].'"';
            $prefix=',';
            
        }

        echo "<script>monthlySalary('$monthly_salary1');</script>";

        for($i=0; $i<count($month); $i++){
            
            $sql1="SELECT COUNT(id) FROM student WHERE reg_year='$current_year' AND reg_month='$month[$i]'";
            $result1=mysqli_query($conn,$sql1);
            $row1=mysqli_fetch_assoc($result1);
            $monthly_std_reg.=$prefix1.'"'.$row1['COUNT(id)'].'"';
            $prefix1=',';
            
        }

        echo "<script>monthlyStudentRegistration('$monthly_std_reg');</script>";

        ?>
        
    </body>

</html>