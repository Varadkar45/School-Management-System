<?php
if(isset($_POST["do"])&&($_POST["do"]=="add_subject_routing")){
	
	include_once './config/config.php';

	$grade_id = $_POST["grade_id"];
	$subject_id = $_POST["subject_id"];
	$teacher_id = $_POST["teacher_id"];
	$fee = $_POST["fee"];

	$grade_id1 = 0;
	$subject_id1 = 0;
	$teacher_id1 = 0;

	$sql1="SELECT * FROM subject_routing WHERE grade_id='$grade_id' AND subject_id='$subject_id' AND teacher_id='$teacher_id'";
	$result1=mysqli_query($conn,$sql1);

	if (mysqli_num_rows($result1) > 0) {

		$row1=mysqli_fetch_assoc($result1);

		$grade_id1=$row1['grade_id'];
		$subject_id1=$row1['subject_id'];
		$teacher_id1=$row1['teacher_id'];

	}

	$msg=0;

	if($grade_id == $grade_id1 && $subject_id == $subject_id1 && $teacher_id == $teacher_id1){
		$msg+=1;
	}else{
		$sql="INSERT INTO subject_routing(grade_id,subject_id,teacher_id,fee)
		VALUES('".$grade_id."','".$subject_id."','".$teacher_id."','".$fee."')";
		
		if(mysqli_query($conn,$sql)){
			$msg+=2;
		}else{
			$msg+=3;
		}
		
	}

	header("Location: subject_routing.php?do=alert_from_insert&msg=$msg");

}

?>