<?php
include_once './config/config.php';
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: index.php');
    exit;
}
?>
<div class="modal fade" id="modalSelectSubject" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Add Student Subject</h5>
                <button type="button" onclick=" showModal();" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Subject</th>
                            <th>Teacher</th>
                            <th>Fee($)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $id = $_GET['id'];
                        $student_id = $_GET['student_id'];

                        $sql = "SELECT subject_routing.id as sr_id, subject_routing.fee as sr_fee, subject.name as s_name, teacher.name as t_name
                                FROM subject_routing
                                INNER JOIN subject
                                ON subject_routing.subject_id = subject.id
                                INNER JOIN teacher
                                ON subject_routing.teacher_id =teacher.id 
                                WHERE subject_routing.grade_id='$id'";
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                               
                        ?>
                                <tr>
                                    <td><input type="checkbox" id="checkbox" value="<?php echo $row["sr_id"]; ?>"></td>
                                    <td><?php echo $row['s_name']; ?></td>
                                    <td><?php echo $row['t_name']; ?></td>
                                    <td><?php echo $row['sr_fee']; ?></td>                                    
                                    
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="grade_id1" value="<?php echo $id; ?>">
                <input type="hidden" id="student_id1" value="<?php echo $student_id; ?>">
                <button type="button" class="btn bg-primary" id="btnSubmit1" style="width:100%;" onClick="addStudentSubject();">Submit</button>
            </div>
        </div>
    </div>
</div>