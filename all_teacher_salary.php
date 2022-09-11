<?php
include_once './config/config.php';
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: index.php');
    exit;
}
?>
<div class="col-10">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Teacher Payment History</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dTable1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Year</th>
                        <th>Month</th>
                        <th>Description</th>
                        <th>Paid</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $id = $_GET['id'];

                    $sql = "SELECT * FROM teacher_salary WHERE teacher_id='$id'";
                    $result = mysqli_query($conn, $sql);
                    $count = 0;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $count++;

                            $desc = $row['_status'];

                    ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row['year']; ?></td>
                                <td><?php echo $row['month']; ?></td>
                                <td><?php echo $desc; ?></td>
                                <td><?php echo $row['paid']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>