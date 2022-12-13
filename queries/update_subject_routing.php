<?php
if(isset($_GET["do"])&&($_GET["do"]=="update_subject_routing")){
	
	include_once '../config/config.php';
	
	$id=$_GET["id"];
	$grade_id=$_GET["grade_id"];
    $subject_id=$_GET["subject_id"];
    $teacher_id=$_GET["teacher_id"];
	$fee=$_GET["fee"];
	
	$id1 = 0;
	$grade_id1 = 0;
	$subject_id1 = 0;
	$teacher_id1 = 0;
	
	$sql1="SELECT * FROM subject_routing WHERE grade_id='$grade_id' AND subject_id='$subject_id' AND teacher_id='$teacher_id'";
	$result1=mysqli_query($conn,$sql1);

	if (mysqli_num_rows($result1) > 0) {

		$row1=mysqli_fetch_assoc($result1);

		$id1=$row1['id'];
		$grade_id1=$row1['grade_id'];
		$subject_id1=$row1['subject_id'];
		$teacher_id1=$row1['teacher_id'];

	}
	
	$msg=0;
	$grade2="";
	$subject2="";
	$teacher2="";
	$fee2="";

	if($id == $id1){
		//Update the subject fee
		$sql = "UPDATE subject_routing SET fee='".$fee."' WHERE id='$id'";

		if(mysqli_query($conn,$sql)){
			$msg+=1;

			$sql2="SELECT subject_routing.fee as s_fee, grade.name as g_name, subject.name as s_name, teacher.name as t_name
			       FROM subject_routing
				   INNER JOIN grade
				   ON subject_routing.grade_id=grade.id
				   INNER JOIN subject
				   ON subject_routing.subject_id=subject.id
				   INNER JOIN teacher
				   ON subject_routing.teacher_id=teacher.id
				   where subject_routing.id='$id'";	

			$result2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($result2);
				
			$grade2=$row2['g_name'];
			$subject2=$row2['s_name'];
			$teacher2=$row2['t_name'];
			$fee2=$row2['s_fee'];

		}else{
			$msg+=2;
		}

	}else{
		if($grade_id == $grade_id1 && $subject_id == $subject_id1 && $teacher_id == $teacher_id1){
			//The record has been duplicated
			$msg+=3;
		}else{
			//Update all colunms

			$sql = "UPDATE subject_routing SET grade_id='" . $grade_id . "', subject_id='" . $subject_id . "',teacher_id='" . $teacher_id . "',fee='" . $fee . "' WHERE id='$id'";

			if (mysqli_query($conn, $sql)) {
				$msg += 1;

				$sql2 = "SELECT subject_routing.fee as s_fee, grade.name as g_name, subject.name as s_name, teacher.name as t_name
			             FROM subject_routing
				         INNER JOIN grade
				         ON subject_routing.grade_id=grade.id
				         INNER JOIN subject
				         ON subject_routing.subject_id=subject.id
				         INNER JOIN teacher
				         ON subject_routing.teacher_id=teacher.id
				         WHERE subject_routing.id='$id'";

				$result2 = mysqli_query($conn, $sql2);
				$row2 = mysqli_fetch_assoc($result2);

				$grade2 = $row2['g_name'];
				$subject2 = $row2['s_name'];
				$teacher2 = $row2['t_name'];
				$fee2 = $row2['s_fee'];
			} else {
				$msg += 2;
			}
		}
	}

	$res = array($msg,$grade2,$subject2,$teacher2,$fee2);
	echo json_encode($res);
}
?>