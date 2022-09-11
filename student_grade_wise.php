<?php
include_once './config/config.php';
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: index.php');
    exit;
}
?>
<div class="col-8">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">All Student</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $id = $_GET["id"];
                    $current_year = date('Y');

                    $sql = "SELECT student.id as std_id, student.name as std_name
                            FROM student_grade
                            INNER JOIN student
                            ON student_grade.student_id=student.id 
                            WHERE student_grade.grade_id='$id' AND student_grade.year='$current_year'";
                    $result = mysqli_query($conn, $sql);
                    $count = 0;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $count++;

                    ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td>
                                    <a href="#studentDetails" data-toggle="modal" onclick="studentDetails(this);" data-id="<?php echo $row['std_id']; ?>">
                                        <?php echo $row['std_name']; ?>
                                    </a>

                                </td>

                                <td>
                                    <a href="edit_student.php?id=<?php echo $row['std_id']; ?>"  class="btn btn-primary btn-xs ">Edit</a>
                                    <a href="#" onClick="deleteRecord(this);" class="btn btn-danger btn-xs " data-id="<?php echo $row['std_id']; ?>,<?php echo $id; ?>" data-toggle="modal">Delete</a>
                                    <a href="#" onClick="editStudentSubject(this);" class="btn btn-success btn-xs " data-id="<?php echo $row['std_id']; ?>,<?php echo $id; ?>" data-toggle="modal">Edit Subject</a>
                                    <a href="#" onClick="upgradeGrade(this);" class="btn btn-danger btn-xs " data-id="<?php echo $row['std_id']; ?>" data-toggle="modal">Upgrade Grade</a>
                                    <a href="#" onClick="addPayment2(this);" class="btn btn-success btn-xs " data-id="<?php echo $row['std_id']; ?>" data-toggle="modal">Add Payment</a>
                                    <a href="#" onClick="viewPayment(this);" class="btn btn-primary btn-xs " data-id="<?php echo $row['std_id']; ?>" data-toggle="modal">VIew Payment</a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>