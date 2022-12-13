<?php
if(isset($_GET["do"])&&($_GET["do"]=="add_student_payment")){
	
	include_once('../config/config.php');
	
	$student_id=$_GET["student_id"];
	$monthly_fee=$_GET["monthly_fee"];
	
	$current_year = date('Y');
	$current_month = date('F');
	$current_date = date('Y-m-d');
    
    $msg=0;
	
    $sql="INSERT INTO student_payment(student_id,year,date,month,paid,_status)
          VALUES('".$student_id."','".$current_year."','".$current_date."','".$current_month."','".$monthly_fee."','Monthly Fee')";
    	
	if(mysqli_query($conn,$sql)){

		$msg+=1; 
	}else{
		$msg+=2; 
	}
	
	$res=array($msg);
	echo json_encode($res);

}
?>