<?php

$_arguments = array();
if(count($_POST) > 0){
	$_arguments = $_POST;
}else if(count($_GET) > 0){
	$_arguments = $_GET;
}

if(isset($_arguments["do"])&& ($_arguments["do"] != "")){
	if(($_arguments["do"] == "add_classroom")){
		$page = "queries/add_classroom.php";
	}else if(($_arguments["do"] == "add_subject")){
		$page = "queries/add_subject.php";
	}else if(($_arguments["do"] == "add_grade")){
		$page = "queries/add_grade.php";
	}else if(($_arguments["do"] == "add_teacher")){
		$page = "queries/add_teacher.php";
	}else if(($_arguments["do"] == "update_teacher")){
		$page = "queries/update_teacher.php";
	}else if(($_arguments["do"] == "add_subject_routing")){
		$page = "queries/add_subject_routing.php";
	}else if(($_arguments["do"] == "add_student")){
		$page = "queries/add_student.php";
	}else if(($_arguments["do"] == "update_student")){
		$page = "queries/update_student.php";
	}else if(($_arguments["do"] == "add_admin")){
		$page = "queries/add_admin.php";
	}else if(($_arguments["do"] == "user_login")){
		$page = "queries/user_login.php";
	}else if(($_arguments["do"] == "update_admin")){
		$page = "queries/update_admin.php";
	}
}else{
	header("Location: login.php");
}

require $page;

?>