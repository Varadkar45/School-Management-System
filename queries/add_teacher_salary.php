<?php
if(isset($_GET["do"])&&($_GET["do"]=="add_teacher_salary")){
	
	include_once '../config/config.php';
	
	$teacher_id=$_GET["teacher_id"];
	$monthly_salary=$_GET["monthly_salary"];
	
	$current_year = date('Y');
	$current_month = date('F');
	$current_date = date('Y-m-d');
    
    $msg=0;

    $sql="INSERT INTO teacher_salary(teacher_id,year,date,month,paid,_status)
          VALUES('".$teacher_id."','".$current_year."','".$current_date."','".$current_month."','".$monthly_salary."','Monthly Salary')";
    	
	if(mysqli_query($conn,$sql)){

		$msg+=1; 
	}else{
		$msg+=2; 
	}
	
	$res=array($msg);
	echo json_encode($res);

}
?>