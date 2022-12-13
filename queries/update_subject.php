<?php
if(isset($_GET["do"])&&($_GET["do"]=="update_subject")){
	
	include_once '../config/config.php';
	
	$id=$_GET["id"];
	$name=$_GET["name"];

	$name1 = '';
	
	$sql1="SELECT * FROM subject WHERE name='$name'";
	$result1=mysqli_query($conn,$sql1);

	if (mysqli_num_rows($result1) > 0) {

		$row1=mysqli_fetch_assoc($result1);
		$name1=$row1['name'];
	
	}
	$msg=0;
	$name2="";
	
	if($name==$name1){
		$msg+=3;
	}else{
		$sql = "UPDATE subject SET name='".$name."' WHERE id='$id'"; 
		
		if(mysqli_query($conn,$sql)){
			$msg+=1;
			
			$sql2="SELECT * FROM subject where id='$id'";	
			$result2=mysqli_query($conn,$sql2);
			$row2=mysqli_fetch_assoc($result2);
				
			$name2=$row2['name'];
		}else{
			$msg+=2;
		}
	}
	
	$res=array($msg,$name2);
	echo json_encode($res);
}
?>