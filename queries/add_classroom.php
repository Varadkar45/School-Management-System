<?php
if(isset($_POST["do"])&&($_POST["do"]=="add_classroom")){
	
	include_once './config/config.php';

	$name = $_POST["name"];
	$student_count = $_POST["student_count"];

	$name1 = '';

	$sql1="SELECT * FROM classroom WHERE name='$name'";
	$result1=mysqli_query($conn,$sql1);

	if (mysqli_num_rows($result1) > 0) {

		$row1=mysqli_fetch_assoc($result1);
		$name1=$row1['name'];

	}

	$msg=0;

	if($name == $name1){
		$msg+=1;
	}else{
		$sql="INSERT INTO classroom(name,student_count)
		VALUES('".$name."','".$student_count."')";
		
		if(mysqli_query($conn,$sql)){
			$msg+=2;
		}else{
			$msg+=3;
		}
		
	}

	header("Location: classroom.php?do=alert_from_insert&msg=$msg");

}
?>