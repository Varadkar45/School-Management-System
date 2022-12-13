<?php
if(isset($_POST["do"])&&($_POST["do"]=="add_grade")){
	
	include_once './config/config.php';

	$name = $_POST["name"];
	$admision_fee = $_POST["admision_fee"];
	$institute_fee = $_POST["institute_fee"];

	$name1 = '';

	$sql1="SELECT * FROM grade WHERE name='$name'";
	$result1=mysqli_query($conn,$sql1);

	if (mysqli_num_rows($result1) > 0) {

		$row1=mysqli_fetch_assoc($result1);
		$name1=$row1['name'];

	}

	$msg=0;

	if($name == $name1){
		$msg+=1;
	}else{
		$sql="INSERT INTO grade(name,admission_fee,institute_fee)
		VALUES('".$name."','".$admision_fee."','".$institute_fee."')";
		
		if(mysqli_query($conn,$sql)){
			$msg+=2;
		}else{
			$msg+=3;
		}
		
	}

	header("Location: grade.php?do=alert_from_insert&msg=$msg");

}
?>