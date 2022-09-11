<?php
include_once './config/config.php';
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:../index.php');
    exit;
}
?>
<div class="col-8">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<h3 class="card-title">All Teacher</h3>
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
					
					$sql = "SELECT * FROM teacher";
					$result = mysqli_query($conn, $sql);
					$count = 0;
					
					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
							$count++;

					?>
							<tr>
								<td><?php echo $count; ?></td>
								<td>
									<a href="#teacherDetails" data-toggle="modal" onclick="teacherDetails(this);" data-id="<?php echo $row['id']; ?>">
										<?php echo $row['name']; ?>
									</a>

								</td>
								<td>
									<a href="edit_teacher.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-xs ">Edit</a>
									<a href="#" onClick="deleteRecord(this);" class="btn btn-danger btn-xs " data-id="<?php echo $row['id']; ?>" data-toggle="modal">Delete</a>
									<a href="#" onClick="addSalary(this);" class="btn btn-success btn-xs " data-id="<?php echo $row['id']; ?>" data-toggle="modal">Add Salary</a>
									<a href="#" onClick="viewPayment(this);" class="btn btn-info btn-xs " data-id="<?php echo $row['id']; ?>" data-toggle="modal">View Payment</a>
								</td>
							</tr>
					<?php }
					} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>