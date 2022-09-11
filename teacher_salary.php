<?php
include_once './config/config.php';
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: index.php');
    exit;
}
?>
<div class="modal fade" id="modalAddSalary" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">

                <?php

                $id = $_GET['id'];

                $sql = "SELECT * FROM teacher WHERE id='$id'";
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
                        <h3>Total Salary For This Month</h3>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Grade</th>
                                    <th>Subject</th>
                                    <th>Subject Fee($)</th>
                                    <th>Student Count</th>
                                    <th>Instute Fee(%)</th>
                                    <th>Subtotal</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                            $current_year = date('Y');

                            $sql = "SELECT subject_routing.id as sr_id, subject_routing.fee as sr_fee, grade.name as g_name, subject.name as s_name, grade.institute_fee as g_i_fee 
                                    FROM subject_routing
                                    INNER JOIN grade
                                    ON subject_routing.grade_id=grade.id
                                    INNER JOIN subject
                                    ON subject_routing.subject_id=subject.id
                                    WHERE subject_routing.teacher_id='$id'";


                            $result = mysqli_query($conn, $sql);
                            $count = 0;
                            $total_salary =0;
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $count++;

                                    $sr_id=$row['sr_id'];
                                    $institute_fee = $row['g_i_fee'];

                                    $subject_fee = $row['sr_fee'];

                                    $sql1="SELECT COUNT(student_id) FROM student_subject WHERE sr_id='$sr_id' AND year='$current_year'";
                                    $result1=mysqli_query($conn, $sql1);
                                    $row1=mysqli_fetch_assoc($result1);

                                    $student_count = $row1['COUNT(student_id)'];

                                    $net_total_amount = $subject_fee * $student_count;

                                    $sub_total = $net_total_amount - ($net_total_amount * $institute_fee / 100);

                                    $total_salary += $sub_total;

                                    $sub_total = number_format($sub_total, 2, '.', '');
                                    $total_salary = number_format($total_salary, 2, '.', '');

                                
                            ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $row['g_name']; ?></td>
                                            <td><?php echo $row['s_name']; ?></td>
                                            <td><?php echo $row['sr_fee']; ?></td>
                                            <td><?php echo $student_count; ?></td>
                                            <td><?php echo $institute_fee; ?></td>
                                            <td><?php echo $sub_total; ?></td>
                                            <td><?php echo $total_salary; ?></td>
                                        </tr>
                                <?php }//end while loop
                                
                                }else{
                                    echo '<tr><td colspan="8">No Data...!</td></tr>';
                                } 
                                
                                ?>
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

                                $sql1 = "SELECT * FROM teacher_salary WHERE teacher_id='$id' ORDER BY id DESC LIMIT 1";
                                $result1 = mysqli_query($conn, $sql1);

                                $month = '';
                                
                                if(mysqli_num_rows($result1 ) > 0){

                                    $row1 = mysqli_fetch_assoc($result1);

                                    $desc = $row1["_status"];
                                    $amount = $row1["paid"];
                                    $month = $row1["month"];
                                    $date = $row1["date"];

                                    $current_month = date('F');
    
                                
                                        echo '

                                            <tr>
                                                <td>1</td>
                                                <td>'.$desc.'</td>
                                                <td>'.$amount.'</td>
                                                <td>'.$month.'</td>
                                                <td>'.$date.'</td>
                                            </tr>
                                        
                                        
                                        
                                        ';


                                }else{

                                    echo '<tr><td colspan="5">No Data...!</td></tr>';
                                }

                                



                                
    

                                ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-5">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3>Add Salary</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                           
                                <div class="card-body">
                                    <div class="form-group row" id="divName">
                                        <div class="col-md-4">
                                            <label>Description</label>
                                        </div>
                                        <div class="col-md-8">
                                            <span style="font-size: 20px;">Monthly Salary</span>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group row" id="divName">
                                        <div class="col-md-4">
                                            <label>Amount($)</label>
                                        </div>
                                        <div class="col-md-8">
                                            <span style="font-size: 20px;"><?php echo   $total_salary; ?></span>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer text-right">
                                    <input type="hidden" id="last_month" value="<?php echo $month; ?>">
                                    <input type="hidden" id="current_month" value="<?php echo $current_month; ?>">
                                    <input type="hidden" id="teacher_id" value="<?php echo $id; ?>">
                                    <input type="hidden" id="monthly_salary" value="<?php echo $total_salary; ?>">
                                    <button type="submit" class="btn btn-primary" id="btnPaid" onclick="addSalary1();" >($)Paid</button>
                                </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>