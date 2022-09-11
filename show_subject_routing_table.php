<?php
include_once './config/config.php';
if (!isset($_SERVER['HTTP_REFERER'])) {
    // redirect them to your desired location
    header('location: index.php');
    exit;
}
?>
<div class="col-10">
    <div class="card card-outline card-primary">
        <div class="card-header">

            <h3 class="card-title">Subject Routing</h3>
            <a href="#modalInsertForm" class="btn btn-success btn-sm float-right" data-toggle="modal">Add <i class="fas fa-plus"></i></a>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Grade</th>
                        <th>Subject</th>
                        <th>Teacher</th>
                        <th>Fee($)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $sql = "SELECT subject_routing.id as sr_id, subject_routing.fee as sr_fee, grade.name as g_name, subject.name as s_name, teacher.name as t_name 
                            FROM subject_routing
                            INNER JOIN grade
                            ON subject_routing.grade_id=grade.id
                            INNER JOIN subject
                            ON subject_routing.subject_id=subject.id
                            INNER JOIN teacher
                            ON subject_routing.teacher_id=teacher.id";
                            
                    $result = mysqli_query($conn, $sql);
                    $count = 0;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $count++;

                    ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td id="td1_<?php echo $row['sr_id']; ?>"><?php echo $row['g_name']; ?></td>
                                <td id="td2_<?php echo $row['sr_id']; ?>"><?php echo $row['s_name']; ?></td>
                                <td id="td3_<?php echo $row['sr_id']; ?>"><?php echo $row['t_name']; ?></td>
                                <td id="td4_<?php echo $row['sr_id']; ?>"><?php echo $row['sr_fee']; ?></td>
                                <td>
                                    <a href="#modalUpdateForm" onClick="updateRecord(this);" class="btn btn-primary btn-xs " data-id="<?php echo $row['sr_id']; ?>" data-toggle="modal">Edit</a>
                                    <a href="#" onClick="deleteRecord(this);" class="btn btn-danger btn-xs " data-id="<?php echo $row['sr_id']; ?>" data-toggle="modal">Delete</a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>