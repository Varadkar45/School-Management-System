<?php
if(isset($_GET["do"])&&($_GET["do"]=="delete_record")){
	
	include_once('../controller/config.php');
	
	$id=$_GET["id"];
    
    $msg=0;
	
	$sql="DELETE FROM student_grade WHERE student_id='$id'";
	
	if(mysqli_query($conn,$sql)){

        $sql1="DELETE FROM student_subject WHERE student_id='$id'";
        mysqli_query($conn,$sql1);

		$msg+=1; 
	}else{
		$msg+=2; 
	}
	
	$res=array($msg);
	echo json_encode($res);

}
?>