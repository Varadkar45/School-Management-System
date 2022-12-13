<?php
if(isset($_GET["do"])&&($_GET["do"]=="update_password")){
	
	include_once '../config/config.php';
	
	$username=$_GET["username"];
	$current_password=$_GET["current_password"];
    $new_password=$_GET["new_password"];
    $confirm_password=$_GET["confirm_password"];
    
    $current_password1 =  '';

	$sql1="SELECT * FROM user WHERE username='$username'";
    $result1=mysqli_query($conn,$sql1);
    
    if (mysqli_num_rows($result1) > 0) {

        $row1=mysqli_fetch_assoc($result1);
        
        $current_password1=$row1['password'];

    }

    $msg=0;
	
    if(password_verify($current_password, $current_password1)){

        if($new_password == $confirm_password){

            $hash = password_hash($new_password, PASSWORD_DEFAULT);

            $sql = "UPDATE user SET password='". $hash ."'  WHERE username='$username'";

		    if (mysqli_query($conn, $sql)) {
                $msg += 1;
            }else{
                $msg += 2;
            }

        }else{
             //Your password and confirmation password do not match.
             $msg += 3;
        }
	
    }else{
        //Your current password is incorrect.
        $msg += 4;

    }

	$res=array($msg);
	echo json_encode($res);
}
?>