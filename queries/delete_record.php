<?php
if(isset($_GET["do"])&&($_GET["do"]=="delete_record")){
	
	include_once '../config/config.php';
	
	$id=$_GET["id"];
	$table_name=$_GET["table_name"];
	
	$sql="DELETE FROM $table_name WHERE id='$id'";
	$msg=0;
	
	if(mysqli_query($conn,$sql)){
		$msg+=1; 
	}else{
		$msg+=2; 
	}
	
	$res=array($msg);
	echo json_encode($res);

}
?>