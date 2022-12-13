<?php
session_start();

if(isset($_POST["do"])&&($_POST["do"]=="user_login")){
	
	include_once './config/config.php';

	$username = $_POST["email"];
	$password = $_POST["password"];

	$username1 = '';
	$hash = '';
	$type = '';

	$sql1="SELECT * FROM user WHERE username='$username'";
	$result1=mysqli_query($conn,$sql1);

	if (mysqli_num_rows($result1) > 0) {

		$row1=mysqli_fetch_assoc($result1);

		$username1=$row1['username'];
		$hash=$row1['password'];
		$type=$row1['type'];

	}

	$msg=0;

	if($username == $username1 && password_verify($password,$hash)){

		if($type == 'Admin'){

			$sql="SELECT * FROM admin WHERE email='$username '";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($result);

			$_SESSION["id"]=$row['id'];
			$_SESSION["type"]="Admin";

			header("Location: dashboard.php");

		}

		if($type == 'Teacher'){

			$sql="SELECT * FROM teacher WHERE email='$username'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($result);

			$_SESSION["id"]=$row['id'];
			$_SESSION["type"]="Teacher";

			header("Location: dashboard_teacher.php");

		}

		if($type == 'Student'){

			$sql="SELECT * FROM student WHERE email='$username'";
			$result=mysqli_query($conn,$sql);
			$row=mysqli_fetch_assoc($result);

			$_SESSION["id"]=$row['id'];
			$_SESSION["type"]="Student";

			header("Location: dashboard_student.php");

		}

	}else{
		$msg += 1;
		header("Location: login.php?do=login_error&msg=$msg");

	}



}

?>