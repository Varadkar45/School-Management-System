
<?php
if(isset($_GET["do"])&&($_GET["do"]=="update_grade")){
	
	include_once '../config/config.php';
	
	$id=$_GET["id"];
	$name=$_GET["name"];
    $admission_fee=$_GET["admission_fee"];
	$institute_fee=$_GET["institute_fee"];
	
	$id1 = 0;
	$name1 = '';
	
	$sql1="SELECT * FROM grade WHERE name='$name'";
	$result1=mysqli_query($conn,$sql1);

	if (mysqli_num_rows($result1) > 0) {

		$row1=mysqli_fetch_assoc($result1);
		
		$id1=$row1['id'];
		$name1=$row1['name'];

	}
	
	$msg=0;
	$name2="";
	$admission_fee2="";
	$institute_fee2="";

	if ($id == $id1) {
		//update the admission fee and hall charge
		$sql = "UPDATE grade SET admission_fee='" . $admission_fee . "',institute_fee='" . $institute_fee . "'  WHERE id='$id'";

		if (mysqli_query($conn, $sql)) {
			$msg += 1;

			$sql2 = "SELECT * FROM grade where id='$id'";
			$result2 = mysqli_query($conn, $sql2);
			$row2 = mysqli_fetch_assoc($result2);

			$name2 = $row2['name'];
			$admission_fee2 = $row2['admission_fee'];
			$institute_fee2 = $row2['institute_fee'];

		} else {
			$msg += 2;
		}
	}else{
		if($name == $name1){
			//grade is duplicated
			$msg += 3;
		}else{
			//update the record.

			$sql = "UPDATE grade SET name='" . $name . "',admission_fee='" . $admission_fee . "',institute_fee='" . $institute_fee . "'  WHERE id='$id'";

			if (mysqli_query($conn, $sql)) {
				$msg += 1;

				$sql2 = "SELECT * FROM grade where id='$id'";
				$result2 = mysqli_query($conn, $sql2);
				$row2 = mysqli_fetch_assoc($result2);

				$name2 = $row2['name'];
				$admission_fee2 = $row2['admission_fee'];
				$institute_fee2 = $row2['institute_fee'];
			} else {
				$msg += 2;
			}
		}
	}


	$res=array($msg,$name2,$admission_fee2,$institute_fee2);
	echo json_encode($res);
}
?>