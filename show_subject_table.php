<?php
include_once './config/config.php';
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="col-7">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">All Subject</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="dTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10%">ID</th>
						<th style="width: 40%">Name</th>
						<th style="width: 50%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $sql = "SELECT * FROM subject";
                    $result = mysqli_query($conn, $sql);
                    $count = 0;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $count++;

                    ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td id="td1_<?php echo $row['id']; ?>"><?php echo $row['name']; ?></td>
                                <td>
                                    <a href="#modalUpdateForm" onClick="updateRecord(this);" class="btn btn-primary btn-xs " data-id="<?php echo $row['id']; ?>" data-toggle="modal">Edit</a>
                                    <a href="#" onClick="deleteRecord(this);" class="btn btn-danger btn-xs " data-id="<?php echo $row['id']; ?>" data-toggle="modal">Delete</a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>