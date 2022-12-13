<?php
if(isset($_GET["do"])&&($_GET["do"]=="update_classroom")){
	
	include_once '../config/config.php';
	
	$id=$_GET["id"];
	$name=$_GET["name"];
	$student_count=$_GET["student_count"];
	
	$sql1="SELECT * FROM classroom WHERE name='$name'";
	$result1=mysqli_query($conn,$sql1);

	$id1 = 0;
	$name1 = '';
	$student_count1 = 0;

	if (mysqli_num_rows($result1) > 0) {

		$row1=mysqli_fetch_assoc($result1);
		
		$id1=$row1['id'];
		$name1=$row1['name'];
		$student_count1=$row1['student_count'];

	}
	
	$msg=0;
	$name2="";
	$student_count2="";
	
	if($id == $id1){
		if($student_count == $student_count1){
			// you didn’t change anything.
			$msg+=3;
		}else{
			//update the student count.
			
			$sql = "UPDATE classroom SET student_count='".$student_count."' WHERE id='$id'";
			
			if(mysqli_query($conn,$sql)){
				$msg+=1;
				
				$sql2="SELECT * FROM classroom where id='$id'";	
				$result2=mysqli_query($conn,$sql2);
				$row2=mysqli_fetch_assoc($result2);
				
				$name2=$row2['name'];
				$student_count2=$row2['student_count'];
				
			}else{
				$msg+=2;
			}
		}
	}else{
		if($name == $name1){
			//The classroom name is duplicated.
			$msg+=4;
		}else{
			//update the classroom name and student count.
			$sql = "UPDATE classroom SET name='".$name."',student_count='".$student_count."' WHERE id='$id'";
			
			if(mysqli_query($conn,$sql)){
				$msg+=1;
				
				$sql2="SELECT * FROM classroom where id='$id'";	
				$result2=mysqli_query($conn,$sql2);
				$row2=mysqli_fetch_assoc($result2);
				
				$name2=$row2['name'];
				$student_count2=$row2['student_count'];
				
			}else{
				$msg+=2;
			}
		}
		
	}
	
	$res=array($msg,$name2,$student_count2);
	echo json_encode($res);
}
?>