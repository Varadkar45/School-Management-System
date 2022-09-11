<?php
include_once './config/config.php';
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: index.php');
    exit;
}
?>
<div class="modal fade" id="modalAddPayment" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">

                <?php

                $id = $_GET['id'];

                $sql = "SELECT * FROM student WHERE id='$id'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);


                ?>


                <h5 class="modal-title"><?php echo $row["name"]; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Monthly Fee For This Month</h3>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Grade</th>
                                    <th>Subject</th>
                                    <th>Teacher</th>
                                    <th>Subject Fee($)</th>
                                    <th>Total($)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $current_year = date('Y');

                                $sql = "SELECT subject_routing.fee as sr_fee, grade.name as g_name, subject.name as s_name, teacher.name as t_name 
                                        FROM student_subject 
                                        INNER JOIN subject_routing
                                        ON student_subject.sr_id=subject_routing.id
                                        INNER JOIN grade
                                        ON subject_routing.grade_id=grade.id
                                        INNER JOIN subject
                                        ON subject_routing.subject_id=subject.id
                                        INNER JOIN teacher
                                        ON subject_routing.teacher_id=teacher.id
                                        WHERE student_subject.student_id='$id' AND student_subject.year='$current_year'";


                                $result = mysqli_query($conn, $sql);
                                $count = 0;
                                $total = 0;
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $count++;

                                        $total += $row["sr_fee"];
                                        $total = number_format($total, 2, '.', '');

                                ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $row['g_name']; ?></td>
                                            <td><?php echo $row['s_name']; ?></td>
                                            <td><?php echo $row['t_name']; ?></td>
                                            <td><?php echo $row['sr_fee']; ?></td>
                                            <td><?php echo $total; ?></td>
                                        </tr>
                                <?php }
                                } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <h3>Last Payment</h3>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Amount($)</th>
                                    <th>Month</th>
                                    <th>Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $sql1 = "SELECT * FROM student_payment WHERE student_id='$id' ORDER BY id DESC LIMIT 1";
                                $result1 = mysqli_query($conn, $sql1);
                                
                                $row1 = mysqli_fetch_assoc($result1);

                                $desc = $row1["_status"];
                                $amount = $row1["paid"];
                                $month = $row1["month"];
                                $date = $row1["date"];

                                $current_month = date('F');

                                if ($desc == "Monthly Fee1") {

                                    $sql2 = "SELECT * FROM student_payment WHERE student_id='$id' AND date='$date'";
                                    $result2 = mysqli_query($conn, $sql2);
                                    $count = 0;
                                    while ($row2 = mysqli_fetch_assoc($result2)) {

                                        $desc1 = $row2["_status"];
                                        $amount1 = $row2["paid"];
                                        $month1 = $row2["month"];
                                        $date1 = $row2["date"];

                                        if ($desc1 == "Monthly Fee1") {

                                            $desc1 = "Monthly Fee";
                                        }

                                        $count++;

                                        echo '

                                            <tr>
                                                <td>' . $count . '</td>
                                                <td>' . $desc1 . '</td>
                                                <td>' . $amount1 . '</td>
                                                <td>' . $month1 . '</td>
                                                <td>' . $date1 . '</td>
                                            </tr>
                                        
                                        
                                        
                                        ';
                                    }
                                } else {
                                    echo '

                                        <tr>
                                            <td>1</td>
                                            <td>'.$desc.'</td>
                                            <td>'.$amount.'</td>
                                            <td>'.$month.'</td>
                                            <td>'.$date.'</td>
                                        </tr>
                                    
                                    
                                    
                                    ';
                                }


                                ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-5">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3>Add Payment</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                           
                                <div class="card-body">
                                    <div class="form-group row" id="divName">
                                        <div class="col-md-4">
                                            <label>Description</label>
                                        </div>
                                        <div class="col-md-8">
                                            <span style="font-size: 20px;">Monthly Fee</span>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row" id="divName">
                                        <div class="col-md-4">
                                            <label>Amount($)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <span style="font-size: 20px;"><?php echo $total; ?></span>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer text-right">
                                    <input type="hidden" id="last_month" value="<?php echo $month; ?>">
                                    <input type="hidden" id="current_month" value="<?php echo $current_month; ?>">
                                    <input type="hidden" id="student_id" value="<?php echo $id; ?>">
                                    <input type="hidden" id="monthly_fee" value="<?php echo $total; ?>">
                                    <button type="submit" class="btn btn-primary" id="btnPaid" onclick="addPayment3();" >($)Paid</button>
                                </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>