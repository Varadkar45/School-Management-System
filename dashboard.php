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

                        $total_student = 0;
                        $total_teacher = 0;
                        $monthly_income = 0;
                        $total_income = 0;

                        $current_year = date("Y");
                        $current_month = date("F");

                        $sql = "SELECT count(id) FROM student";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $total_student = $row['count(id)'];

                        $sql1 = "SELECT count(id) FROM teacher";
                        $result1 = mysqli_query($conn, $sql1);
                        $row1 = mysqli_fetch_assoc($result1);
                        $total_teacher = $row1['count(id)'];

                        $sql2 = "SELECT SUM(paid) FROM student_payment WHERE year='$current_year' AND month='$current_month'";
                        $result2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);
                        $monthly_income = $row2['SUM(paid)'];

                        $sql3 = "SELECT SUM(paid) FROM student_payment";
                        $result3 = mysqli_query($conn, $sql3);
                        $row3 = mysqli_fetch_assoc($result3);
                        $total_income = $row3['SUM(paid)'];

                        $admin_id = $_SESSION['id'];

                        $sql4 = "SELECT * FROM admin WHERE id='$admin_id'";
                        
                        $result4 = mysqli_query($conn, $sql4);
                        $row4 = mysqli_fetch_assoc($result4);
                        $name = $row4['name'];

                        ?>

                        <!-- Info boxes -->
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box">
                                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-graduate"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Student</span>
                                        <span class="info-box-number"><?php echo $total_student; ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-chalkboard-teacher"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Teacher</span>
                                        <span class="info-box-number"><?php echo $total_teacher; ?></span>
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
                                        <span class="info-box-text">Monthly Income</span>
                                        <span class="info-box-number">$<?php echo $monthly_income; ?></span>
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
                                        <span class="info-box-text">Total Income</span>
                                        <span class="info-box-number">$<?php echo $total_income; ?></span>
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
                                        <h5 class="card-title">Monthly Income</h5>
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
        <script src="./js/dashboard.js"></script>

        <?php

        $current_year=date("Y");

        $prefix="";
        $prefix1="";

        $monthly_income1="";
        $monthly_std_reg="";

        $month=array("January","February","March","April","May","June","July","August","September","October","November","December");

        for($i=0; $i<count($month); $i++){
            
            $sql="SELECT SUM(paid) FROM student_payment WHERE year='$current_year' AND month='$month[$i]'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $monthly_income1.=$prefix.'"'.$row['SUM(paid)'].'"';
            $prefix=',';
            
        }

        echo "<script>monthlyIncome('$monthly_income1');</script>";

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