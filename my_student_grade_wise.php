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
            <h3 class="card-title">My Student</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10%">ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $id = $_GET["id"];
                    $current_year = date('Y');
                    $teacher_id = $_GET["teacher_id"];

                    $sql = "SELECT student.id as std_id, student.name as std_name
                            FROM subject_routing
                            INNER JOIN student_subject
                            ON subject_routing.id=student_subject.sr_id 
                            INNER JOIN student
                            ON student_subject.student_id=student.id
                            WHERE subject_routing.grade_id='$id' AND subject_routing.teacher_id='$teacher_id ' AND student_subject.year='$current_year'";
                            
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
                                    <a href="edit_student1.php?id=<?php echo $row['std_id']; ?>"  class="btn btn-primary btn-xs ">Edit</a>
                                    <a href="#" onClick="deleteRecord(this);" class="btn btn-danger btn-xs " data-id="<?php echo $row['std_id']; ?>,<?php echo $id; ?>,<?php echo $teacher_id; ?>" data-toggle="modal">Delete</a>
                                    <a href="#" onClick="editStudentSubject(this);" class="btn btn-success btn-xs " data-id="<?php echo $row['std_id']; ?>,<?php echo $id; ?>" data-toggle="modal">Edit Subject</a>
                                    
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>