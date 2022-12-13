<?php
if(isset($_GET["do"])&&($_GET["do"]=="update_student_subject")){
	
	include_once '../config/config.php';
	
	$student_id=$_GET["student_id"];
    $myArray=json_decode($_GET["sr_id"],true);

    $year=date("Y");

    $msg=0;

    $sql1="DELETE FROM student_subject WHERE student_id='$student_id'";

    if(mysqli_query($conn,$sql1)){
        
        for($i=0; $i<count($myArray); $i++){

            $sql = "INSERT INTO student_subject(student_id,sr_id,year)
                    VALUES ('".$student_id."','".$myArray[$i]."','".$year."')";
            mysqli_query($conn,$sql);
    
        }
        $msg+=1;
    }else{

        $msg+=2;

    }
         
    $res=array($msg);
	echo json_encode($res);

	  
}
?>