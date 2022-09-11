<?php
include_once("./config/config.php");
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: index.php');
    exit;
}
?>
<div class="modal fade" id="modalInvoice" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="div-logo">
                            <img class="logo" src="./uploads/logo.png">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <h2>Ingenious</h2>

                        <div class="school-address">
                            455 Foggy Heights,<br>
                            AZ 85004, US
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="school-email text-right">
                            Email: learnwithsan8080@gmail.com<br>
                            Phone: 444-888-1111
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h4>INVOICE TO:</h4>
                        <div>

                            <?php
                            
                            $grade_id = $_GET['grade_id'];
                            $student_id = $_GET['student_id'];
                            $monthly_fee = $_GET['monthly_fee'];
                            $monthly_fee = number_format($monthly_fee, 2, '.', '');

                            $sql = "SELECT * FROM student WHERE id='$student_id'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);


                            ?>
                            <span class="student-name"><?php echo $row['name']; ?></span>

                        </div>

                    </div>
                    <div class="col-md-6 current-date text-right">

                        <?php

                        $sql1 = "SELECT * FROM student_payment ORDER BY id DESC LIMIT 1";
                        $result1 = mysqli_query($conn, $sql1);

                        $id1 = 0;
                        
                        if (mysqli_num_rows($result1) > 0) {

                            $row1 = mysqli_fetch_assoc($result1);

                            $id1 = $row1["id"];
                        
                        }

                        $inv_number = $id1 + 1;

                        $current_year = date("Y");
                        $current_month = date("F");
                        $current_date = date("Y-m-d");


                        ?>

                        <h3>INVOICE - #<?php echo $inv_number; ?></h3>
                        <div>
                            Year: <?php echo $current_year; ?><br>
                            Month:<?php echo $current_month; ?><br>
                            Date: <?php echo $current_date; ?>
                        </div>

                    </div>
                </div>

                <table class="table table-bordered ">
                    <thead>
                        <tr class="t-head">
                            <th>#</th>
                            <th>Description</th>
                            <th class="text-right">Fee</th>
                            <th class="text-right">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $sql2 = "SELECT * FROM grade WHERE id='$grade_id'";
                        $result2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);

                        $admission_fee = $row2["admission_fee"];
                        $total = $admission_fee + $monthly_fee;
                        $total = number_format($total, 2, '.', '');

                        ?>

                        <tr>
                            <td>1</td>
                            <td>Admission Fee</td>
                            <td class="text-right"><?php echo $admission_fee; ?></td>
                            <td class="text-right"><?php echo $admission_fee; ?></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Monthly Fee</td>
                            <td class="text-right"><?php echo $monthly_fee; ?></td>
                            <td class="text-right"><?php echo $monthly_fee; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">
                        
                        <div class="float-right text-right">

                            <strong>
                                <span id=""><?php echo $admission_fee; ?>$</span> <br>
                                <span id=""><?php echo $monthly_fee; ?>$</span> <br>
                                <span id=""><?php echo $total; ?>$</span> <br>
                                <span id=""><?php echo $total; ?>$</span> <br>
                            </strong>

                        </div>
                        
                        <div class="float-right text-right">

                            <strong>
                                Admission Fee :<br>
                                Monthly Fee :<br>
                                Total :<br>
                                Paid :<br>
                            </strong>

                        </div>  

                    </div>

                </div>
                <center><h1 class="thanks">Thank You!</h1></center>
            </div>
           
            <div class="modal-footer">
                <input type="hidden" id="student_id" value="<?php echo $student_id; ?>">
                <input type="hidden" id="admission_fee" value="<?php echo $admission_fee; ?>">
                <input type="hidden" id="monthly_fee" value="<?php echo $monthly_fee; ?>">
                <button type="button" class="btn bg-primary" id="btnUpdate" onClick="addPayment1();">Paid</button>
            </div>
        </div>
    </div>
</div>