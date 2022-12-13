<?php
if(isset($_GET["do"])&&($_GET["do"]=="add_student_first_payment")){
	
	include_once '../config/config.php';
	
	$student_id=$_GET["student_id"];
    $admission_fee=$_GET["admission_fee"];
	$monthly_fee=$_GET["monthly_fee"];
	
	$current_year = date('Y');
	$current_month = date('F');
	$current_date = date('Y-m-d');
    
    $msg=0;

	
    $sql="INSERT INTO student_payment(student_id,year,month,date,paid,_status)
          VALUES('".$student_id."','".$current_year."','".$current_month."','".$current_date."','".$admission_fee."','Admission Fee')";
    	
	if(mysqli_query($conn,$sql)){

		$sql1="INSERT INTO student_payment(student_id,year,month,date,paid,_status)
		       VALUES('".$student_id."','".$current_year."','".$current_month."','".$current_date."','".$monthly_fee."','Monthly Fee1')";

		mysqli_query($conn,$sql1);
		$msg+=1; 
	}else{
		$msg+=2; 
	}
	
	$res=array($msg);
	echo json_encode($res);

}
?>