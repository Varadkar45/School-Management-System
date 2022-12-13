<?php
if(isset($_GET["do"])&&($_GET["do"]=="add_student_subject")){
	
	include_once('../config/config.php');
	
	$student_id=$_GET["student_id"];
    $grade_id=$_GET["grade_id"];
    $myArray=json_decode($_GET["sr_id"],true);

    $year=date("Y");
    $monthly_fee = 0;

    for($i=0; $i<count($myArray); $i++){

        //$myArray = [1,5,7];

       // $myArray[0] = 1;
        //$myArray[1] = 5;
        //$myarray[2] = 7;

        $sql = "INSERT INTO student_subject(student_id,sr_id,year)
			    VALUES ('".$student_id."','".$myArray[$i]."','".$year."')";
	    mysqli_query($conn,$sql);

        $sql1="SELECT * FROM subject_routing WHERE id='$myArray[$i]'";
        $result1=mysqli_query($conn,$sql1);
        $row1=mysqli_fetch_assoc($result1);

        $monthly_fee+=$row1["fee"];
/*
        $monthly_fee=$monthly_fee+$row1["fee"];
                    =0+100$
                    =100$

        $monthly_fee=$monthly_fee+$row1["fee"];
                    =100$+200$
                    =300$

        $monthly_fee=$monthly_fee+$row1["fee"];
                    =300$+100$
                    =400$                     
*/

    }
    
    $sql1 = "INSERT INTO student_grade(student_id,grade_id,year)
			 VALUES ('".$student_id."','".$grade_id."','".$year."')";
    mysqli_query($conn,$sql1);
    
    $res=array($monthly_fee);
	echo json_encode($res);	
	  
}
?>